<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::get();
        $profile = Profile::with('socialLinks')->first();
        return view("Frontend.index", compact('banners', 'profile'));
    }
}
