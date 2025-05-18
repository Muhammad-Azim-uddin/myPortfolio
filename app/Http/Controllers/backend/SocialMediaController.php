<?php

namespace App\Http\Controllers\backend;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\SocialMediaLink;
use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{
   public function store(Request $request, $profileId)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $profile = Profile::findOrFail($profileId);
        $profile->socialLinks()->create($request->only('platform', 'url'));

        return back()->with('success', 'Social media link added.');
    }

    public function delete($id)
    {
        SocialMediaLink::findOrFail($id)->delete();
        return back()->with('success', 'Link deleted.');
    }
}
