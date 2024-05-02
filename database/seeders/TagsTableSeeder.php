<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'زهور', 'name_en' => 'Flowers', 'slug' => 'flowers']);
        Tag::create(['name' => 'طبيعة سجية', 'name_en' => 'Nature', 'slug' => 'nature']);
        Tag::create(['name' => 'إلكتروني', 'name_en' => 'Electronic', 'slug' => 'electronic']);
        Tag::create(['name' => 'حياة', 'name_en' => 'Life', 'slug' => 'life']);
        Tag::create(['name' => 'نمط', 'name_en' => 'Style', 'slug' => 'style']);
        Tag::create(['name' => 'طعام', 'name_en' => 'Food', 'slug' => 'food']);
        Tag::create(['name' => 'السفر', 'name_en' => 'Travel', 'slug' => 'travel']);

    }
}
