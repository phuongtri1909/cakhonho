<section>
    <div class="mt-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="section-title"><i class="fa-solid fa-fire fa-xl" style="color: #fdae3f;"></i> Truyện Hot</h1>
            <div class="category-filter">
                <select class="form-select" id="categoryFilter">
                    <option selected value="">Tất cả thể loại</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Stories Grid -->
        <div id="storiesContainer">
            @include('components.stories-grid', ['hotStories' => $hotStories])
        </div>
    </div>
</section>

@once

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#categoryFilter').change(function() {
                    const categoryId = $(this).val();
                    const storiesContainer = $('#storiesContainer');

                    // Show loading state
                    storiesContainer.addClass('loading');

                    $.ajax({
                        url: '{{ route('home') }}',
                        method: 'GET',
                        data: {
                            category_id: categoryId,
                            type: 'hot'
                        },
                        success: function(response) {
                            storiesContainer.html(response.html);
                            // Reinitialize any needed plugins or behaviors
                        },
                        error: function() {
                            alert('Có lỗi xảy ra khi lọc truyện');
                        },
                        complete: function() {
                            storiesContainer.removeClass('loading');
                        }
                    });
                });
            });
        </script>
    @endpush

    @push('styles')
        <style>
            #storiesContainer.loading {
                opacity: 0.6;
                pointer-events: none;
            }

            /* Header Styles */
            .section-title {
                font-size: 1.5rem;
                font-weight: 600;
                margin: 0;
                color: #333;
            }

            .category-filter .form-select {
                min-width: 200px;
                border-radius: 8px;
                border: 2px solid #eee;
                transition: border-color 0.3s ease;
            }

            .category-filter .form-select:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            /* Story Card Styles */
            .story-item {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.6s ease forwards;
            }

            .story-card {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                height: 100%;
                position: relative;
            }

            .story-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            /* Thumbnail Styles */
            .story-thumbnail {
                position: relative;
                padding-top: 133%;
                background: #f8f9fa;
            }

            .story-thumbnail img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .story-card:hover .story-thumbnail img {
                transform: scale(1.05);
            }

            /* Hover Effect Styles */
            .story-hover {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.8);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
                backdrop-filter: blur(2px);
            }

            .story-card:hover .story-hover {
                opacity: 1;
                visibility: visible;
            }

            .hover-content {
                color: white;
                text-align: center;
                transform: translateY(10px);
                transition: transform 0.3s ease;
            }

            .story-card:hover .hover-content {
                transform: translateY(0);
            }

            /* Story Info Styles */
            .story-info {
                padding: 12px;
                background: white;
            }

            .story-stats-container {
                margin-bottom: 8px;
            }

            .story-stats-container .d-flex {
                color: #6c757d;
                font-size: 0.85rem;
            }

            .story-stats-container .eye {
                color: #007bff;
                margin-right: 4px;
            }

            .story-stats-container .star {
                color: #f5d02d;
                margin-right: 4px;
            }

            .story-title {
                font-size: 0.9rem;
                margin: 0;
                line-height: 1.4;
                height: 2.5em;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                text-align: center;
            }

            .story-title a {
                color: #333;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .story-title a:hover {
                color: #007bff;
            }

            /* Category Badge Styles */
            .story-categories {
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
                justify-content: center;
                margin-top: 8px;
            }

            .category-badge {
                background: rgba(255, 255, 255, 0.2);
                color: white;
                padding: 3px 10px;
                border-radius: 12px;
                font-size: 0.75rem;
                backdrop-filter: blur(4px);
                transition: all 0.3s ease;
            }

            .category-badge:hover {
                background: rgba(255, 255, 255, 0.3);
                transform: translateY(-1px);
            }

            /* Animation */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Animation Delays for Grid Items */
            .story-item:nth-child(1) {
                animation-delay: 0.1s;
            }

            .story-item:nth-child(2) {
                animation-delay: 0.2s;
            }

            .story-item:nth-child(3) {
                animation-delay: 0.3s;
            }

            .story-item:nth-child(4) {
                animation-delay: 0.4s;
            }

            .story-item:nth-child(5) {
                animation-delay: 0.5s;
            }

            .story-item:nth-child(6) {
                animation-delay: 0.6s;
            }

            /* Responsive Styles */
            @media (max-width: 768px) {
                .section-title {
                    font-size: 1.25rem;
                }

                .category-filter .form-select {
                    min-width: 120px;
                    font-size: 0.9rem;
                }

                .story-title {
                    font-size: 0.85rem;
                }

                .story-stats-container {
                    font-size: 0.8rem;
                }
            }
        </style>
    @endpush
@endonce
