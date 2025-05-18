<?php

namespace App\Http\Controllers\backend;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index(){
        $profile = Profile::with('socialLinks')->first();
        return view("backend.about" , compact('profile'));
    }
}
