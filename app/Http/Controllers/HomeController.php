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

        return view('pages.search.results', [
            'stories' => $stories,
            'query' => $query,
            'isSearch' => true
        ]);
    }

    public function showStoryCategories($slug)
    {

        $category = Category::where('slug', $slug)->firstOrFail();
        
        $stories = $category->stories()
            ->published()
            ->with(['categories', 'chapters'])
            ->paginate(20);
            
        return view('pages.search.results', [
            'stories' => $stories,
            'currentCategory' => $category,
            'isSearch' => false
        ]);
    }

    public function index(Request $request)
    {

        // Get banners
        $banners = Banner::active()->get();

        // Get hot stories
        $hotStories = $this->getHotStories($request);

        // Get new stories
        $newStories = $this->getNewStories($request);

        // Get completed stories
        $completedStories = Story::with(['categories'])
            ->published()
            ->where('completed', true)
            ->whereHas('chapters', function ($query) {
                $query->where('status', 'published'); // Chỉ lấy truyện có chương đã xuất bản
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
                $query->where('status', 'published'); // Chỉ đếm chương đã xuất bản
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

        return view('pages.home', compact('hotStories', 'newStories', 'completedStories', 'banners'));
    }

    private function getHotStories($request)
    {
        $query = Story::with(['chapters' => function ($query) {
            $query->select('id', 'story_id', 'views', 'created_at')
                ->where('status', 'published'); 
        }])
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
            }]);

        if ($request->category_id) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        $hotStories = $query->get()
            ->map(function ($story) {
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
        $totalViews = $story->chapters->sum('views');

        $avgViews = $story->chapters_count > 0 ?
            $totalViews / $story->chapters_count : 0;

        $recentViews = $story->chapters()
            ->where('status', 'published')
            ->where('created_at', '>=', now()->subDays(7))
            ->sum('views');

        $daysActive = max(1, $story->created_at->diffInDays(now()));
        $chapterFrequency = $story->chapters_count / $daysActive;

        $daysSinceLastUpdate = $story->updated_at->diffInDays(now());
        $recencyBoost = 1 + (1 / max(1, $daysSinceLastUpdate));

        $score = (
            ($totalViews * 0.3) +
            ($avgViews * 0.2) +
            ($recentViews * 0.25) +
            ($chapterFrequency * 15) +
            ($story->chapters_count * 5)
        ) * $recencyBoost;

        return $score;
    }

    private function getNewStories($request)
    {
        $query = Story::with(['latestChapter' => function ($query) {
            $query->select('id', 'story_id', 'title', 'slug', 'number', 'views', 'created_at', 'status')
                ->where('status', 'published');
        }, 'categories'])
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
        $storyQuery = Story::where('slug', $slug);
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'mod'])) {
            $storyQuery->where('status', Story::STATUS_PUBLISHED);
        }
        $story = $storyQuery->firstOrFail();

        $story->load(['categories']);

        $chapters = Chapter::where('story_id', $story->id)
            ->published()
            ->orderBy('number', 'desc')
            ->paginate(20);

        $stats = [
            'total_chapters' => $story->chapters()->published()->count(),
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



        return view('pages.story', compact(
            'story',
            'stats',
            'status',
            'chapters',
            'pinnedComments',
            'regularComments',
            'storyCategories'
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
