<?php

namespace App\Http\Controllers\backend;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $profile = Profile::with('socialLinks')->first(); 
        return view('Backend.profile' , compact('profile'));
    }

    public function storeOrUpdate(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $profile = Profile::first();
        if (!Storage::disk('public')->exists('profile_images')) {
            Storage::disk('public')->makeDirectory('profile_images', 0755, true);
        }

        if ($request->hasFile('image')) {
             $imagePath = 'profile_images' . '- ' . time() . '.' . $request->image->getClientOriginalExtension();
             $image = $request->image->storeAs('profile_images', $imagePath, 'public');
        }
        // Store the new image
         if ($profile) {
            $profile->update([
                'name' => $request->name,
                'image' => $imagePath,
            ]);
        } else {
            Profile::create([
                'name' => $request->name,
                'image' => $imagePath,
            ]);
        }

        return redirect()->back()->with('success', 'Profile saved successfully!');

    }
}
