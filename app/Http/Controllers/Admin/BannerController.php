<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource and the form to create a new one.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('order_column', 'asc')->get();
        
        // Return the admin view
        return view('admin.coursel', compact('banners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'order_column' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('image_url')) {
            // Save image to 'banners' folder
            $path = $request->file('image_url')->store('banners', 'public');
            $validatedData['image_url'] = $path;
        }

        Banner::create($validatedData);

        // Redirect using correct route name
        return redirect()->route('admin.banners.index')->with('success', 'Banner added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        // Delete image from storage
        Storage::disk('public')->delete($banner->image_url);
        
        // Delete banner from database
        $banner->delete();

        // Redirect using correct route name
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully!');
    }
}
