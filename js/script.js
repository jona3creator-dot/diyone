// DIYONE WordPress Theme JavaScript ver.1.1.6
// 究極修正版：根本的解決 - 完全に異なるアプローチ

document.addEventListener('DOMContentLoaded', function() {
    // 重複実行防止
    if (window.diyoneServiceCardsInitialized) {
        return;
    }
    window.diyoneServiceCardsInitialized = true;
    
    console.log('🚀 DIYONE Service Cards Initializing...');
    
    // 他の機能の初期化
    initSmoothScroll();
    initFadeInAnimation();
    initHeaderScroll();
    initBackToTop();
    initMobileMenu();
    initTestimonialsSlider();
    initResponsive();
    
    // サービスカードの初期化（遅延実行）
    setTimeout(initServiceCardsUltimate, 100);
});

// サービスカード究極修正版
function initServiceCardsUltimate() {
    const serviceCards = document.querySelectorAll('.service-card');
    
    if (serviceCards.length === 0) {
        console.warn('⚠️ No service cards found');
        return;
    }
    
    console.log(`🔧 Found ${serviceCards.length} service cards`);
    
    // 現在開いているカードのインデックスを追跡
    let currentOpenCard = null;
    
    serviceCards.forEach((card, index) => {
        const cardId = `service-${index}`;
        card.setAttribute('data-service-id', cardId);
        
        const toggle = card.querySelector('.service-toggle');
        const content = card.querySelector('.service-content');
        
        if (!toggle || !content) {
            console.warn(`⚠️ Missing elements in card ${index}`);
            return;
        }
        
        // 初期状態を強制設定
        resetCard(card, toggle, content);
        
        // クリックイベント（イベント委譲を使用）
        card.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            
            console.log(`🖱️ Card ${index} clicked, current open: ${currentOpenCard}`);
            
            // 現在開いているカードがある場合は閉じる
            if (currentOpenCard !== null && currentOpenCard !== index) {
                const openCard = serviceCards[currentOpenCard];
                const openToggle = openCard.querySelector('.service-toggle');
                const openContent = openCard.querySelector('.service-content');
                closeCard(openCard, openToggle, openContent);
                console.log(`🔒 Closed card ${currentOpenCard}`);
            }
            
            // クリックしたカードを処理
            if (currentOpenCard === index) {
                // 既に開いているカードをクリック → 閉じる
                closeCard(card, toggle, content);
                currentOpenCard = null;
                console.log(`🔒 Closed card ${index}`);
            } else {
                // 閉じているカードをクリック → 開く
                openCard(card, toggle, content);
                currentOpenCard = index;
                console.log(`🔓 Opened card ${index}`);
            }
        });
    });
    
    // カードを開く関数
    function openCard(card, toggle, content) {
        card.classList.add('active');
        card.setAttribute('data-state', 'open');
        
        if (toggle) {
            toggle.textContent = '−'; // マイナス記号
            toggle.style.transform = 'rotate(0deg)';
            toggle.style.backgroundColor = '#FF6B6B'; // 赤色で視認性向上
        }
        
        if (content) {
            content.style.maxHeight = '600px';
            content.style.padding = '2rem';
            content.style.opacity = '1';
            content.style.visibility = 'visible';
        }
    }
    
    // カードを閉じる関数
    function closeCard(card, toggle, content) {
        card.classList.remove('active');
        card.setAttribute('data-state', 'closed');
        
        if (toggle) {
            toggle.textContent = '+'; // プラス記号
            toggle.style.transform = 'rotate(0deg)';
            toggle.style.backgroundColor = ''; // 元の色に戻す
        }
        
        if (content) {
            content.style.maxHeight = '0px';
            content.style.padding = '0 2rem';
            content.style.opacity = '0';
            content.style.visibility = 'hidden';
        }
    }
    
    // カードをリセットする関数
    function resetCard(card, toggle, content) {
        card.classList.remove('active');
        card.setAttribute('data-state', 'closed');
        
        if (toggle) {
            toggle.textContent = '+';
            toggle.style.transform = 'rotate(0deg)';
            toggle.style.backgroundColor = '';
        }
        
        if (content) {
            content.style.maxHeight = '0px';
            content.style.padding = '0 2rem';
            content.style.opacity = '0';
            content.style.visibility = 'hidden';
            content.style.transition = 'all 0.3s ease';
        }
    }
    
    console.log('✅ Service cards initialized successfully');
}

// スムーススクロール
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// フェードインアニメーション
function initFadeInAnimation() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
}

// ヘッダーの背景色変更
function initHeaderScroll() {
    const header = document.querySelector('.site-header');
    
    window.addEventListener('scroll', function() {
        if (!header) return;
        
        if (window.scrollY > 50) {
            header.style.background = 'rgba(255, 255, 255, 0.98)';
            header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        } else {
            header.style.background = 'rgba(255, 255, 255, 0.95)';
            header.style.boxShadow = 'none';
        }
    });
}

// 上に戻るボタン
function initBackToTop() {
    const backToTop = document.getElementById('back-to-top');
    
    if (!backToTop) return;
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }
    });
    
    backToTop.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// モバイルメニュー
