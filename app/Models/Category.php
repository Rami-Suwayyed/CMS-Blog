<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Category extends Model
{

    use HasFactory, SearchableTrait;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }

    protected $searchable = [
        'columns'   => [
            'categories.name'       => 10,
            'categories.name_en'    => 10,
            'categories.slug'       => 10,
        ],
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

    public function name()
    {
        return config('app.locale') == 'ar' ? $this->name : $this->name_en;
    }

    public function url_slug()
    {
        return $this->slug;
    }

}
