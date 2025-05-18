<?php

namespace App\Http\Controllers\backend;

use App\Models\Banner;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    function index()
    {
        $profile = Profile::with('socialLinks')->first();
        $banners = Banner::latest()->get();
        return view('Backend.banner', compact('banners', 'profile'));
    }
    function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'profession' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // image section && image validation part 
        $folder = 'banner_image';
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder, 0755, true);
        }

        $imageName = 'banner' . "_" . time() . '.' . $request->image->getClientOriginalExtension(); 
        $image = $request->image->storeAs($folder, $imageName, 'public');

        $banner = new Banner(); 
        $banner->name = $request->name;
        $banner->profession = $request->profession;
        $banner->image = $imageName;
        $banner->save();
        return redirect()->back()->with('success', 'Banner Created Successfully');

    }

    function destroy($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $banner->delete();
            return redirect()->back()->with('success', 'Banner Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Banner Not Found');
        }
    }

    // edit function
    function edit($id)
    {
        $banners = Banner::latest()->get();
        $editData = Banner::findOrFail($id);
        return view('Backend.banner', compact('banners', 'editData'));
    }
    // update function
    function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'profession' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner = Banner::findOrFail($id);
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists("banner_image/{$banner->image}")) {
                Storage::disk('public')->delete("banner_image/{$banner->image}");
            }
            // upload new image
            $folder = 'banner_image';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder); 
            }

            $imageName = 'banner' . "_" . time() . '.' . $request->image->getClientOriginalExtension(); 
            $request->image->storeAs($folder, $imageName, 'public');
        } else {
            $imageName = $banner->image;
        }

        $banner->name = $request->name;
        $banner->profession = $request->profession;
        $banner->image = $imageName;
        $banner->save();
        return to_route('banner.index')->with('success', 'Banner Updated Successfully');
    }
}
