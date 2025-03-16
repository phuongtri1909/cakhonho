<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', 'Trang chủ - Web đọc truyện online miễn phí | ' . config('app.name'))</title>
    <meta name="description" content="@yield('description', 'Phùng Bảo Ngọc
                        Nơi đây là thế giới của những câu chuyện ngôn tình mang chiều sâu có H văn. Những câu chuyện về những cặp đôi lạc lối trong chính trái tim mình, loay hoay giữa yêu thương và dằn vặt, để rồi sau tất cả, họ nhận ra tình yêu thật sự luôn tồn tại trong chính họ. Nếu bạn cũng thích những mối quan hệ loay hoay trong bản ngã để rồi thức tỉnh rằng tình yêu vẫn luôn ở sâu trong tâm khảm linh hồn- chào mừng bạn đã đến đây.')">
    <meta name="keywords" content="@yield('keywords', 'hanlamngoc, hanlamngoc.com,  đọc truyện online, truyện miễn phí, truyện hot, truyện mới cập nhật, truyện full, truyện hoàn thành, đọc truyện chữ, web đọc truyện, novel, light novel, kho truyện online, truyện hay, truyện tiên hiệp, truyện kiếm hiệp, ngôn tình, đam mỹ, truyện teen, truyện xuyên không')">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Trang chủ - Web đọc truyện online miễn phí | ' . config('app.name'))')">
    <meta property="og:description" content="@yield('description', 'Phùng Bảo Ngọc
                        Nơi đây là thế giới của những câu chuyện ngôn tình mang chiều sâu có H văn. Những câu chuyện về những cặp đôi lạc lối trong chính trái tim mình, loay hoay giữa yêu thương và dằn vặt, để rồi sau tất cả, họ nhận ra tình yêu thật sự luôn tồn tại trong chính họ. Nếu bạn cũng thích những mối quan hệ loay hoay trong bản ngã để rồi thức tỉnh rằng tình yêu vẫn luôn ở sâu trong tâm khảm linh hồn- chào mừng bạn đã đến đây.')">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:image" content="{{ asset('assets/images/logo/logo_site.webp') }}">
    <meta property="og:image:secure_url" content="{{ asset('assets/images/logo/logo_site.webp') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="@yield('title', 'Trang chủ - Web đọc truyện online miễn phí | ' . config('app.name'))')">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Trang chủ - Web đọc truyện online miễn phí | ' . config('app.name'))')">
    <meta name="twitter:description" content="@yield('description', 'Phùng Bảo Ngọc
                        Nơi đây là thế giới của những câu chuyện ngôn tình mang chiều sâu có H văn. Những câu chuyện về những cặp đôi lạc lối trong chính trái tim mình, loay hoay giữa yêu thương và dằn vặt, để rồi sau tất cả, họ nhận ra tình yêu thật sự luôn tồn tại trong chính họ. Nếu bạn cũng thích những mối quan hệ loay hoay trong bản ngã để rồi thức tỉnh rằng tình yêu vẫn luôn ở sâu trong tâm khảm linh hồn- chào mừng bạn đã đến đây.')">
    <meta name="twitter:image" content="{{ asset('assets/images/logo/logo_site.webp') }}">
    <meta name="twitter:image:alt" content="@yield('title', 'Trang chủ - Web đọc truyện online miễn phí | ' . config('app.name'))">
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.ico') }}" type="image/png/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}" type="image/x-icon">
    <meta name="google-site-verification" content="" />

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "url": "{{ url('/') }}",
          "logo": "{{ asset('assets/images/logo/logo_site.webp')}}"
        }
    </script>

    @stack('meta')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->

    {{-- styles --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    @stack('styles')

    {{-- end styles --}}
</head>

<body>
    <header class="container">
        <nav
            class="navbar navbar-expand-lg fixed-top transition-header chapter-header scrolled bg-white shadow-sm py-2">
            <div class="container">
                <div class="d-flex align-items-center w-100">
                    <!-- Logo -->
                    <a class="navbar-brand p-0" href="{{ route('home') }}">
                        <img height="50" src="{{ asset('assets/images/logo/logo_site.webp') }}" alt="logo">
                    </a>

                    <div class="d-flex align-items-center w-100 justify-content-between flex-lg-row">
                        <!-- Desktop Menu - Visible on lg screens and up -->
                        <div class="list-menu d-none d-lg-block">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="text-dark nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-layer-group fa-lg"></i> Thể loại
                                    </a>
                                    <ul class="dropdown-menu category-menu">
                                        <div class="row px-2">
                                            @foreach ($categories->chunk(ceil($categories->count() / 3)) as $categoryGroup)
                                                <div class="col-4">
                                                    @foreach ($categoryGroup as $category)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('categories.story.show', $category->slug) }}">
                                                                {{ $category->name }}
                                                                <span
                                                                    class="badge bg-secondary float-end">{{ $category->stories_count }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="text-dark nav-link" href="{{ route('contact') }}">
                                        <i class="fa-solid fa-address-card fa-lg"></i> Liên hệ
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <div class="search-container d-flex align-items-center">
                                <div class="position-relative">
                                    <form action="{{ route('searchHeader') }}" method="GET">
                                        <input type="text" name="query" class="form-control search-input"
                                            placeholder="Tìm kiếm truyện..." value="{{ request('query') }}">
                                        <button type="submit" class="btn search-btn">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>



                        @auth
                            <a class="text-dark nav-link d-none d-lg-block" href="{{ route('login') }}">
                                <div class="dropdown">
                                    <a href="#"
                                        class="d-none d-lg-block d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                                        data-bs-toggle="dropdown">
                                        <img src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('assets/images/avatar_default.jpg') }}"
                                            class="rounded-circle" width="40" height="40" alt="avatar"
                                            style="object-fit: cover;">

                                        <span class="ms-2">{{ auth()->user()->name }}</span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end animate slideIn">
                                        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'mod')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                                    <i class="fas fa-tachometer-alt me-2"></i> Quản trị
                                                </a>
                                            </li>
                                        @endif

                                        <li>
                                            <a class="dropdown-item" href="{{ route('profile') }}">
                                                <i class="fas fa-user me-2"></i> Trang cá nhân
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}">
                                                <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn d-none d-lg-block"> <i
                                    class="fa-regular fa-circle-user fa-lg"></i> Đăng nhập</a>
                        @endauth


                        <!-- Mobile Menu Toggle Button - Visible on screens smaller than lg -->
                        <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample">
                            <i class="fa-solid fa-bars fa-xl"></i>
                        </button>
                    </div>


                </div>
            </div>
        </nav>

        <!-- Mobile Menu - Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample">
            <div class="offcanvas-header">

                <a class="navbar-brand" href="{{ route('home') }}">
                    <img height="50" src="{{ asset('assets/images/logo/logo_site.webp') }}" alt="logo">
                </a>

                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Navigation Links -->
                <div class="mobile-section">
                    <div class="mobile-nav-links d-flex flex-column">

                        <div class="accordion" id="categoryAccordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="categoryHeading">
                                    <button class="accordion-button collapsed mobile-menu-item p-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#categoryCollapse">
                                        <i class="fa-solid fa-layer-group fa-lg me-2"></i> Thể loại
                                    </button>
                                </h2>
                                <div id="categoryCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#categoryAccordion">
                                    <div class="accordion-body p-0 mt-2">
                                        <div class="row g-0">
                                            @foreach ($categories->chunk(ceil($categories->count() / 2)) as $categoryGroup)
                                                <div class="col-6">
                                                    @foreach ($categoryGroup as $category)
                                                        <a class="mobile-menu-item ps-3 py-2 d-block"
                                                            href="{{ route('categories.story.show', $category->slug) }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="divider my-3">

                        <a href="{{ route('contact') }}" class="mobile-menu-item ">
                            <i class="fa-solid fa-address-card fa-lg me-2"></i> Liên hệ
                        </a>

                        <hr class="divider my-3">


                        @auth
                            <div class="accordion" id="userAccordion">
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header" id="userHeading">
                                        <button class="accordion-button collapsed mobile-menu-item p-0" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#userCollapse">
                                            <img src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('assets/images/avatar_default.jpg') }}"
                                                class="rounded-circle me-2" width="40" height="40" alt="avatar"
                                                style="object-fit: cover;">
                                            <span>{{ auth()->user()->name }}</span>
                                        </button>
                                    </h2>
                                    <div id="userCollapse" class="accordion-collapse collapse"
                                        data-bs-parent="#userAccordion">
                                        <div class="accordion-body p-0 mt-2">
                                            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'mod')
                                                <a class="mobile-menu-item ps-3 py-2 d-block"
                                                    href="{{ route('admin.dashboard') }}">
                                                    <i class="fas fa-tachometer-alt me-2"></i> Quản trị
                                                </a>
                                            @endif

                                            <a class="mobile-menu-item ps-3 py-2 d-block" href="{{ route('profile') }}">
                                                <i class="fas fa-user me-2"></i> Trang cá nhân
                                            </a>

                                            <a class="mobile-menu-item ps-3 py-2 d-block" href="{{ route('logout') }}">
                                                <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="mobile-menu-item">
                                <i class="fa-regular fa-circle-user fa-lg me-2"></i> Đăng nhập
                            </a>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('.transition-header');
            const scrollThreshold = 50;

            function handleScroll() {
                if (window.scrollY > scrollThreshold) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }

            // Listen for scroll events
            window.addEventListener('scroll', handleScroll);

            // Initial check
            handleScroll();
        });


        document.addEventListener('DOMContentLoaded', function() {
            // Existing header transition code...

            // Search form handling
            const searchForm = document.querySelector('.search-container form');
            const searchInput = searchForm.querySelector('input[name="query"]');

            searchForm.addEventListener('submit', function(e) {
                if (searchInput.value.trim() === '') {
                    e.preventDefault();
                    searchInput.focus();
                }
            });

            // Auto-focus search input when clicking on the search container
            document.querySelector('.search-container').addEventListener('click', function() {
                searchInput.focus();
            });
        });
    </script>
