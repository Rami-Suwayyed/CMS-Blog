<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Tag extends Model implements Sitemapable
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ],
        ];
    }

    protected $searchable = [
        'columns'   => [
            'tags.name'         => 10,
            'tags.name_en'      => 10,
            'tags.slug'         => 10,
        ],
    ];

    public function posts()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags');
    }

    public function name()
    {
        return config('app.locale') == 'ar' ? $this->name : $this->name_en;
    }

    public function url_slug()
    {
        return  $this->slug ;
    }

    public function toSitemapTag(): Url
    {
//        return route('frontend.posts.show', $this->slug);
        return URL::create(route('frontend.posts.show', $this))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }


}
