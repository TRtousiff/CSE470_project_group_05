<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('banners')->insert([
            ['photo_url' => 'your_photo_url_1.jpg', 'description' => 'First Banner Description', 'created_at' => now(), 'updated_at' => now()],
            ['photo_url' => 'your_photo_url_2.jpg', 'description' => 'Second Banner Description', 'created_at' => now(), 'updated_at' => now()],
            // Add as many banners as you need
        ]);
    }
}
