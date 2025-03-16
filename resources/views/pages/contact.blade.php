@extends('layouts.app')

@section('title', 'Về Tác Giả Phùng Bảo Ngọc')

@section('description', 'Tìm hiểu về tác giả Phùng Bảo Ngọc - Content Marketing, Tarot Reader & Manifestation Guide.')
@section('keyword', 'phung bao ngoc, hanlamngoc, hanlamngoc.com, content marketing, tarot reader, manifestation guide')

@section('content')
    <div class="contact-page">
        <!-- Hero Section -->
        <section class="contact-hero">
            <div class="hero-background">
                <div class="hero-overlay"></div>
                <img src="{{ asset('assets/images/information/author-profile4.jpg') }}" alt="Phùng Bảo Ngọc" class="hero-bg-image">
            </div>
            <div class="container position-relative">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="contact-title animated-element" data-animation="fadeInDown">
                            <span class="text-primary">Phùng</span> <span class="title-highlight">Bảo Ngọc</span>
                        </h1>
                        <p class="lead contact-subtitle animated-element" data-animation="fadeIn" data-delay="200">
                            Content Marketing • Tarot Reader • Manifestation Guide
                        </p>
                        <div class="contact-divider animated-element" data-animation="scaleX"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 animated-element" data-animation="fadeInLeft">
                        <div class="author-image-container">
                            <img src="{{ asset('assets/images/information/author-profile6.jpg') }}" alt="Phùng Bảo Ngọc"
                                class="img-fluid rounded-4 shadow-lg">
                            <div class="zodiac-sign">♏ Bọ Cạp</div>
                        </div>
                    </div>
                    <div class="col-lg-7 animated-element" data-animation="fadeInRight">
                        <h2 class="section-title mb-4">Về Tôi</h2>
                        <div class="author-facts mb-4">
                            <div class="author-fact">
                                <i class="fas fa-birthday-cake"></i>
                                <span>01/11/2000</span>
                            </div>
                            <div class="author-fact">
                                <i class="fas fa-heart"></i>
                                <span>Đã kết hôn</span>
                            </div>
                            <div class="author-fact">
                                <i class="fas fa-briefcase"></i>
                                <span>Content Marketing</span>
                            </div>
                        </div>

                        <div class="author-quote mb-4">
                            <i class="fas fa-quote-left quote-icon"></i>
                            <p class="quote-text">Khi yêu, đừng nghe theo trái tim, vì trái tim có thể lạc lối. Đừng nghe
                                theo lý trí, vì lý trí có thể bị đánh lừa. Hãy lắng nghe linh hồn mình... vì linh hồn luôn
                                biết câu trả lời.</p>
                        </div>

                        <p class="text-muted">
                            Chào các đồng môn! Tôi là Phùng Bảo Ngọc - người đam mê văn chương và những câu chuyện tình yêu
                            có chiều sâu.
                            Ngoài công việc chính là Content Marketing, tôi còn là một Tarot Reader và Manifestation Guide
                            trong thời gian rảnh.
                        </p>

                        <div class="writing-style mt-4 p-3 bg-light rounded-3">
                            <h5 class="mb-3"><i class="fas fa-pen-fancy me-2 text-primary"></i>Phong Cách Viết</h5>
                            <p class="mb-1"><i class="fas fa-check text-success me-2"></i>Nhân vật nữ chính có đức hạnh,
                                thông minh</p>
                            <p class="mb-1"><i class="fas fa-check text-success me-2"></i>Nam chính trí tuệ, thâm sâu</p>
                            <p class="mb-1"><i class="fas fa-check text-success me-2"></i>Ngược trước sủng sau</p>
                            <p class="mb-1"><i class="fas fa-check text-success me-2"></i>H văn 1 vs 1</p>
                            <p class="mb-1"><i class="fas fa-check text-success me-2"></i>Tình yêu có chiều sâu</p>
                            <p class="mb-0"><i class="fas fa-heart text-danger me-2"></i>Luôn là HE (Happy Ending)</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Author Philosophy Section -->
        <section class="philosophy-section py-5 bg-light">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-lg-12">
                        <h2 class="section-title animated-element" data-animation="fadeInUp">Thế Giới Của Tôi</h2>
                        <div class="contact-divider mx-auto animated-element" data-animation="scaleX" data-delay="200">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="philosophy-content animated-element" data-animation="fadeInUp" data-delay="300">
                            <p class="lead mb-4">
                                📖 Chào mừng bạn đến với thế giới của tôi 📖
                            </p>

                            <p>Nếu bạn đã bước vào đây, có lẽ bạn cũng như tôi – yêu những câu chuyện ngôn tình mang chiều
                                sâu, những mối quan hệ giằng xé giữa yêu thương và tổn thương.</p>

                            <p>Tôi viết về những con người lạc lối giữa linh hồn mình, loay hoay tìm kiếm bản thân trong
                                những tổn thương. Tôi viết về những tình yêu không một màu là ngọt ngào hay bi thương, mà là
                                sự va chạm của hai linh hồn, là đấu tranh, là cứu rỗi, là những vết sẹo chẳng thể nào xóa
                                mờ. Nhưng sau tất cả, khi họ dám thành thật với chính mình, họ mới có thể chạm đến tình yêu.
                            </p>

                            <div class="philosophy-cards mt-5">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="philosophy-card animated-element" data-animation="fadeInUp"
                                            data-delay="400">
                                            <div class="card-icon">
                                                <i class="fas fa-heart-broken"></i>
                                            </div>
                                            <h4>Tổn Thương & Hàn Gắn</h4>
                                            <p>Có những tình yêu phải đi qua đổ vỡ mới học được cách trân trọng. Có những
                                                con người chỉ khi đánh mất bản thân rồi mới tìm lại chính mình.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="philosophy-card animated-element" data-animation="fadeInUp"
                                            data-delay="500">
                                            <div class="card-icon">
                                                <i class="fas fa-balance-scale"></i>
                                            </div>
                                            <h4>Sự Cân Bằng</h4>
                                            <p>Tình yêu vẫn luôn đẹp đẽ và thiêng liêng. Không phải vì nó hoàn hảo, mà vì nó
                                                là sự cân bằng giữa việc giữ lấy và buông tay.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="philosophy-card animated-element" data-animation="fadeInUp"
                                            data-delay="600">
                                            <div class="card-icon">
                                                <i class="fas fa-dove"></i>
                                            </div>
                                            <h4>Sự Cứu Rỗi</h4>
                                            <p>Có những mối quan hệ tưởng như là gông xiềng, lại hóa thành nơi chở che duy
                                                nhất. Tôi tin rằng ai cũng khao khát được yêu thương một cách chân thành
                                                nhất.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tarot & Services Section -->
        <section class="services-section py-5">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <h2 class="section-title animated-element" data-animation="fadeInUp">Dịch Vụ Tarot</h2>
                        <p class="lead text-muted animated-element" data-animation="fadeInUp" data-delay="200">
                            Ngoài sáng tác, tôi còn cung cấp dịch vụ đọc bài Tarot và hướng dẫn Manifestation
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="services-card tarot-card animated-element" data-animation="fadeInLeft">
                            <div class="services-card-inner">
                                <div class="services-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3>Tarot Reader</h3>
                                <p>Với kinh nghiệm đọc bài Tarot, tôi sẽ giúp bạn tìm hiểu sâu hơn về bản thân, về những mối
                                    quan hệ và về con đường sắp tới của bạn. Bài Tarot là công cụ kết nối bạn với tiềm thức
                                    và trí tuệ cao hơn.</p>
                                <div class="services-features">
                                    <div class="feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Tình yêu và các mối quan hệ</span>
                                    </div>
                                    <div class="feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Sự nghiệp và định hướng tương lai</span>
                                    </div>
                                    <div class="feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Những thách thức và cơ hội</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="services-card manifestation-card animated-element" data-animation="fadeInRight">
                            <div class="services-card-inner">
                                <div class="services-icon">
                                    <i class="fas fa-magic"></i>
                                </div>
                                <h3>Manifestation Guide</h3>
                                <p>Tôi sẽ hướng dẫn bạn các phương pháp Manifestation hiệu quả để thu hút những điều bạn
                                    mong muốn vào cuộc sống. Đây không phải phép màu, mà là quá trình làm việc với năng
                                    lượng và tiềm thức của chính bạn.</p>
                                <div class="services-features">
                                    <div class="feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Xây dựng mindset tích cực</span>
                                    </div>
                                    <div class="feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Vượt qua rào cản tiềm thức</span>
                                    </div>
                                    <div class="feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Kỹ thuật visualization và affirmation</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <h2 class="section-title animated-element" data-animation="fadeInUp">Kết Nối Với Tôi</h2>
                        <p class="lead text-muted animated-element" data-animation="fadeInUp" data-delay="200">
                            Bạn có câu hỏi hoặc muốn trao đổi về công việc? Hãy liên hệ với tôi!
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="contact-info-card animated-element" data-animation="fadeInLeft">
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-details">
                                    <h3>Địa Chỉ</h3>
                                    <p>Hoàng Mai, Hà Nội</p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <h3>Email</h3>
                                    <p>hanlamngoc111@gmail.com</p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <div class="contact-details">
                                    <h3>Instagram</h3>
                                    <p><a href="https://www.instagram.com/soulmatetarot.111/" target="_blank"
                                            class="text-white">@soulmatetarot.111</a></p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fab fa-facebook"></i>
                                </div>
                                <div class="contact-details">
                                    <h3>Facebook</h3>
                                    <p><a href="https://www.facebook.com/hanlamngoc0111/" target="_blank"
                                            class="text-white">@hanlamngoc0111</a></p>
                                </div>
                            </div>

                            <div class="contact-social mt-4">
                                <h3>Kết Nối</h3>
                                <div class="social-icons">
                                    <a href="https://www.facebook.com/hanlamngoc0111/" class="social-icon-lg"
                                        target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.instagram.com/soulmatetarot.111/" class="social-icon-lg"
                                        target="_blank"><i class="fab fa-instagram"></i></a>
                                    <a href="mailto:hanlamngoc111@gmail.com" class="social-icon-lg"><i
                                            class="fas fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 animated-element" data-animation="fadeInRight">
                        <div class="author-gallery-card">
                            <h3 class="mb-4">Hình Ảnh <span class="text-primary">Của Tôi</span></h3>

                            <div class="author-gallery">
                                <div class="row g-3">
                                    <!-- Gallery Images -->
                                    @for ($i = 1; $i <= 9; $i++)
                                        <div class="col-md-4 col-6">
                                            <div class="gallery-item" data-bs-toggle="modal" data-bs-target="#imageModal"
                                                data-image="{{ asset('assets/images/information/author-profile' . $i . '.jpg') }}">
                                                <img src="{{ asset('assets/images/information/author-profile' . $i . '.jpg') }}"
                                                    alt="Phùng Bảo Ngọc" class="img-fluid rounded-3 gallery-img">
                                                <div class="gallery-overlay">
                                                    <div class="gallery-icon">
                                                        <i class="fas fa-expand-alt"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <p class="text-muted mt-4">
                                    <i class="fas fa-camera me-2"></i> Khám phá thêm về hành trình sáng tạo của tôi qua
                                    những khoảnh khắc này
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Image Modal -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-dark">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title text-white" id="imageModalLabel">Phùng Bảo Ngọc</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center p-0">
                                    <img src="" alt="Full size image" class="img-fluid modal-image">
                                </div>
                                <div class="modal-footer border-0">
                                    <div class="modal-counter text-white">
                                        <span id="currentImageNum">1</span>/<span id="totalImages">9</span>
                                    </div>
                                    <div class="modal-nav">
                                        <button class="btn btn-outline-light btn-sm me-2" id="prevImage">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="btn btn-outline-light btn-sm" id="nextImage">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>
        /* Hero Section */
        .contact-hero {
            padding: 120px 0 60px;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1639186647524-146464308b23?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80') center/cover;
            color: white;
            text-align: center;
            position: relative;
        }

        .contact-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .title-highlight {
            position: relative;
            z-index: 1;
        }

        .title-highlight::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: -5px;
            right: -5px;
            height: 12px;
            background-color: rgba(var(--bs-primary-rgb), 0.3);
            z-index: -1;
            transform: rotate(-1deg);
        }

        .contact-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .contact-divider {
            width: 80px;
            height: 4px;
            background: var(--bs-primary);
            margin: 2rem auto;
        }

        /* Author Section Styling */
        .author-image-container {
            position: relative;
        }

        .zodiac-sign {
            position: absolute;
            bottom: -15px;
            right: 20px;
            background: var(--bs-primary);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .author-facts {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .author-fact {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            background: #f8f9fa;
            border-radius: 20px;
            font-size: 0.95rem;
        }

        .author-fact i {
            color: var(--bs-primary);
            margin-right: 8px;
        }

        .author-quote {
            position: relative;
            padding: 20px 30px;
            background: #f8f9fa;
            border-left: 4px solid var(--bs-primary);
            border-radius: 8px;
            font-style: italic;
        }

        .quote-icon {
            position: absolute;
            top: -15px;
            left: 20px;
            font-size: 2rem;
            color: rgba(var(--bs-primary-rgb), 0.2);
        }

        .quote-text {
            position: relative;
            z-index: 1;
            margin: 0;
        }

        /* Section Styling */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
        }

        /* Philosophy Section */
        .philosophy-content {
            padding: 20px;
        }

        .philosophy-content p {
            line-height: 1.8;
            color: #555;
        }

        .philosophy-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            height: 100%;
            transition: all 0.3s ease;
        }

        .philosophy-card:hover {
            transform: translateY(-10px);
        }

        .card-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: rgba(var(--bs-primary-rgb), 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--bs-primary);
            transition: all 0.3s ease;
        }

        .philosophy-card:hover .card-icon {
            background: var(--bs-primary);
            color: white;
        }

        .philosophy-card h4 {
            font-size: 1.25rem;
            margin-bottom: 15px;
            text-align: center;
        }

        .philosophy-card p {
            font-size: 0.95rem;
            text-align: center;
            color: #666;
        }

        /* Services Section */
        .services-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: all 0.3s ease;
        }

        .services-card-inner {
            padding: 40px;
            color: white;
        }

        .tarot-card {
            background: linear-gradient(45deg, #8e44ad 0%, #9b59b6 100%);
        }

        .manifestation-card {
            background: linear-gradient(45deg, #3498db 0%, #2980b9 100%);
        }

        .services-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .services-card h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .services-card p {
            opacity: 0.9;
            margin-bottom: 25px;
        }

        .services-features {
            margin-top: 20px;
        }

        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .feature i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* Contact Info */
        .contact-info-card {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            color: white;
            height: 100%;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 20px;
        }

        .contact-details h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .contact-details p {
            opacity: 0.9;
            margin-bottom: 0;
        }

        .contact-details a {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-details a:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        .contact-social h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
        }

        .social-icon-lg {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-icon-lg:hover {
            background: white;
            color: #9b59b6;
            transform: translateY(-5px);
        }

        /* Contact Form */
        .contact-form-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .form-floating>label {
            padding-left: 1rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 1rem;
            border: 1px solid #e1e5ea;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.15);
        }

        /* Books Section */
        .books-section {
            background: rgba(var(--bs-primary-rgb), 0.05);
        }

        /* Animations */
        .animated-element {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .animated-element.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Add additional styles for the enhanced features */

        /* Moving stars for Tarot section */
        .stars-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: twinkle 3s infinite ease-in-out;
            opacity: 0;
        }

        @keyframes twinkle {
            0% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 0.8;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(0);
            }
        }

        /* Enhanced book animation */
        .rotating-book {
            animation: rotate 4s infinite ease-in-out;
            transform-origin: center center;
            display: inline-block;
        }

        @keyframes rotate {
            0% {
                transform: rotate(-5deg);
            }

            50% {
                transform: rotate(5deg);
            }

            100% {
                transform: rotate(-5deg);
            }
        }

        /* Enhanced animation for cards */
        .philosophy-card:hover {
            transform: translateY(-10px) rotate(1deg);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* Special animation for zodiac sign */
        .zodiac-sign {
            animation: pulse 2s infinite ease-in-out;
            cursor: pointer;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Add horizontal scroll for author facts on mobile */
        @media (max-width: 768px) {
            .author-facts {
                display: flex;
                overflow-x: auto;
                padding-bottom: 10px;
                scroll-behavior: smooth;
            }

            .author-fact {
                flex: 0 0 auto;
                white-space: nowrap;
            }
        }

        /* Enhanced mobile styling */
        @media (max-width: 576px) {
            .contact-title {
                font-size: 2.5rem;
            }

            .services-card-inner {
                padding: 25px;
            }

            .contact-info-card {
                padding: 25px;
            }

            .contact-form-card {
                padding: 25px;
            }
        }

        /* Animation for the contact form */
        .form-control:focus {
            transform: translateY(-3px);
        }

        /* Better highlight for form fields */
        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: var(--bs-primary);
            font-weight: 500;
        }

        /* Better styling for the submit button */
        .btn-primary {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
            z-index: -1;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        /* Add tooltip for social links */
        .social-icon-lg {
            position: relative;
        }

        .social-icon-lg::after {
            content: attr(data-tooltip);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%) scale(0);
            background: white;
            color: #333;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            opacity: 0;
            transition: all 0.2s ease;
            white-space: nowrap;
            pointer-events: none;
        }

        .social-icon-lg:hover::after {
            transform: translateX(-50%) scale(1);
            opacity: 1;
        }

        /* Enhanced styling for the author quote */
        .author-quote {
            position: relative;
            overflow: hidden;
        }

        .author-quote::after {
            content: '"';
            position: absolute;
            bottom: -20px;
            right: 20px;
            font-size: 4rem;
            color: rgba(var(--bs-primary-rgb), 0.1);
            font-family: serif;
        }

        /* Enhanced scroll animation */
        @keyframes scaleX {
            from {
                transform: scaleX(0);
            }

            to {
                transform: scaleX(1);
            }
        }

        /* Add new animation for the services cards */
        .services-card:hover {
            transform: translateY(-10px);
        }

        .services-card-inner {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .services-card-inner::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            opacity: 0;
            transition: all 0.6s ease;
            z-index: -1;
            transform: scale(0.5);
        }

        .services-card:hover .services-card-inner::after {
            opacity: 1;
            transform: scale(1);
        }

        /* Update Hero Section with better background */
        .contact-hero {
            padding: 120px 0 60px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7));
            z-index: 1;
        }
        
        .hero-bg-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            filter: blur(3px);
            transform: scale(1.05);
        }
        
        /* Author Gallery Styling */
        .author-gallery-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            height: 100%;
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
            height: 140px;
            transition: all 0.3s ease;
        }
        
        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(var(--bs-primary-rgb), 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .gallery-icon {
            color: white;
            font-size: 1.2rem;
            transform: scale(0);
            transition: all 0.3s ease;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .gallery-item:hover .gallery-icon {
            transform: scale(1);
        }
        
        .gallery-item:hover .gallery-img {
            transform: scale(1.1);
        }
        
        /* Modal Styling */
        .modal-image {
            max-height: 80vh;
        }
        
        .modal-counter {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .modal-nav {
            display: flex;
            align-items: center;
        }
        
        @media (max-width: 576px) {
            .gallery-item {
                height: 100px;
            }
            
            .author-gallery-card {
                padding: 25px;
            }
        }
        
        /* Add shadow to author image in about section */
        .author-image-container img {
            transition: all 0.5s ease;
        }
        
        .author-image-container:hover img {
            transform: scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2) !important;
        }

        /* Define custom theme colors with pink and blue */
        :root {
            --theme-pink: #FF73B3;
            --theme-pink-light: #FFD6E7;
            --theme-pink-dark: #D94D8A;
            --theme-blue: #73B4FF;
            --theme-blue-light: #D6EBFF;
            --theme-blue-dark: #3A77C9;
            --gradient-pink-blue: linear-gradient(45deg, var(--theme-pink) 0%, var(--theme-blue) 100%);
        }
        
        /* Update primary color references */
        .text-primary {
            color: var(--theme-pink) !important;
        }
        
        /* Update hero section */
        .contact-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset("assets/images/information/author-profile4.jpg") }}') center/cover;
        }
        
        .title-highlight::after {
            background-color: rgba(255, 115, 179, 0.3);
        }
        
        .contact-divider {
            background: var(--theme-pink);
        }
        
        /* Update zodiac sign */
        .zodiac-sign {
            background: var(--theme-pink);
        }
        
        /* Update author fact icons */
        .author-fact i {
            color: var(--theme-pink);
        }
        
        /* Update author quote */
        .author-quote {
            border-left: 4px solid var(--theme-pink);
        }
        
        .quote-icon {
            color: rgba(255, 115, 179, 0.2);
        }
        
        /* Update writing style section */
        .writing-style h5 i {
            color: var(--theme-pink) !important;
        }
        
        /* Update philosophy cards */
        .card-icon {
            background: rgba(255, 115, 179, 0.1);
            color: var(--theme-pink);
        }
        
        .philosophy-card:hover .card-icon {
            background: var(--theme-pink);
        }
        
        /* Update service cards */
        .tarot-card {
            background: linear-gradient(45deg, var(--theme-pink-dark) 0%, var(--theme-pink) 100%);
        }
        
        .manifestation-card {
            background: linear-gradient(45deg, var(--theme-blue) 0%, var(--theme-blue-dark) 100%);
        }
        
        /* Update contact info card */
        .contact-info-card {
            background: linear-gradient(135deg, var(--theme-pink) 0%, var(--theme-pink-dark) 100%);
        }
        
        /* Update social icons hover */
        .social-icon-lg:hover {
            background: white;
            color: var(--theme-pink);
        }
        
        /* Update form styling */
        .form-control:focus {
            border-color: var(--theme-pink);
            box-shadow: 0 0 0 0.25rem rgba(255, 115, 179, 0.15);
        }
        
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--theme-pink);
        }
        
        /* Update button styling */
        .btn-primary {
            background-color: var(--theme-pink);
            border-color: var(--theme-pink-dark);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--theme-pink-dark);
            border-color: var(--theme-pink-dark);
        }
        
        /* Update gallery overlay */
        .gallery-overlay {
            background: rgba(255, 115, 179, 0.6);
        }
        
        /* Add pink-blue gradient to some elements */
        .author-quote::after {
            color: rgba(255, 115, 179, 0.1);
        }
        
        /* Enhanced styling for pink-blue theme */
        .section-title span {
            background: linear-gradient(to right, var(--theme-pink), var(--theme-blue));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* Add blue accents to balance the pink */
        .philosophy-card:nth-child(2) .card-icon {
            background: rgba(115, 180, 255, 0.1);
            color: var(--theme-blue);
        }
        
        .philosophy-card:nth-child(2):hover .card-icon {
            background: var(--theme-blue);
            color: white;
        }
        
        .philosophy-card:nth-child(3) .card-icon {
            background: linear-gradient(45deg, rgba(255, 115, 179, 0.1), rgba(115, 180, 255, 0.1));
            color: var(--theme-pink-dark);
        }
        
        .philosophy-card:nth-child(3):hover .card-icon {
            background: linear-gradient(45deg, var(--theme-pink), var(--theme-blue));
            color: white;
        }
        
        /* Enhance the hero overlay with blue-pink gradient */
        .hero-overlay {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(58, 119, 201, 0.3), rgba(217, 77, 138, 0.3));
        }
        
        /* Add blue-pink shadow to author image */
        .author-image-container img {
            box-shadow: 0 10px 30px rgba(255, 115, 179, 0.2), 0 10px 30px rgba(115, 180, 255, 0.2) !important;
        }
        
        .author-image-container:hover img {
            box-shadow: 0 15px 40px rgba(255, 115, 179, 0.3), 0 15px 40px rgba(115, 180, 255, 0.3) !important;
        }
        
        /* Additional stylistic elements */
        .services-icon {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        .contact-section {
            background: linear-gradient(45deg, var(--theme-blue-light) 0%, var(--theme-pink-light) 100%) !important;
        }
        
        /* Add blue accents to the gallery */
        .author-gallery-card {
            border-top: 4px solid var(--theme-blue);
            border-bottom: 4px solid var(--theme-pink);
        }
        
        /* Style the modal with pink-blue theme */
        .modal-content {
            background: linear-gradient(to bottom, #222, #1a1a1a) !important;
            border: none !important;
        }
        
        .modal-header {
            border-bottom: 2px solid var(--theme-pink) !important;
        }
        
        .modal-title {
            background: linear-gradient(to right, var(--theme-pink), var(--theme-blue));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent !important;
        }
        
        .btn-outline-light:hover {
            background-color: var(--theme-pink) !important;
            border-color: var(--theme-pink) !important;
        }
        
        /* Add alternating pink-blue animation to zodiac sign */
        @keyframes pulse-colors {
            0% { background: var(--theme-pink); transform: scale(1); }
            50% { background: var(--theme-blue); transform: scale(1.05); }
            100% { background: var(--theme-pink); transform: scale(1); }
        }
        
        .zodiac-sign {
            animation: pulse-colors 4s infinite ease-in-out;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation for elements when they come into view
            const animatedElements = document.querySelectorAll('.animated-element');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const animation = element.dataset.animation;
                        const delay = element.dataset.delay || 0;

                        setTimeout(() => {
                            element.classList.add('visible');

                            if (animation) {
                                element.style.animation = `${animation} 0.8s ease forwards`;
                            }
                        }, delay);

                        observer.unobserve(element);
                    }
                });
            }, {
                threshold: 0.1
            });

            animatedElements.forEach(element => {
                observer.observe(element);
            });

            // Counter animation
            const counters = document.querySelectorAll('.counter');
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = parseInt(counter.getAttribute('data-target'));
                        const duration = 2000; // Animation duration in ms

                        let startTime = null;

                        function updateCounter(timestamp) {
                            if (!startTime) startTime = timestamp;
                            const progress = timestamp - startTime;
                            const percentage = Math.min(progress / duration, 1);

                            const value = Math.floor(percentage * target);
                            counter.innerText = value.toLocaleString();

                            if (percentage < 1) {
                                requestAnimationFrame(updateCounter);
                            } else {
                                counter.innerText = target.toLocaleString();
                            }
                        }

                        requestAnimationFrame(updateCounter);
                        counterObserver.unobserve(counter);
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(counter => {
                counterObserver.observe(counter);
            });

            // Contact Form Submission
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Get form data
                    const name = document.getElementById('name').value;
                    const email = document.getElementById('email').value;
                    const subject = document.getElementById('subject').value;
                    const message = document.getElementById('message').value;

                    // Form validation
                    if (!name || !email || !subject || !message) {
                        showToast('Vui lòng điền đầy đủ thông tin', 'error');
                        return;
                    }

                    // Show loading state
                    const submitBtn = contactForm.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang gửi...';

                    // Simulate API call
                    // In real implementation, replace this with actual AJAX call
                    setTimeout(() => {
                        // Reset form
                        contactForm.reset();

                        // Reset button
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;

                        // Show success message
                        showToast('Tin nhắn của bạn đã được gửi thành công!', 'success');
                    }, 1500);

                    // For real implementation:
                    /*
                    fetch('/api/contact', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ name, email, subject, message })
                    })
                    .then(response => response.json())
                    .then(data => {
                        contactForm.reset();
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                        showToast(data.message || 'Tin nhắn của bạn đã được gửi thành công!', 'success');
                    })
                    .catch(error => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                        showToast('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
                        console.error('Error:', error);
                    });
                    */
                });
            }

            // Add parallax effect to hero section
            window.addEventListener('scroll', function() {
                const scrollY = window.scrollY;
                const heroSection = document.querySelector('.contact-hero');
                if (heroSection) {
                    heroSection.style.backgroundPosition = `center ${scrollY * 0.3}px`;
                }
            });

            // Add moving stars to the tarot section
            const servicesSection = document.querySelector('.services-section');
            if (servicesSection) {
                const starsCount = 50;
                const starsContainer = document.createElement('div');
                starsContainer.className = 'stars-background';
                servicesSection.appendChild(starsContainer);

                for (let i = 0; i < starsCount; i++) {
                    const star = document.createElement('div');
                    star.className = 'star';
                    star.style.top = `${Math.random() * 100}%`;
                    star.style.left = `${Math.random() * 100}%`;
                    star.style.animationDuration = `${Math.random() * 3 + 2}s`;
                    star.style.animationDelay = `${Math.random() * 2}s`;
                    starsContainer.appendChild(star);
                }
            }

            // Add book animation in the books section
            const bookSection = document.querySelector('.books-section');
            if (bookSection) {
                const bookContainer = document.querySelector('.books-slider');
                if (bookContainer) {
                    const bookIcon = bookContainer.querySelector('.fas.fa-book');
                    if (bookIcon) {
                        bookIcon.classList.add('rotating-book');
                    }
                }
            }
        });
    </script>
    <script>
        // Add this to your existing script section
        
        // Image Gallery Modal Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const imageModal = document.getElementById('imageModal');
            if (imageModal) {
                const modalImage = imageModal.querySelector('.modal-image');
                const currentImageNum = document.getElementById('currentImageNum');
                const totalImages = document.getElementById('totalImages');
                const prevBtn = document.getElementById('prevImage');
                const nextBtn = document.getElementById('nextImage');
                
                let allImages = [];
                let currentIndex = 0;
                
                // Get all gallery items
                document.querySelectorAll('.gallery-item').forEach(item => {
                    const imageSrc = item.getAttribute('data-image');
                    allImages.push(imageSrc);
                    
                    // Add click event to open modal
                    item.addEventListener('click', function() {
                        const clickedSrc = this.getAttribute('data-image');
                        currentIndex = allImages.indexOf(clickedSrc);
                        updateModalImage();
                    });
                });
                
                // Update total images count
                if (totalImages) {
                    totalImages.textContent = allImages.length;
                }
                
                // Update modal image and counter
                function updateModalImage() {
                    modalImage.src = allImages[currentIndex];
                    if (currentImageNum) {
                        currentImageNum.textContent = currentIndex + 1;
                    }
                }
                
                // Previous image button
                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        currentIndex = (currentIndex > 0) ? currentIndex - 1 : allImages.length - 1;
                        updateModalImage();
                    });
                }
                
                // Next image button
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        currentIndex = (currentIndex < allImages.length - 1) ? currentIndex + 1 : 0;
                        updateModalImage();
                    });
                }
                
                // Keyboard navigation
                document.addEventListener('keydown', function(e) {
                    if (imageModal.classList.contains('show')) {
                        if (e.key === 'ArrowLeft') {
                            currentIndex = (currentIndex > 0) ? currentIndex - 1 : allImages.length - 1;
                            updateModalImage();
                        } else if (e.key === 'ArrowRight') {
                            currentIndex = (currentIndex < allImages.length - 1) ? currentIndex + 1 : 0;
                            updateModalImage();
                        } else if (e.key === 'Escape') {
                            const bsModal = bootstrap.Modal.getInstance(imageModal);
                            if (bsModal) {
                                bsModal.hide();
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
