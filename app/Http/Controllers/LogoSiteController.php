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
        // Get the first logo site or create a new one if none exists
        $logoSite = LogoSite::first() ?? new LogoSite();
        
        return view('admin.pages.logo-site.edit', compact('logoSite'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // Get the first logo site or create a new one if none exists
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
            
            $logoPath = $this->processLogo($request->file('logo'));
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
     * Process and optimize the uploaded logo
     */
    private function processLogo($image)
    {
        // Create directory if not exists
        if (!Storage::exists('public/logos')) {
            Storage::makeDirectory('public/logos');
        }
        
        $filename = 'site_site_' . time() . '.webp';
        $path = 'logos/' . $filename;
        
        // Resize height to 50px and maintain aspect ratio
        $img = Image::make($image->getRealPath())
            
            ->encode('webp', 100);
        
        Storage::put('public/' . $path, $img);
        
        return $path;
    }
    
}