<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Story;
use App\Models\Banner;
use App\Models\Rating;
use App\Models\Status;
use App\Models\Chapter;
use App\Models\Comment;
use App\Models\Socials;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ReadingHistoryService;
use App\Models\UserReading;

class HomeController extends Controller
{

    public function searchHeader(Request $request)
    {
        $query = $request->input('query');

        $storiesQuery = Story::query();
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'mod'])) {
            $storiesQuery->where('status', Story::STATUS_PUBLISHED);
        }

        $stories = $storiesQuery
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhereHas('chapters', function ($cq) use ($query) {
                      $cq->where('status', Chapter::STATUS_PUBLISHED)
                         ->where(function ($cqq) use ($query) {
                             $cqq->where('title', 'LIKE', "%{$query}%")
                                 ->orWhere('content', 'LIKE', "%{$query}%");
                         });
                  })
                  ->orWhereHas('categories', function ($kq) use ($query) {
                      $kq->where('name', 'LIKE', "%{$query}%");
                  });
            })
            ->with(['categories', 'chapters'])
            ->paginate(20);

        $categories = Category::select('id','name','slug')->orderBy('name')->get();

        return view('pages.search.results', [
            'stories' => $stories,
            'query' => $query,
            'isSearch' => true,
            'categories' => $categories,
        ]);
    }

    public function showStoryCategories($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $stories = $category->stories()
            ->published()
            ->with(['categories', 'chapters'])
            ->paginate(20);
        
        $categories = Category::select('id','name','slug')->orderBy('name')->get();
            
        return view('pages.search.results', [
            'stories' => $stories,
            'currentCategory' => $category,
            'isSearch' => false,
            'categories' => $categories,
        ]);
    }

    public function index(Request $request)
    {
        $banners = Banner::active()->get();
        $categories = Category::select('id','name','slug')->orderBy('name')->get();
        $hotStories = $this->getHotStories($request);
        $newStories = $this->getNewStories($request);
        $completedStories = Story::query()
            ->published()
            ->where('completed', true)
            ->whereHas('chapters', function ($query) {
                $query->where('status', 'published');
            })
            ->select([
                'id',
                'title',
                'slug',
                'cover',
                'completed',
                'updated_at'
            ])
            ->withCount(['chapters' => function ($query) {
                $query->where('status', 'published');
            }])
            ->latest('updated_at')
            ->take(18)
            ->get();

        if ($request->ajax()) {
            if ($request->type === 'hot') {
                return response()->json([
                    'html' => view('components.stories-grid', compact('hotStories'))->render()
                ]);
            } elseif ($request->type === 'new') {
                return response()->json([
                    'html' => view('components.story-list-items', compact('newStories'))->render()
                ]);
            }
        }

        $dailyHotStories = Story::query()
            ->where('stories.status', Story::STATUS_PUBLISHED)
            ->join('chapters', function($join){
                $join->on('stories.id', '=', 'chapters.story_id')
                     ->where('chapters.status', 'published')
                     ->where('chapters.updated_at', '>=', now()->subDay());
            })
            ->leftJoin(DB::raw('(SELECT story_id, rating FROM ratings WHERE created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY)) as recent_ratings'), 'stories.id', '=', 'recent_ratings.story_id')
            ->select('stories.id')
            ->groupBy('stories.id')
            ->orderByRaw('(SUM(chapters.views) * AVG(COALESCE(recent_ratings.rating, 3))) DESC')
            ->take(10)
            ->pluck('stories.id');
        if ($dailyHotStories->isEmpty()) {
            $dailyHotStories = Story::query()
                ->where('stories.status', Story::STATUS_PUBLISHED)
                ->whereHas('chapters', fn($q)=>$q->where('status','published'))
                ->latest('updated_at')
                ->take(10)
                ->pluck('stories.id');
        }

        $weeklyHotStories = Story::query()
            ->where('stories.status', Story::STATUS_PUBLISHED)
            ->join('chapters', function($join){
                $join->on('stories.id', '=', 'chapters.story_id')
                     ->where('chapters.status', 'published')
                     ->where('chapters.updated_at', '>=', now()->subDays(7));
            })
            ->leftJoin(DB::raw('(SELECT story_id, rating FROM ratings WHERE created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)) as recent_ratings'), 'stories.id', '=', 'recent_ratings.story_id')
            ->select('stories.id')
            ->groupBy('stories.id')
            ->orderByRaw('(SUM(chapters.views) * AVG(COALESCE(recent_ratings.rating, 3))) DESC')
            ->take(10)
            ->pluck('stories.id');
        if ($weeklyHotStories->isEmpty()) {
            $weeklyHotStories = Story::query()
                ->where('stories.status', Story::STATUS_PUBLISHED)
                ->whereHas('chapters', fn($q)=>$q->where('status','published'))
                ->latest('updated_at')
                ->take(10)
                ->pluck('stories.id');
        }

        $monthlyHotStories = Story::query()
            ->where('stories.status', Story::STATUS_PUBLISHED)
            ->join('chapters', function($join){
                $join->on('stories.id', '=', 'chapters.story_id')
                     ->where('chapters.status', 'published')
                     ->where('chapters.updated_at', '>=', now()->subDays(30));
            })
            ->leftJoin(DB::raw('(SELECT story_id, rating FROM ratings WHERE created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)) as recent_ratings'), 'stories.id', '=', 'recent_ratings.story_id')
            ->select('stories.id')
            ->groupBy('stories.id')
            ->orderByRaw('(SUM(chapters.views) * AVG(COALESCE(recent_ratings.rating, 3))) DESC')
            ->take(10)
            ->pluck('stories.id');
        if ($monthlyHotStories->isEmpty()) {
            $monthlyHotStories = Story::query()
                ->where('stories.status', Story::STATUS_PUBLISHED)
                ->whereHas('chapters', fn($q)=>$q->where('status','published'))
                ->latest('updated_at')
                ->take(10)
                ->pluck('stories.id');
        }

        $allIds = $dailyHotStories->pluck('id')
            ->merge($weeklyHotStories->pluck('id'))
            ->merge($monthlyHotStories->pluck('id'))
            ->merge(collect($hotStories)->pluck('id'))
            ->merge(collect($newStories)->pluck('id'))
            ->merge(collect($completedStories)->pluck('id'))
            ->unique()
            ->values();

        if ($allIds->isNotEmpty()) {
            $hydrated = Story::with([
                'categories:id,name,slug',
                'latestChapter' => function($q){
                    $q->select('chapters.id','chapters.story_id','chapters.title','chapters.slug','chapters.number','chapters.created_at','chapters.status')
                      ->where('status', Chapter::STATUS_PUBLISHED);
                }
            ])
            ->withSum(['chapters as total_views' => function ($q) {
                $q->where('status', 'published');
            }], 'views')
            ->withAvg('ratings as average_rating', 'rating')
            ->whereIn('id', $allIds)->get()->keyBy('id');

            $dailyHotStories = collect($dailyHotStories)->map(fn($id) => $hydrated->get($id))->filter();
            $weeklyHotStories = collect($weeklyHotStories)->map(fn($id) => $hydrated->get($id))->filter();
            $monthlyHotStories = collect($monthlyHotStories)->map(fn($id) => $hydrated->get($id))->filter();

            if ($hotStories instanceof \Illuminate\Support\Collection) {
                $hotStories = $hotStories->map(function($s) use ($hydrated) {
                    $hydratedStory = $hydrated->get($s->id);
                    if ($hydratedStory) {
                        $hydratedStory->total_views = $s->total_views ?? $hydratedStory->total_views ?? 0;
                        $hydratedStory->average_rating = $s->average_rating ?? $hydratedStory->average_rating ?? 0.0;
                        $hydratedStory->hot_score = $s->hot_score ?? 0;
                        $hydratedStory->recent_views = $s->recent_views ?? 0;
                        $hydratedStory->chapters_count = $s->chapters_count ?? $hydratedStory->chapters_count ?? 0;
                        return $hydratedStory;
                    }
                    return $s;
                });
            }
            if ($newStories instanceof \Illuminate\Support\Collection) {
                $newStories = $newStories->map(fn($s) => $hydrated->get($s->id) ?? $s);
            }
            if ($completedStories instanceof \Illuminate\Support\Collection) {
                $completedStories = $completedStories->map(fn($s) => $hydrated->get($s->id) ?? $s);
            }
        }

        return view('pages.home', compact(
            'categories',
            'hotStories',
            'newStories',
            'completedStories',
            'banners',
            'dailyHotStories',
            'weeklyHotStories',
            'monthlyHotStories'
        ));
    }

    private function getHotStories($request)
    {
        $query = Story::query()
            ->published()
            ->whereHas('chapters', function ($query) {
                $query->where('status', 'published');
            })
            ->select([
                'id',
                'title',
                'slug',
                'cover',
                'completed',
                'description',
                'created_at',
                'updated_at'
            ])
            ->withCount(['chapters' => function ($query) {
                $query->where('status', 'published');
            }])
            ->withSum(['chapters as recent_views' => function ($q) {
                $q->where('status', 'published')
                  ->where('created_at', '>=', now()->subDays(7));
            }], 'views')
            ->withSum(['chapters as total_views' => function ($q) {
                $q->where('status', 'published');
            }], 'views')
            ->withAvg('ratings as average_rating', 'rating')
            ->with(['categories:id,name,slug'])
            ->addSelect([
                DB::raw('COALESCE((SELECT SUM(views) FROM chapters WHERE chapters.story_id = stories.id AND chapters.status = "published"), 0) as total_views_calc'),
                DB::raw('COALESCE((SELECT AVG(rating) FROM ratings WHERE ratings.story_id = stories.id), 0) as average_rating_calc')
            ]);

        if ($request->category_id) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        $hotStories = $query->get()
            ->map(function ($story) {
                $totalViews = (int) ($story->total_views_calc ?? $story->getAttribute('total_views') ?? 0);
                $avgRating = (float) ($story->average_rating_calc ?? $story->getAttribute('average_rating') ?? 0.0);
                
                $story->setAttribute('total_views', $totalViews);
                $story->total_views = $totalViews;
                
                $story->setAttribute('average_rating', $avgRating);
                $story->average_rating = $avgRating;
                
                $story->hot_score = $this->calculateHotScore($story);
                return $story;
            })
            ->sortByDesc('hot_score')
            ->values()
            ->take(12);
        return $hotStories;
    }

    private function calculateHotScore($story)
    {
        $totalViews = (int) ($story->total_views ?? 0);
        $recentViews = (int) ($story->recent_views ?? 0);
        $chaptersCount = (int) ($story->chapters_count ?? 0);

        $avgViews = $chaptersCount > 0 ? ($totalViews / $chaptersCount) : 0;

        $daysActive = max(1, $story->created_at->diffInDays(now()));
        $chapterFrequency = $chaptersCount / $daysActive;

        $daysSinceLastUpdate = $story->updated_at->diffInDays(now());
        $recencyBoost = 1 + (1 / max(1, $daysSinceLastUpdate));

        $score = (
            ($totalViews * 0.3) +
            ($avgViews * 0.2) +
            ($recentViews * 0.25) +
            ($chapterFrequency * 15) +
            ($chaptersCount * 5)
        ) * $recencyBoost;

        return $score;
    }

    private function getNewStories($request)
    {
        $query = Story::query()
            ->published()
            ->select([
                'id',
                'title',
                'slug',
                'cover',
                'status',
                'completed'
            ])
            ->whereHas('chapters', function ($query) {
                $query->where('status', 'published');
            });

        if ($request->category_id) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        return $query->orderByDesc(function ($query) {
            $query->select('created_at')
                ->from('chapters')
                ->whereColumn('story_id', 'stories.id')
                ->where('status', 'published')
                ->latest()
                ->limit(1);
        })
            ->take(20)
            ->get();
    }

    public function showStory(Request $request, $slug)
    {
        $story = $request->attributes->get('story');
        if (!$story || $story->slug !== $slug) {
            $storyQuery = Story::where('slug', $slug);
            if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'mod'])) {
                $storyQuery->where('status', Story::STATUS_PUBLISHED);
            }
            $story = $storyQuery->firstOrFail();
        }

        $story->load(['categories']);

        $chapters = Chapter::where('story_id', $story->id)
            ->published()
            ->orderBy('number', 'desc')
            ->paginate(20);

        $stats = [
            'total_chapters' => method_exists($chapters, 'total') ? $chapters->total() : $story->chapters()->published()->count(),
            'total_views' => $story->chapters()->sum('views'),
            'ratings' => [
                'count' => Rating::where('story_id', $story->id)->count(),
                'average' => Rating::where('story_id', $story->id)->avg('rating') ?? 0
            ]
        ];

        $status = (object)[
            'status' => $story->completed ? 'done' : 'ongoing'
        ];

        $storyCategories = $story->categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ];
        });

        $chapters = $story->chapters()
            ->published()
            ->orderBy('number', 'asc')
            ->paginate(50);

        $pinnedComments = Comment::with(['user', 'replies.user', 'reactions'])
            ->where('story_id', $story->id)
            ->whereNull('reply_id')
            ->where('is_pinned', true)
            ->latest('pinned_at')
            ->get();

        $regularComments = Comment::with(['user', 'replies.user', 'reactions'])
            ->where('story_id', $story->id)
            ->whereNull('reply_id')
            ->where('is_pinned', false)
            ->latest()
            ->paginate(10);

        $userHasStoryPurchase = false;
        $purchasedChapterIds = [];
        if (auth()->check()) {
            $userId = auth()->id();
            $userHasStoryPurchase = $story->purchases()->where('user_id', $userId)->exists();
            $chapterIds = collect($chapters->items())->pluck('id');
            if ($chapterIds->isNotEmpty()) {
                $purchasedChapterIds = \App\Models\ChapterPurchase::where('user_id', $userId)
                    ->whereIn('chapter_id', $chapterIds)
                    ->pluck('chapter_id')
                    ->all();
            }
        }

        return view('pages.story', compact(
            'story',
            'stats',
            'status',
            'chapters',
            'pinnedComments',
            'regularComments',
            'storyCategories',
            'userHasStoryPurchase',
            'purchasedChapterIds'
        ));
    }

    public function chapterByStory($storySlug, $chapterSlug)
    {
        $story = Story::where('slug', $storySlug)->firstOrFail();

        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'mod'])) {
            if ($story->status !== Story::STATUS_PUBLISHED) {
                abort(404);
            }
        }

        $query = Chapter::where('slug', $chapterSlug)
            ->where('story_id', $story->id);

        if (auth()->check()) {
            if (in_array(auth()->user()->role, ['admin', 'mod'])) {
                $chapter = $query->firstOrFail();
            } else {
                $chapter = $query->where('status', 'published')->firstOrFail();
                
                if (!$chapter->is_free) {
                    $hasChapterAccess = $chapter->purchases()->where('user_id', auth()->id())->exists();
                    
                    $hasStoryAccess = $story->purchases()->where('user_id', auth()->id())->exists();
                    
                    if (!$hasChapterAccess && !$hasStoryAccess) {
                        return redirect()->route('show.page.story', $story->slug)
                            ->with('error', 'Bạn cần mua chương này để đọc nội dung.');
                    }
                }
            }
        } else {
            $chapter = $query->where('status', 'published')->firstOrFail();
            
            if (!$chapter->is_free) {
                return redirect()->route('login')
                    ->with('error', 'Bạn cần đăng nhập và mua chương này để đọc nội dung.');
            }
        }

        $ip = request()->ip();
        $sessionKey = "chapter_view_{$chapter->id}_{$ip}";

        if (!session()->has($sessionKey)) {
            $chapter->increment('views');
            session([$sessionKey => true]);
            session()->put($sessionKey, true, 1440);
        }

        $wordCount = str_word_count(strip_tags($chapter->content), 0, 'àáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳýỵỷỹ');
        $chapter->word_count = $wordCount;

        $nextChapterQuery = Chapter::where('story_id', $story->id)
            ->where('number', '>', $chapter->number)
            ->orderBy('number', 'asc');

        $prevChapterQuery = Chapter::where('story_id', $story->id)
            ->where('number', '<', $chapter->number)
            ->orderBy('number', 'desc');

        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'mod'])) {
            $nextChapterQuery->where('status', 'published');
            $prevChapterQuery->where('status', 'published');
        }

        $nextChapter = $nextChapterQuery->first();
        $prevChapter = $prevChapterQuery->first();

        $recentChaptersQuery = Chapter::where('story_id', $story->id)
            ->where('id', '!=', $chapter->id)
            ->orderBy('number', 'desc')
            ->take(5);

        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'mod'])) {
            $recentChaptersQuery->where('status', 'published');
        }

        $recentChapters = $recentChaptersQuery->get();

        $readingService = new ReadingHistoryService();
        $readingService->saveReadingProgress($story, $chapter);

        $recentReads = $readingService->getRecentReadings(5);
        
        $userReading = null;
        if (auth()->check()) {
            $userReading = UserReading::where('user_id', auth()->id())
                ->where('story_id', $story->id)
                ->where('chapter_id', $chapter->id)
                ->first();
        } else {
            $deviceKey = $readingService->getOrCreateDeviceKey();
            $userReading = UserReading::where('session_id', $deviceKey)
                ->whereNull('user_id')
                ->where('story_id', $story->id)
                ->where('chapter_id', $chapter->id)
                ->first();
        }
        
        $readingProgress = $userReading ? $userReading->progress_percent : 0;

        return view('pages.chapter', compact(
            'chapter',
            'story',
            'nextChapter',
            'prevChapter',
            'recentChapters',
            'recentReads',
            'readingProgress'
        ));
    }

    public function searchChapters(Request $request)
    {
        $searchTerm = $request->search;
        $storyId = $request->story_id;

        $query = Chapter::query();

        if ($storyId) {
            $query->where('story_id', $storyId);
        }

        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'mod'])) {
            $query->where('status', Chapter::STATUS_PUBLISHED)
                  ->whereHas('story', function ($sq) {
                      $sq->where('status', Story::STATUS_PUBLISHED);
                  });
        }

        if ($searchTerm) {
            $searchNumber = preg_replace('/[^0-9]/', '', $searchTerm);

            $query->where(function ($q) use ($searchTerm, $searchNumber) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");

                if ($searchNumber !== '') {
                    $q->orWhere('number', $searchNumber);
                }
            });
        }

        $chapters = $query->orderBy('number', 'desc')->take(20)->get();

        return response()->json([
            'html' => view('components.search-results', compact('chapters'))->render()
        ]);
    }
}
