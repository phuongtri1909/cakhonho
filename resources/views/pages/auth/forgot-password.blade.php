@extends('layouts.main')
@section('title', 'Quên mật khẩu')
@section('description', 'Quên mật khẩu')
@section('keywords', 'Quên mật khẩu')

@push('styles-main')
    <style>
        .logo_conduongbachu {
            height: 75px;
            object-fit: contain;
            transition: height 0.3s ease;
        }

        @media (max-width: 768px) {
            .logo_conduongbachu {
                height: 60px;
            }
        }

        @media (max-width: 576px) {
            .logo_conduongbachu {
                height: 50px;
            }
        }

        .cursor-pointer {
            cursor: pointer;
        }
        
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
                            <h1 class="auth-title">Bạn quên mật khẩu rồi à?</h1>
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

                        <form id="forgotForm">
                            <div class="form-email mb-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="name@example.com" required>
                                    <label for="email">Nhập email của bạn</label>
                                </div>
                            </div>

                            <div id="otpContainer" class="overflow-hidden text-center">
                                <!-- OTP inputs will be inserted here via JavaScript -->
                            </div>

                            <div id="passwordContainer"></div>

                            <div class="box-button">
                                <button type="submit" class="auth-btn btn w-100 mb-4" id="btn-send">
                                    Tiếp Tục
                                </button>
                            </div>

                            <div class="text-center">
                                <span>Bạn đã nhớ mật khẩu? </span>
                                <a href="{{ route('login') }}" class="auth-link text-decoration-none">Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-main')
    <script>
        $(document).ready(function() {
            $('#forgotForm').on('submit', function(e) {
                e.preventDefault();
                const emailInput = $('#email');
                const email = emailInput.val();
                const submitButton = $('#btn-send');

                // Xóa thông báo lỗi cũ nếu tồn tại
                const oldInvalidFeedback = emailInput.parent().find('.invalid-feedback');
                emailInput.removeClass('is-invalid');
                if (oldInvalidFeedback.length) {
                    oldInvalidFeedback.remove();
                }

                // Thay đổi nút submit thành trạng thái loading
                submitButton.prop('disabled', true);
                submitButton.html('<span class="loading-spinner"></span> Đang xử lý...');

                $.ajax({
                    url: '{{ route('forgot.password') }}',
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({
                        email: email
                    }),
                    success: function(response) {

                        if (response.status === 'success') {
                            showToast(response.message, 'success');
                            submitButton.remove();

                            $('.form-email').remove();

                            $('#otpContainer').html(`
                                <span class="text-center mb-1">${response.message}</span>
                                <div class="otp-container justify-content-center mb-3" id="input-otp">
                                    <input type="text" maxlength="1" class="otp-input" oninput="handleInput(this)" />
                                    <input type="text" maxlength="1" class="otp-input" oninput="handleInput(this)" />
                                    <input type="text" maxlength="1" class="otp-input" oninput="handleInput(this)" />
                                    <input type="text" maxlength="1" class="otp-input" oninput="handleInput(this)" />
                                    <input type="text" maxlength="1" class="otp-input" oninput="handleInput(this)" />
                                    <input type="text" maxlength="1" class="otp-input" oninput="handleInput(this)" />
                                    <br>
                                </div>
                            `);

                            $('.box-button').html(`
                                <button class="auth-btn btn w-100 mb-4" type="button" id="submitOtp">Tiếp tục</button>
                            `);

                            $('#submitOtp').on('click', function() {
                                const otpInputs = $('.otp-input');
                                const input_otp = $('#input-otp');

                                let otp = '';
                                otpInputs.each(function() {
                                    otp += $(this).val();
                                });

                                input_otp.find('.invalid-otp').remove();

                                removeInvalidFeedback(emailInput);

                                $.ajax({
                                    url: '{{ route('forgot.password') }}',
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    data: JSON.stringify({
                                        email: email,
                                        otp: otp,
                                    }),
                                    success: function(response) {

                                        if (response.status === 'success') {
                                            showToast(response.message,
                                                'success');
                                            $('#submitOtp').remove();
                                            $('#otpContainer').remove();

                                            $('#passwordContainer').html(`
                                                <div class="mb-4">
                                                    <span class="text-center d-block mb-3">${response.message}</span>
                                                    <div class="form-floating mb-3 position-relative">
                                                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                                                        <label for="password" class="form-label">Mật khẩu mới</label>
                                                        <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" id="togglePassword"></i>
                                                    </div>
                                                </div>
                                            `);

                                            $('.box-button').html(`
                                                <button class="auth-btn btn w-100 mb-4" type="button" id="submitPassword">Xác nhận</button>
                                            `);

                                            // Add toggle password functionality
                                            $('#togglePassword').on('click',
                                                function() {
                                                    const
                                                        passwordInput =
                                                        $('#password');
                                                    const type =
                                                        passwordInput
                                                        .attr(
                                                        'type') ===
                                                        'password' ?
                                                        'text' :
                                                        'password';
                                                    passwordInput.attr(
                                                        'type', type
                                                        );
                                                    $(this).toggleClass(
                                                        'fa-eye fa-eye-slash'
                                                        );
                                                });

                                            $('#submitPassword').on('click',
                                                function() {
                                                    const
                                                        passwordInput =
                                                        $('#password');
                                                    const password =
                                                        passwordInput
                                                        .val();

                                                    removeInvalidFeedback
                                                        (passwordInput);

                                                    $.ajax({
                                                        url: '{{ route('forgot.password') }}',
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        },
                                                        data: JSON
                                                            .stringify({
                                                                email: email,
                                                                otp: otp,
                                                                password: password
                                                            }),
                                                        success: function(
                                                            response
                                                            ) {
                                                            if (response
                                                                .status ===
                                                                'success'
                                                                ) {
                                                                showToast
                                                                    (response
                                                                        .message,
                                                                        'success'
                                                                        );
                                                                saveToast
                                                                    (response
                                                                        .message,
                                                                        response
                                                                        .status
                                                                        );
                                                                window
                                                                    .location
                                                                    .href =
                                                                    response
                                                                    .url;
                                                            } else {
                                                                showToast
                                                                    (response
                                                                        .message,
                                                                        'error'
                                                                        );
                                                            }
                                                        },
                                                        error: function(
                                                            xhr
                                                            ) {
                                                            const
                                                                response =
                                                                xhr
                                                                .responseJSON;

                                                            if (response &&
                                                                response
                                                                .status ===
                                                                'error'
                                                                ) {
                                                                if (response
                                                                    .message
                                                                    .password
                                                                    ) {
                                                                    response
                                                                        .message
                                                                        .password
                                                                        .forEach(
                                                                            error => {
                                                                                const
                                                                                    invalidFeedback =
                                                                                    $(
                                                                                        '<div class="invalid-feedback"></div>')
                                                                                    .text(
                                                                                        error
                                                                                        );
                                                                                passwordInput
                                                                                    .addClass(
                                                                                        'is-invalid'
                                                                                        )
                                                                                    .parent()
                                                                                    .append(
                                                                                        invalidFeedback
                                                                                        );
                                                                            }
                                                                            );
                                                                }
                                                            } else {
                                                                showToast
                                                                    ('Đã xảy ra lỗi, vui lòng thử lại.',
                                                                        'error'
                                                                        );
                                                            }
                                                        }
                                                    });
                                                });
                                        } else {
                                            showToast(response.message,
                                                'error');
                                        }
                                    },
                                    error: function(xhr) {
                                        const response = xhr.responseJSON;

                                        if (response && response.status ===
                                            'error') {
                                            if (response.message.email) {
                                                response.message.email
                                                    .forEach(error => {
                                                        const
                                                            invalidFeedback =
                                                            $(
                                                                '<div class="invalid-feedback"></div>')
                                                            .text(
                                                            error);
                                                        emailInput
                                                            .addClass(
                                                                'is-invalid'
                                                                )
                                                            .parent()
                                                            .append(
                                                                invalidFeedback
                                                                );
                                                    });
                                            }
                                            if (response.message.otp) {
                                                input_otp.append(
                                                    `<div class="invalid-otp text-danger fs-7">${response.message.otp[0]}</div>`
                                                    );
                                            }
                                        } else {
                                            showToast(
                                                'Đã xảy ra lỗi, vui lòng thử lại.',
                                                'error');
                                        }
                                    }
                                });
                            });
                        } else {
                            showToast(response.message, 'error');
                            submitButton.prop('disabled', false);
                            submitButton.html('Tiếp tục');
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;

                        if (response && response.message && response.message.email) {
                            response.message.email.forEach(error => {
                                const invalidFeedback = $(
                                    '<div class="invalid-feedback"></div>').text(
                                    error);
                                emailInput.addClass('is-invalid').parent().append(
                                    invalidFeedback);
                            });
                        } else {
                            showToast('Đã xảy ra lỗi, vui lòng thử lại.', 'error');
                        }
                        submitButton.prop('disabled', false);
                        submitButton.html('Tiếp tục');
                    }
                });
            });

            // Helper function to remove invalid feedback
            function removeInvalidFeedback(input) {
                const oldInvalidFeedback = input.parent().find('.invalid-feedback');
                input.removeClass('is-invalid');
                if (oldInvalidFeedback.length) {
                    oldInvalidFeedback.remove();
                }
            }
        });
    </script>
@endpush
