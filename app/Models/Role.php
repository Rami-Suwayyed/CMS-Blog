<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mindscms\Entrust\EntrustRole;
use Nicolaslopezj\Searchable\SearchableTrait;

class Role extends EntrustRole
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'name' => 10,
        'display_name' => 10,
        'display_name_en' => 10,
        'description' => 10,
        'description_en' => 10,
        'allowed_route' => 10,
    ];

    public function display_name()
    {
        return config('app.locale') == 'ar' ? $this->display_name : $this->display_name_en;
    }

    public function description()
    {
        return config('app.locale') == 'ar' ? $this->description : $this->description_en;
    }

}
