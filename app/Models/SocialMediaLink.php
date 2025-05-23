<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
    protected $fillable= ['profile_id', 'platform', 'url'];
     public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
