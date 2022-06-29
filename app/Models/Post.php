<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Post extends Model
{
    use HasFactory ,Sluggable , SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns'   => [
            'posts.title'       => 10,
            'posts.description' => 10,
        ],
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }



    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopePost($query)
    {
        return $query->where('post_type', 'post');
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approved_comments()
    {
        return $this->hasMany(Comment::class)->whereStatus(1);
    }

    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }


}
