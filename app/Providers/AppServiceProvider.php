<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Social;
use App\Models\Status;
use App\Models\Chapter;
use App\Models\Socials;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer([
           'layouts.partials.header',
           'pages.home',
           'pages.search.results',
           'layouts.partials.footer'
        ], function ($view) {
            // Get all categories for standard navigation
            $allCategories = Category::withCount('stories')->orderBy('name')->get();
            $view->with('categories', $allCategories);
            
            // Get top 20 categories with the hottest stories (based on total chapter views and rating)
            $topCategories = Category::select([
                    'categories.id',
                    'categories.name',
                    'categories.slug',
                    'categories.description',
                    DB::raw('COUNT(DISTINCT stories.id) as stories_count'),
                    DB::raw('SUM(chapters.views) as total_views'),
                    DB::raw('AVG(ratings.rating) as avg_rating'),
                    // Calculate a "hotness" score combining views and rating
                    DB::raw('SUM(chapters.views) * AVG(COALESCE(ratings.rating, 3)) as hotness_score')
                ])
                ->join('category_story', 'categories.id', '=', 'category_story.category_id')
                ->join('stories', 'category_story.story_id', '=', 'stories.id')
                ->join('chapters', 'stories.id', '=', 'chapters.story_id')
                ->leftJoin('ratings', 'stories.id', '=', 'ratings.story_id') // Changed to leftJoin to include stories with no ratings
                ->groupBy([
                    'categories.id',
                    'categories.name',
                    'categories.slug',
                    'categories.description'
                ])
                ->orderByDesc('hotness_score')
                ->take(20)
                ->get();
                
            $view->with('topCategories', $topCategories);
        });
    }
}
