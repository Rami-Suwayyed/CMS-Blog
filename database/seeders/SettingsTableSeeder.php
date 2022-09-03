<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Setting::create(['display_name' => 'Site title', 'key' => 'site_title', 'value' => 'Bloggi System', 'type' => 'text', 'section' => 'general', 'ordering' => 1]);
        Setting::create([ 'display_name' => 'Site Slogan', 'key' => 'site_slogan', 'value' => 'Amazing blog', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 2]);
        Setting::create([ 'display_name' => 'Site Description', 'key' => 'site_description', 'value' => 'Bloggi Content management system', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 3]);
        Setting::create([ 'display_name' => 'Site Keywords', 'key' => 'site_keywords', 'value' => 'Bloggi, blog, multi writer', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 4]);
        Setting::create([ 'display_name' => 'Site Email', 'key' => 'site_email', 'value' => 'admin@bloggi.test', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 5]);
        Setting::create([ 'display_name' => 'Site Status', 'key' => 'site_status', 'value' => 'Active', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 6]);
        Setting::create([ 'display_name' => 'Admin Title', 'key' => 'admin_title', 'value' => 'Bloggi', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 7]);
        Setting::create([ 'display_name' => 'Phone Number', 'key' => 'phone_number', 'value' => '05123456789', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 8]);
        Setting::create([ 'display_name' => 'Address', 'key' => 'address', 'value' => 'Al-Madina Al-Monawara St, Amman', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 9]);
        Setting::create([ 'display_name' => 'Map Latitude', 'key' => 'address_latitude', 'value' => '31.974655', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 10]);
        Setting::create([ 'display_name' => 'Map Longitude', 'key' => 'address_longitude', 'value' => '35.865308', 'details' => null, 'type' => 'text', 'section' => 'general', 'ordering' => 11]);

        Setting::create([ 'display_name' => 'Google Maps API Key', 'key' => 'google_maps_api_key', 'value' => null, 'details' => null, 'type' => 'text', 'section' => 'social_accounts', 'ordering' => 1]);
        Setting::create([ 'display_name' => 'Google Recaptcha API Key', 'key' => 'google_recaptcha_api_key', 'value' => null, 'details' => null, 'type' => 'text', 'section' => 'social_accounts', 'ordering' => 2]);
        Setting::create([ 'display_name' => 'Google Analytics Client ID', 'key' => 'google_analytics_client_id', 'value' => null, 'details' => null, 'type' => 'text', 'section' => 'social_accounts', 'ordering' => 3]);
        Setting::create([ 'display_name' => 'Facebook ID', 'key' => 'facebook_id', 'value' => 'https://www.facebook.com/Rmai-Suwayyed', 'details' => null, 'type' => 'text', 'section' => 'social_accounts', 'ordering' => 4]);
        Setting::create([ 'display_name' => 'Twitter ID', 'key' => 'twitter_id', 'value' => 'https://twitter.com/Rmai-Suwayyed', 'details' => null, 'type' => 'text', 'section' => 'social_accounts', 'ordering' => 5]);
        Setting::create([ 'display_name' => 'Instagram ID', 'key' => 'instagram_id', 'value' => 'https://instagram.com/Rmai-Suwayyed', 'details' => null, 'type' => 'text', 'section' => 'social_accounts', 'ordering' => 6]);
        Setting::create([ 'display_name' => 'Patreon ID', 'key' => 'flickr_id', 'value' => 'https://www.patreon.com/Rmai-Suwayyed', 'details' => null, 'type' => 'text', 'section' => 'social_accounts', 'ordering' => 7]);
        Setting::create([ 'display_name' => 'Youtube ID', 'key' => 'youtube_id', 'value' => 'https://www.youtube.com/Rmai-Suwayyed', 'details' => null, 'type' => 'text', 'section' => 'social_accounts', 'ordering' => 8]);

    }
}
