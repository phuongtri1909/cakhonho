<?php

namespace App\Http\Controllers;

use App\Models\LogoSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LogoSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logoSite = LogoSite::first() ?? new LogoSite();
        
        return view('admin.pages.logo-site.edit', compact('logoSite'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $logoSite = LogoSite::first() ?? new LogoSite();
        
        return view('admin.pages.logo-site.edit', compact('logoSite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'favicon' => 'nullable|file|mimes:ico,x-icon|max:1024',
        ], [
            'favicon.mimes' => 'Favicon phải là file .ico',
        ]);
        
        $logoSite = LogoSite::first();
        if (!$logoSite) {
            $logoSite = new LogoSite();
        }
        
        if ($request->hasFile('logo')) {
            if ($logoSite->logo) {
                Storage::delete('public/' . $logoSite->logo);
            }

            try {
                $logoPath = $this->processLogo($request->file('logo'));
            } catch (\Throwable $e) {
                $logoPath = $request->file('logo')->store('logos', 'public');
            }

            $logoSite->logo = $logoPath;
        }
        
        if ($request->hasFile('favicon')) {
            $faviconFile = $request->file('favicon');
            
            $faviconFile->move(public_path(), 'favicon.ico');
            
            $logoSite->favicon = 'favicon.ico';
        }
        
        $logoSite->save();
        
        return redirect()->route('logo-site.edit')->with('success', 'Logo và favicon đã được cập nhật thành công');
    }
    
    /**
     * Process and save the uploaded logo
     */
    private function processLogo($image)
    {
        if (!Storage::disk('public')->exists('logos')) {
            Storage::disk('public')->makeDirectory('logos');
        }

        $supportsWebp = function_exists('imagewebp');

        $extension = $supportsWebp ? 'webp' : 'png';
        $filename = 'site_logo_' . time() . '.' . $extension;
        $path = 'logos/' . $filename;

        $imageInstance = Image::make($image->getRealPath());

        try {
            if ($supportsWebp) {
                $imageInstance->encode('webp', 90);
            } else {
                $imageInstance->encode('png', 90);
            }
        } catch (\Throwable $e) {
            $extension = 'png';
            $filename = 'site_logo_' . time() . '.' . $extension;
            $path = 'logos/' . $filename;
            $imageInstance->encode('png', 90);
        }

        Storage::disk('public')->put($path, $imageInstance->stream());

        return $path;
    }
    
}