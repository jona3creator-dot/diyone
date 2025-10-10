/**
 * Testimonial Slider JavaScript
 * お客様の声スライダー専用スクリプト
 */

document.addEventListener('DOMContentLoaded', function() {
    initTestimonialSlider();
});

/**
 * お客様の声スライダー初期化
 */
function initTestimonialSlider() {
    let currentSlide = 0;
    const testimonials = document.querySelectorAll('.testimonial-item');
    const dots = document.querySelectorAll('.dot');
    const totalSlides = testimonials.length;

    // スライドがない場合は終了
    if (totalSlides === 0) {
        return;
    }

    /**
     * 指定されたスライドを表示
     */
    function showSlide(index) {
        testimonials.forEach((testimonial, i) => {
            testimonial.classList.toggle('active', i === index);
        });
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    /**
     * 次のスライドへ
     */
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    /**
     * 前のスライドへ
     */
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    // ナビゲーションボタン
    const nextBtn = document.querySelector('.slider-btn.next');
    const prevBtn = document.querySelector('.slider-btn.prev');
    
    if (nextBtn) {
        nextBtn.addEventListener('click', nextSlide);
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', prevSlide);
    }

    // ドットナビゲーション
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // 自動スライド（5秒間隔）
    setInterval(nextSlide, 5000);

    // 初期表示
    showSlide(currentSlide);
}