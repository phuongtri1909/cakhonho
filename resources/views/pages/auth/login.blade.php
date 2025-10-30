@extends('layouts.main')
@section('title', 'Đăng nhập')

@push('styles-main')
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <style>
        .social-btn {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            border: 2px solid #ddd;
            background: white;
        }
        
        .social-btn.google-btn:hover {
            background: linear-gradient(45deg, #4285f4, #34a853, #fbbc05, #ea4335);
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(66, 133, 244, 0.3);
        }
        
        .social-btn.google-btn:hover svg path {
            fill: white !important;
        }
        
        .social-btn.facebook-btn {
            border-color: #1877f2;
        }
        
        .social-btn.facebook-btn:hover {
            background: #1877f2;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(24, 119, 242, 0.3);
        }
        
        .social-btn.facebook-btn:hover svg path {
            fill: white !important;
        }
    </style>
@endpush

@section('content-main')
    <div class="auth-container d-flex align-items-center justify-content-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="auth-card p-4 p-md-5">
                        <div class="text-center mb-4">
                            <a href="{{ route('home') }}">
                                @php
                                    // Get the logo and favicon from LogoSite model
                                    $logoSite = \App\Models\LogoSite::first();
                                    $logoPath =
                                        $logoSite && $logoSite->logo
                                            ? Storage::url($logoSite->logo)
                                            : asset('assets/images/logo/logo_site.webp');
                                @endphp
                                <img class="auth-logo mb-4" src="{{ $logoPath }}" alt="logo">
                            </a>
                            <h1 class="auth-title">Chào Mừng Trở Lại!</h1>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mb-4">
                            <a href="{{ route('login.google') }}" class="social-btn google-btn">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                </svg>
                            </a>
                            <a href="{{ route('login.facebook') }}" class="social-btn facebook-btn">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" fill="#1877F2"/>
                                </svg>
                            </a>
                        </div>

                        <div class="divider d-flex align-items-center mb-4 justify-content-center">
                            <p class="text-center mx-3 mb-0 text-dark">Hoặc</p>
                        </div>

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="name@example.com"
                                        value="{{ old('email') }}" required>
                                    <label for="email">Email của bạn</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating position-relative">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Password" required>
                                    <label for="password">Mật khẩu</label>
                                    <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                                        id="togglePassword"></i>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 text-end">
                                <a href="{{ route('forgot-password') }}" class="auth-link text-decoration-none">Quên mật khẩu?</a>
                            </div>

                            <button type="submit" class="auth-btn btn w-100 mb-4">Đăng Nhập</button>

                            <div class="text-center">
                                <span>Chưa có tài khoản? </span>
                                <a href="{{ route('register') }}" class="auth-link text-decoration-none">Đăng ký ngay</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
