<?php

namespace App\Http\Controllers\backend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    function index(){
        $banner = Banner::get();
        return view('Backend.banner', compact('banner'));
    }
    function storeandupdate(Request $request , $id= null){
        if($id){
            $banner = Banner::find($id);
            $banner->name = $request->name;
            $banner->profession = $request->profession;
            if($request->hasFile('image')){
                $filename = time().'.'.$request->image->extension();
                $filePath= $request->image->storeAs('banner', $filename, 'public');
                $banner->image = $filename;
            }
            $banner->save();
            return redirect()->back()->with('success', 'Banner Updated Successfully');
        }
        $this->validate($request,[
            'name' => 'required',
            'profession' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);

        $filename = time().'.'.$request->image->extension();
        $filePath= $request->image->storeAs('banner', $filename, 'public');        

        $banner = new Banner();
        $banner->name = $request->name;
        $banner->profession = $request->profession;
        $banner->image = $filename;
        $banner->save();
        return redirect()->back()->with('success', 'Banner Created Successfully');
    }

    // function edit($id){
    //     $banner = Banner::find($id);
    //     $banner = Banner::update($banner->);
    // }
}
