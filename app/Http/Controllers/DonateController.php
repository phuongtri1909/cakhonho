<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DonateController extends Controller
{
    /**
     * Show the form for editing the donation information.
     */
    public function edit()
    {
        $donate = Donate::first() ?? new Donate();
        
        return view('admin.pages.donate.edit', compact('donate'));
    }

    /**
     * Update the donation information.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_qr' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_us' => 'nullable|string',
        ],[
            'image_qr.image' => 'Hình ảnh phải là định dạng ảnh',
            'image_qr.mimes' => 'Hình ảnh phải là định dạng jpeg, png, jpg hoặc gif',
            'image_qr.max' => 'Hình ảnh không được lớn hơn 2MB',
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'description.string' => 'Mô tả phải là chuỗi ký tự',
            'about_us.string' => 'Về chúng tôi phải là chuỗi ký tự',
        ]);
        
        $donate = Donate::first();
        if (!$donate) {
            $donate = new Donate();
        }
        
        $donate->title = $validatedData['title'];
        $donate->description = $validatedData['description'];
        $donate->about_us = $validatedData['about_us'];
        
        if ($request->hasFile('image_qr')) {
            if ($donate->image_qr) {
                Storage::disk('public')->delete($donate->image_qr);
            }
            
            $qrPath = $this->processQRImage($request->file('image_qr'));
            $donate->image_qr = $qrPath;
        }
        
        $donate->save();
        
        return redirect()->route('donate.edit')->with('success', 'Thông tin donate đã được cập nhật thành công');
    }
    
    /**
     * Process and optimize the uploaded QR code image
     */
    private function processQRImage($image)
    {
        if (!Storage::disk('public')->exists('donate')) {
            Storage::disk('public')->makeDirectory('donate');
        }
        
        $supportsWebp = function_exists('imagewebp');
        $extension = $supportsWebp ? 'webp' : 'png';
        $filename = 'qr_code_' . time() . '.' . $extension;
        $path = 'donate/' . $filename;
        
        $img = Image::make($image->getRealPath())
            ->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        try {
            if ($supportsWebp) {
                $img->encode('webp', 90);
            } else {
                $img->encode('png', 90);
            }
        } catch (\Throwable $e) {
            $extension = 'png';
            $filename = 'qr_code_' . time() . '.png';
            $path = 'donate/' . $filename;
            $img->encode('png', 90);
        }
        
        Storage::disk('public')->put($path, $img->stream());
        
        return $path;
    }
}