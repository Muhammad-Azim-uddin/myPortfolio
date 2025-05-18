<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
    {
        $profile = Profile::create([
            'name' => 'Muhammad Azim',
            'image' => 'uploads/profile.jpg',
        ]);

        $profile->socialLinks()->createMany([
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/azim'],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/azim'],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/azim'],
        ]);
    }

}
