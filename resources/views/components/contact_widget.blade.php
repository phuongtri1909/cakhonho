<style>
    .social-icons {
        position: fixed;
        bottom: 47px;
        right: 24px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 9999;
    }

    .social-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background-color: var(--primary-color-6);
        color: white;
        border-radius: 50%;
        text-decoration: none;
        transition: transform 0.3s, background 0.3s, box-shadow 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        animation: pulseAttention 2s infinite;
    }

    /* Animation hiệu ứng nhấp nháy nhẹ */
    @keyframes pulseAttention {
        0% { transform: scale(1); }
        5% { transform: scale(1.1); }
        10% { transform: scale(1); }
        15% { transform: scale(1.1); }
        20% { transform: scale(1); }
        100% { transform: scale(1); }
    }

    /* Hiệu ứng rung lắc khi hover */
    .social-icon:hover {
        background-color: var(--primary-color-2);
        animation: shakeIcon 0.5s ease-in-out;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transform: translateY(-3px);
    }

    @keyframes shakeIcon {
        0% { transform: rotate(0deg); }
        25% { transform: rotate(10deg); }
        50% { transform: rotate(-10deg); }
        75% { transform: rotate(5deg); }
        100% { transform: rotate(0deg); }
    }

    /* Hiệu ứng nổi bật cho icon đầu tiên */
    .social-icons a:first-child {
        animation: wiggleAttention 3s infinite;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
    }

    @keyframes wiggleAttention {
        0% { transform: rotate(0deg) scale(1); }
        85% { transform: rotate(0deg) scale(1); }
        90% { transform: rotate(10deg) scale(1.15); }
        92% { transform: rotate(-10deg) scale(1.15); }
        94% { transform: rotate(10deg) scale(1.15); }
        96% { transform: rotate(-10deg) scale(1.15); }
        98% { transform: rotate(5deg) scale(1.1); }
        100% { transform: rotate(0deg) scale(1); }
    }

    /* Hiệu ứng đổi màu cho biểu tượng */
    .social-icon i, .social-icon span {
        animation: colorChange 8s infinite;
        font-size: 1.2rem;
    }

    @keyframes colorChange {
        0% { color: white; }
        50% { color: rgba(255, 255, 255, 0.7); }
        100% { color: white; }
    }
    
    /* Hiệu ứng phát sáng xung quanh */
    .social-icon::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: var(--primary-color-3);
        z-index: -1;
        opacity: 0.6;
        animation: glowEffect 2s infinite;
    }
    
    @keyframes glowEffect {
        0% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.3); opacity: 0; }
        100% { transform: scale(1); opacity: 0; }
    }

    /* Responsive: Điều chỉnh kích thước khi màn hình nhỏ */
    @media (max-width: 767px) {
        .social-icons {
            bottom: 20px;
            right: 15px;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
        }
    }
</style>


<div class="social-icons mb-3 py-3">
    @forelse($socials as $social)
        <a href="{{ $social->url }}" target="_blank" class="social-icon" aria-label="{{ $social->name }}">
            @if (strpos($social->icon, 'custom-') === 0)
                <span class="{{ $social->icon }}"></span>
            @else
                <i class="{{ $social->icon }}"></i>
            @endif
        </a>
    @empty
        <a href="https://facebook.com" target="_blank" class="social-icon" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="mailto:contact@pinknovel.com" target="_blank" class="social-icon" aria-label="Email">
            <i class="fas fa-envelope"></i>
        </a>
    @endforelse
</div>
