<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{



    /**
     * Handle banner click and redirect
     */
    public function click(Request $request, Banner $banner)
    {
        // Check if banner has a story
        if ($banner->story_id) {
            // If banner has a story, redirect to story page
            $story = Story::find($banner->story_id);
            if ($story) {
                return redirect()->route('show.page.story', $story->slug);
            }
        }

        // If no story or story not found, use the banner link
        if (!empty($banner->link)) {
            // Direct redirect to external link
            return redirect()->away($banner->link);
        }

        // Fallback to homepage if neither exists
        return redirect()->route('home');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::with('story')->paginate(10);
        return view('admin.pages.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stories = Story::orderBy('title')->get();
        return view('admin.pages.banners.create', compact('stories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateBanner($request);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->processImage($request->file('image'));
        }

        // Handle link requirement based on story_id
        if (empty($validatedData['story_id']) && empty($validatedData['link'])) {
            return back()->withInput()->withErrors(['link' => 'Link là bắt buộc khi không chọn truyện']);
        }

        Banner::create($validatedData);

        return redirect()->route('banners.index')->with('success', 'Banner đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('admin.pages.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        $stories = Story::orderBy('title')->get();
        return view('admin.pages.banners.edit', compact('banner', 'stories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validatedData = $this->validateBanner($request, $banner->id);

        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
                $base = pathinfo($banner->image, PATHINFO_FILENAME);
                $dir = dirname($banner->image);
                Storage::disk('public')->delete([$dir . '/desktop_' . $base . '.webp', $dir . '/mobile_' . $base . '.webp', $dir . '/desktop_' . $base . '.png', $dir . '/mobile_' . $base . '.png']);
            }

            $validatedData['image'] = $this->processImage($request->file('image'));
        }

        if (empty($validatedData['story_id']) && empty($validatedData['link'])) {
            return back()->withInput()->withErrors(['link' => 'Link là bắt buộc khi không chọn truyện']);
        }

        $banner->update($validatedData);

        return redirect()->route('banners.index')->with('success', 'Banner đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
            $base = pathinfo($banner->image, PATHINFO_FILENAME);
            $dir = dirname($banner->image);
            Storage::disk('public')->delete([$dir . '/desktop_' . $base . '.webp', $dir . '/mobile_' . $base . '.webp', $dir . '/desktop_' . $base . '.png', $dir . '/mobile_' . $base . '.png']);
        }

        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Banner đã được xóa thành công');
    }

    /**
     * Validate banner data
     */
    private function validateBanner(Request $request, $id = null)
    {
        $rules = [
            'image' => $id ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
            'story_id' => 'nullable|exists:stories,id',
            'status' => 'required|boolean',
            'link_aff' => 'nullable|url',
        ];

        return $request->validate($rules);
    }

    /**
     * Process and optimize the uploaded image
     */
    private function processImage($image)
    {
        $supportsWebp = function_exists('imagewebp');
        $extension = $supportsWebp ? 'webp' : 'png';
        $baseName = uniqid() . '_' . time();

        $dir = 'banners';
        $mainPath = $dir . '/' . $baseName . '.' . $extension;
        $desktopPath = $dir . '/desktop_' . $baseName . '.' . $extension;
        $mobilePath = $dir . '/mobile_' . $baseName . '.' . $extension;

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        // Desktop version
        $desktopImg = Image::make($image->getRealPath())
            ->resize(1920, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        try {
            if ($supportsWebp) {
                $desktopImg->encode('webp', 80);
            } else {
                $desktopImg->encode('png', 90);
            }
        } catch (\Throwable $e) {
            $extension = 'png';
            $desktopPath = $dir . '/desktop_' . $baseName . '.png';
            $mobilePath = $dir . '/mobile_' . $baseName . '.png';
            $mainPath = $dir . '/' . $baseName . '.png';
            $desktopImg->encode('png', 90);
        }
        Storage::disk('public')->put($desktopPath, $desktopImg->stream());

        $mobileImg = Image::make($image->getRealPath())
            ->resize(767, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        if ($extension === 'webp' && $supportsWebp) {
            $mobileImg->encode('webp', 70);
        } else {
            $mobileImg->encode('png', 90);
        }
        Storage::disk('public')->put($mobilePath, $mobileImg->stream());

        $mainImg = Image::make($image->getRealPath());
        if ($extension === 'webp' && $supportsWebp) {
            $mainImg->encode('webp', 90);
        } else {
            $mainImg->encode('png', 90);
        }
        Storage::disk('public')->put($mainPath, $mainImg->stream());

        return $mainPath;
    }
}
