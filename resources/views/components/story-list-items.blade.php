@forelse ($newStories as $story)
    <div class="story-item p-3 border-bottom">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{ Storage::url($story->cover) }}" class="story-thumb"
                    alt="{{ $story->title }}">
                <div class="ms-3">
                    <h6 class="story-title text-start mb-1">
                        <a href="{{ route('show.page.story', $story->slug) }}">{{ $story->title }}</a>
                    </h6>
                    <div>
                        @foreach ($story->categories as $category)
                            <span class="category-tag">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div>
                <div class="story-meta mb-1">
                    <span class="text-muted me-3">
                        <i class="fas fa-book-open me-1 text-danger"></i>
                        @if($story->latestChapter)
                            <a class="text-muted text-decoration-none" href="{{ route('chapter', ['storySlug' => $story->slug, 'chapterSlug' => $story->latestChapter->slug]) }}">Chương {{ $story->latestChapter->number }}</a>
                        @else
                            Chương 0
                        @endif
                    </span>
                    <span class="text-muted">
                        <i class="fas fa-clock me-1 text-warning"></i>
                        @if($story->latestChapter)
                            {{ $story->latestChapter->created_at->diffForHumans() }}
                        @else
                            Chưa cập nhật
                        @endif
                    </span>
                </div>
                
                <div class="story-badges">
                    @if($story->latestChapter && $story->latestChapter->created_at->diffInHours() < 24)
                        <span class="badge-new">New</span>
                    @endif
                    @if(isset($story->hot_score) && $story->hot_score > 1000)
                        <span class="badge-hot">Hot</span>
                    @endif
                    @if($story->completed)
                        <span class="badge-full">Full</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="empty-stories py-5 text-center">
        <div class="empty-stories-icon mb-3">
            <i class="fas fa-book-open text-muted" style="font-size: 3rem;"></i>
        </div>
        <h5 class="empty-stories-title mb-2">Không có truyện mới</h5>
        <p class="text-muted">Hiện chưa có truyện nào được cập nhật trong danh mục này.</p>
    </div>
@endforelse