function initMobileMenu() {
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileClose = document.querySelector('.mobile-menu-close');
    
    if (!mobileToggle || !mobileOverlay) return;
    
    // メニューを開く
    mobileToggle.addEventListener('click', function() {
        mobileOverlay.style.display = 'block';
        requestAnimationFrame(function() {
            mobileOverlay.classList.add('active');
        });
        document.body.style.overflow = 'hidden';
        mobileToggle.setAttribute('aria-expanded', 'true');
    });
    
    // メニューを閉じる関数
    function closeMobileMenu() {
        if (mobileOverlay) {
            mobileOverlay.classList.remove('active');
            requestAnimationFrame(function() {
                requestAnimationFrame(function() {
                    if (!mobileOverlay.classList.contains('active')) {
                        mobileOverlay.style.display = 'none';
                    }
                });
            });
            document.body.style.overflow = 'auto';
            mobileToggle.setAttribute('aria-expanded', 'false');
        }
    }
    
    // 閉じるボタン
    if (mobileClose) {
        mobileClose.addEventListener('click', closeMobileMenu);
    }
    
    // オーバーレイクリック
    mobileOverlay.addEventListener('click', function(e) {
        if (e.target === mobileOverlay) {
            closeMobileMenu();
        }
    });
    
    // メニューリンククリック
    document.querySelectorAll('.mobile-nav-menu a').forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });
}

// お客様の声スライダー
function initTestimonialsSlider() {
    let currentSlide = 0;
    const testimonials = document.querySelectorAll('.testimonial-item');
    const dots = document.querySelectorAll('.dot');
    const nextBtn = document.querySelector('.slider-btn.next');
    const prevBtn = document.querySelector('.slider-btn.prev');
    
    if (testimonials.length === 0) return;
    
    const totalSlides = testimonials.length;
    
    function showSlide(index) {
        testimonials.forEach((testimonial, i) => {
            testimonial.classList.toggle('active', i === index);
        });
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }
    
    // ナビゲーションボタン
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
    
    // 初期スライドを表示
    showSlide(0);
}

// レスポンシブ対応
function initResponsive() {
    window.addEventListener('resize', function() {
        const mobileOverlay = document.querySelector('.mobile-menu-overlay');
        
        if (window.innerWidth > 768) {
            if (mobileOverlay) {
                mobileOverlay.classList.remove('active');
                mobileOverlay.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }
    });
}

// エラーハンドリング
window.addEventListener('error', function(e) {
    console.error('DIYONE Theme Error:', e.message);
});

// 送信ボタンのローディング機能
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('.contact-form');
    const submitButton = document.querySelector('.form-submit');
    
    if (contactForm && submitButton) {
        contactForm.addEventListener('submit', function() {
            // ボタンのテキストを変更
            submitButton.innerHTML = '送信中...';
            submitButton.disabled = true;
            
            // ローディングアニメーションを追加
            submitButton.style.background = 'linear-gradient(135deg, #ccc, #999)';
            submitButton.style.cursor = 'not-allowed';
        });
    }
});

// YouTube動画モーダル機能
document.addEventListener('DOMContentLoaded', function() {
    // YouTubeモーダルの作成
    function createYouTubeModal() {
        const modal = document.createElement('div');
        modal.id = 'youtube-modal';
        modal.innerHTML = `
            <div class="youtube-modal-overlay">
                <div class="youtube-modal-content">
                    <button class="youtube-modal-close">&times;</button>
                    <div class="youtube-video-container">
                        <iframe id="youtube-iframe" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        
        // モーダルを閉じる機能
        const closeBtn = modal.querySelector('.youtube-modal-close');
        const overlay = modal.querySelector('.youtube-modal-overlay');
        
        closeBtn.addEventListener('click', closeYouTubeModal);
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeYouTubeModal();
            }
        });
    }
    
    // YouTube動画を開く
    function openYouTubeModal(videoUrl) {
        const modal = document.getElementById('youtube-modal');
        const iframe = document.getElementById('youtube-iframe');
        
        // YouTube URLを埋め込み形式に変換
        const videoId = extractYouTubeVideoId(videoUrl);
        if (videoId) {
            iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    }
    
    // モーダルを閉じる
    function closeYouTubeModal() {
        const modal = document.getElementById('youtube-modal');
        const iframe = document.getElementById('youtube-iframe');
        
        modal.style.display = 'none';
        iframe.src = '';
        document.body.style.overflow = 'auto';
    }
    
    // YouTube Video IDを抽出
    function extractYouTubeVideoId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }
    
    // ポートフォリオアイテムにクリックイベントを追加
    const portfolioItems = document.querySelectorAll('.portfolio-item[data-youtube-url]');
    portfolioItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const youtubeUrl = this.getAttribute('data-youtube-url');
            if (youtubeUrl) {
                openYouTubeModal(youtubeUrl);
            }
        });
        
        // カーソルをポインターに
        item.style.cursor = 'pointer';
    });
    
    // モーダルを初期化
    if (!document.getElementById('youtube-modal')) {
        createYouTubeModal();
    }
});