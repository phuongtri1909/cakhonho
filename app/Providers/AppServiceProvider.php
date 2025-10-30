<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Donate;
use App\Models\LogoSite;
use App\Models\Rating;
use App\Models\Social;
use App\Models\Status;
use App\Models\Chapter;
use App\Models\Socials;
use App\Models\Category;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer('layouts.partials.header', function ($view) {
            $allCategories = Category::select('id','name','slug')
                ->withCount(['stories as stories_count' => function ($q) {
                    $q->where('status', 'published');
                }])
                ->orderBy('name')
                ->get();

            $view->with('categories', $allCategories);
        });

        View::composer('layouts.partials.footer', function ($view) {
            $donate = Donate::first() ?? new Donate();
            
            $topCategories = Category::select([
                    'categories.id',
                    'categories.name',
                    'categories.slug',
                    DB::raw('COUNT(DISTINCT stories.id) as stories_count')
                ])
                ->join('category_story', 'categories.id', '=', 'category_story.category_id')
                ->join('stories', function($join){
                    $join->on('category_story.story_id', '=', 'stories.id')
                         ->where('stories.status', 'published');
                })
                ->join('chapters', function($join){
                    $join->on('stories.id', '=', 'chapters.story_id')
                         ->where('chapters.status', 'published');
                })
                ->groupBy('categories.id', 'categories.name', 'categories.slug')
                ->orderByDesc('stories_count')
                ->take(20)
                ->get();

            $view->with('donate', $donate)
                 ->with('topCategories', $topCategories);
        });

        View::composer(['layouts.app', 'admin.layouts.app'], function ($view) {
            static $logoSiteShared = null;
            if ($logoSiteShared === null) {
                $logoSiteShared = LogoSite::first();
            }
            $view->with('logoSite', $logoSiteShared);
        });
    }
}