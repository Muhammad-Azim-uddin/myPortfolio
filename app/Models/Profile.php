<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'image'];
    public function socialLinks()
    {
        return $this->hasMany(SocialMediaLink::class);
    }
}
