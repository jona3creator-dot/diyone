/**
 * Portfolio Page JavaScript
 * ポートフォリオページ専用スクリプト
 */

document.addEventListener('DOMContentLoaded', function() {
    // カテゴリーフィルター機能
    initCategoryFilter();
    
    // ポートフォリオモーダル機能
    initPortfolioModal();
});

/**
 * カテゴリーフィルター初期化
 */
function initCategoryFilter() {
    const filterTabs = document.querySelectorAll('.category-tab');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            
            // アクティブタブの切り替え
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // アイテムのフィルタリング
            portfolioItems.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
}

/**
 * ポートフォリオモーダル初期化
 */
function initPortfolioModal() {
    const modal = document.getElementById('portfolio-modal');
    const modalClose = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    let currentSlideIndex = 0;
    let galleryImages = [];

    // ポートフォリオアイテムクリック
    portfolioItems.forEach(item => {
        item.addEventListener('click', function() {
            openModal(this);
        });
    });

    // モーダルを開く
    function openModal(item) {
        const mediaType = item.dataset.mediaType;
        const videoUrl = item.dataset.videoUrl;
        const title = item.querySelector('h4').textContent;
        const description = item.querySelector('.portfolio-content p').textContent;
        const tags = item.querySelectorAll('.portfolio-tag');
        const galleryData = item.dataset.gallery;
        
        // モーダルにコンテンツを設定
        document.querySelector('.modal-title').textContent = title;
        document.querySelector('.modal-description').textContent = description;
        
        // タグを設定
        const modalTags = document.querySelector('.modal-tags');
        modalTags.innerHTML = '';
        tags.forEach(tag => {
            modalTags.innerHTML += '<span class="portfolio-tag">' + tag.textContent + '</span>';
        });
        
        // メディアを設定
        const slideshowContainer = document.querySelector('.slideshow-container');
        const slideshowControls = document.querySelector('.slideshow-controls');
        const slideshowThumbnails = document.querySelector('.slideshow-thumbnails');
        
        if (mediaType === 'video' && videoUrl) {
            // 動画埋め込み
            fetchVideoEmbed(videoUrl, slideshowContainer);
            slideshowControls.style.display = 'none';
            slideshowThumbnails.style.display = 'none';
        } else if (galleryData) {
            // 複数画像のスライドショー
            try {
                galleryImages = JSON.parse(galleryData);
                if (galleryImages.length > 0) {
                    currentSlideIndex = 0;
                    renderSlideshow(slideshowContainer, galleryImages, currentSlideIndex);
                    
                    // 複数画像の場合のみコントロールとサムネイルを表示
                    if (galleryImages.length > 1) {
                        slideshowControls.style.display = 'flex';
                        slideshowThumbnails.style.display = 'flex';
                        renderThumbnails(slideshowThumbnails, galleryImages, currentSlideIndex);
                    } else {
                        slideshowControls.style.display = 'none';
                        slideshowThumbnails.style.display = 'none';
                    }
                }
            } catch (e) {
                console.error('ギャラリーデータのパースエラー:', e);
                slideshowContainer.innerHTML = '<p>画像の読み込みに失敗しました</p>';
                slideshowControls.style.display = 'none';
                slideshowThumbnails.style.display = 'none';
            }
        } else {
            // 単一画像
            const img = item.querySelector('.portfolio-image img');
            if (img) {
                slideshowContainer.innerHTML = '<img src="' + img.src + '" alt="' + title + '">';
            } else {
                slideshowContainer.innerHTML = '<p>画像がありません</p>';
            }
            slideshowControls.style.display = 'none';
            slideshowThumbnails.style.display = 'none';
        }
        
        // モーダル表示
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // 動画埋め込みを取得
    function fetchVideoEmbed(videoUrl, container) {
        fetch(ajaxurl + '?action=get_video_embed&video_url=' + encodeURIComponent(videoUrl))
            .then(response => response.text())
            .then(html => {
                container.innerHTML = html;
            })
            .catch(error => {
                console.error('動画の読み込みエラー:', error);
                container.innerHTML = '<p>動画の読み込みに失敗しました</p>';
            });
    }

    // スライドショーを描画
    function renderSlideshow(container, images, activeIndex) {
        container.innerHTML = '';
        
        images.forEach((image, index) => {
            const slideDiv = document.createElement('div');
            slideDiv.className = 'slide-item' + (index === activeIndex ? ' active' : '');
            slideDiv.innerHTML = '<img src="' + image.url + '" alt="画像' + (index + 1) + '">';
            container.appendChild(slideDiv);
        });
    }

    // サムネイルを描画
    function renderThumbnails(container, images, activeIndex) {
        container.innerHTML = '';
        
        images.forEach((image, index) => {
            const thumbDiv = document.createElement('div');
            thumbDiv.className = 'thumb-item' + (index === activeIndex ? ' active' : '');
            thumbDiv.innerHTML = '<img src="' + image.url + '" alt="サムネイル' + (index + 1) + '">';
            thumbDiv.addEventListener('click', function() {
                currentSlideIndex = index;
                updateSlideshow();
            });
            container.appendChild(thumbDiv);
        });
    }

    // スライドショーを更新
    function updateSlideshow() {
        const slides = document.querySelectorAll('.slide-item');
        const thumbs = document.querySelectorAll('.thumb-item');
        
        slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === currentSlideIndex);
        });
        
        thumbs.forEach((thumb, index) => {
            thumb.classList.toggle('active', index === currentSlideIndex);
        });
    }

    // 前へボタン
    const prevBtn = document.querySelector('.slide-prev');
    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (galleryImages.length > 0) {
                currentSlideIndex = (currentSlideIndex - 1 + galleryImages.length) % galleryImages.length;
                updateSlideshow();
            }
        });
    }

    // 次へボタン
    const nextBtn = document.querySelector('.slide-next');
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (galleryImages.length > 0) {
                currentSlideIndex = (currentSlideIndex + 1) % galleryImages.length;
                updateSlideshow();
            }
        });
    }

    // キーボード操作
    document.addEventListener('keydown', function(e) {
        if (modal.classList.contains('active')) {
            if (e.key === 'ArrowLeft' && prevBtn) {
                prevBtn.click();
            } else if (e.key === 'ArrowRight' && nextBtn) {
                nextBtn.click();
            } else if (e.key === 'Escape') {
                closeModal();
            }
        }
    });

    // モーダルを閉じる
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
        currentSlideIndex = 0;
        galleryImages = [];
    }

    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }
    
    if (modalOverlay) {
        modalOverlay.addEventListener('click', closeModal);
    }
}