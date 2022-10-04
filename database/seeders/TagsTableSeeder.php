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
        Tag::create(['name' => 'زهور', 'name_en' => 'Flowers']);
        Tag::create(['name' => 'طبيعة سجية', 'name_en' => 'Nature']);
        Tag::create(['name' => 'إلكتروني', 'name_en' => 'Electronic']);
        Tag::create(['name' => 'حياة', 'name_en' => 'Life']);
        Tag::create(['name' => 'نمط', 'name_en' => 'Style']);
        Tag::create(['name' => 'طعام', 'name_en' => 'Food']);
        Tag::create(['name' => 'السفر', 'name_en' => 'Travel']);

    }
}
