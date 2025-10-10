// DIYONE WordPress Theme JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // スムーススクロール
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
/*
    // サービスカードの開閉
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });
*/
    
    // フェードインアニメーション
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

    // ヘッダーの背景色変更と上に戻るボタン
    const header = document.querySelector('.site-header');
    const backToTop = document.getElementById('back-to-top');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            if (header) {
                header.style.background = 'rgba(255, 255, 255, 0.98)';
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            }
        } else {
            if (header) {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.boxShadow = 'none';
            }
        }
        if (backToTop) {
            if (window.scrollY > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        }
    });

    // 上に戻るボタン
    if (backToTop) {
        backToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // モバイルメニュー
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileClose = document.querySelector('.mobile-menu-close');
    
    if (mobileToggle && mobileOverlay) {
        mobileToggle.addEventListener('click', function() {
            mobileOverlay.style.display = 'block';
            requestAnimationFrame(function() {
                mobileOverlay.classList.add('active');
            });
            document.body.style.overflow = 'hidden';
        });

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
            }
        }

        if (mobileClose) {
            mobileClose.addEventListener('click', closeMobileMenu);
        }

        mobileOverlay.addEventListener('click', function(e) {
            if (e.target === mobileOverlay) {
                closeMobileMenu();
            }
        });

        document.querySelectorAll('.mobile-nav-menu a').forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
    }

    // レスポンシブ対応
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            if (mobileOverlay) {
                mobileOverlay.classList.remove('active');
                mobileOverlay.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }
    });

    // ページロード完了時の初期化
    window.addEventListener('load', function() {
        document.querySelectorAll('.fade-in').forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight) {
                el.classList.add('visible');
            }
        });
    });
});