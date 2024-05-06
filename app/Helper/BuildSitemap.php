<?php

namespace App\Helper;
 use App\Models\Category;
 use App\Models\Page;
 use App\Models\Tag;
 use Spatie\Sitemap\Sitemap;
 use Spatie\Sitemap\Tags\Url;

 class BuildSitemap
 {


     public function build(): void
     {

         Sitemap::create()
             ->add(URL::create('/')->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
             ->add($this->buildIndex(Page::class, 'sitemap-posts.xml'))
             ->add($this->buildIndex(Category::class, 'sitemap-categories.xml'))
             ->add($this->buildIndex(Tag::class, 'sitemap-tags.xml'))
                ->add('/home')
                ->add('/login')
                ->add('/register')
                ->add('/page/about-us')
                ->add('/page/our-vision')
                ->add('/page/privacy-policy')
                ->add('/page/terms-of-service')
                ->add('/blog')
                ->add('/contact')
             ->writeToFile(public_path('sitemap.xml'));

     }


     public function buildIndex($model, $path): string
        {
            $sitemap = Sitemap::create()
                ->add($model)
                ->writeToFile(public_path($path));
            return $path;
        }


 }
