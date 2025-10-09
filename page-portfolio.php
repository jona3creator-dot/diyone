<?php
/**
 * Template Name: Portfolio Page
 * Portfolio Page Template - DIYONE Corporate Website (スライドショー対応版)
 */
get_header(); ?>

<main id="primary" class="site-main">
    <!-- ページヘッダー -->
    <section class="page-hero">
        <div class="container">
            <div class="page-header-content">
                <h1 class="page-title">Portfolio</h1>
                <p class="page-subtitle">これまでの制作実績をご紹介</p>
            </div>
        </div>
    </section>

    <!-- ポートフォリオフィルター -->
    <section class="portfolio-filter section">
        <div class="container">
            <div class="filter-tabs">
                <button class="category-tab active" data-category="all">全て</button>
                <?php
                // カテゴリー一覧を取得
                $categories = get_terms(array(
                    'taxonomy' => 'portfolio_category',
                    'hide_empty' => true,
                ));
                
                if (!empty($categories) && !is_wp_error($categories)) :
                    foreach ($categories as $category) :
                ?>
                    <button class="category-tab" data-category="<?php echo esc_attr($category->slug); ?>">
                        <?php echo esc_html($category->name); ?>
                    </button>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- ポートフォリオグリッド -->
    <section class="portfolio-showcase section">
        <div class="container">
            <div class="portfolio-grid">
                <?php
                // 全ポートフォリオを取得
                $portfolio_args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $portfolio_query = new WP_Query($portfolio_args);

                if ($portfolio_query->have_posts()) :
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        $media_type = get_post_meta(get_the_ID(), '_portfolio_media_type', true);
                        $video_url = get_post_meta(get_the_ID(), '_portfolio_video_url', true);
                        $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                        $tags = get_the_terms(get_the_ID(), 'portfolio_tag');
                        $gallery_images = diyone_get_portfolio_gallery_images(get_the_ID());
                        
                        // デバッグ: ギャラリー画像の数を確認（一時的）
                        // echo '<!-- DEBUG: Gallery Images Count: ' . count($gallery_images) . ' -->';
                        
                        // カテゴリーのスラッグを取得（フィルター用）
                        $category_slug = '';
                        $category_class = 'default-thumb';
                        if ($categories && !is_wp_error($categories)) {
                            $category_slug = $categories[0]->slug;
                            $category_class = $category_slug . '-thumb';
                        }
                        
                        // サムネイル画像の取得
                        if ($media_type === 'video' && !empty($video_url)) {
                            $thumbnail = diyone_get_video_thumbnail($video_url);
                            $thumbnail_html = $thumbnail ? '<img src="' . esc_url($thumbnail) . '" alt="' . esc_attr(get_the_title()) . '">' : '<div class="play-button">▶</div>';
                        } else {
                            $thumbnail_html = get_the_post_thumbnail(get_the_ID(), 'large');
                            if (empty($thumbnail_html)) {
                                $thumbnail_html = '<div class="no-image">No Image</div>';
                            }
                        }
                        
                        // ギャラリー画像のデータを準備
                        $gallery_data = '';
                        if (!empty($gallery_images)) {
                            $gallery_data = 'data-gallery=\'' . esc_attr(json_encode($gallery_images)) . '\'';
                        }
                ?>
                <div class="portfolio-item fade-in" 
                     data-category="<?php echo esc_attr($category_slug); ?>"
                     data-portfolio-id="<?php echo get_the_ID(); ?>" 
                     data-media-type="<?php echo esc_attr($media_type); ?>" 
                     data-video-url="<?php echo esc_attr($video_url); ?>"
                     <?php echo $gallery_data; ?>>
                    <div class="portfolio-image <?php echo esc_attr($category_class); ?>">
                        <?php echo $thumbnail_html; ?>
                        <?php if ($media_type === 'video') : ?>
                            <div class="play-button-overlay">▶</div>
                        <?php elseif (count($gallery_images) > 1) : ?>
                            <div class="gallery-badge">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 4px;">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                <?php echo count($gallery_images); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="portfolio-content">
                        <h4><?php the_title(); ?></h4>
                        <p><?php echo wp_strip_all_tags(get_the_content()); ?></p>
                        <div class="portfolio-tags">
                            <?php if ($tags && !is_wp_error($tags)) : ?>
                                <?php foreach ($tags as $tag) : ?>
                                    <span class="portfolio-tag"><?php echo esc_html($tag->name); ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p style="grid-column: 1/-1; text-align: center; color: #666;">ポートフォリオがまだ登録されていません。</p>
                <?php endif; ?>
            </div>

            <!-- もっと見るボタン -->
            <div class="more-portfolio">
                <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="cta-button">制作のご相談はこちら</a>
            </div>
        </div>
    </section>

    <!-- 制作プロセス -->
    <section class="creation-process section">
        <div class="container">
            <h2 class="section-title">Creation Process</h2>
            <p class="section-subtitle">品質の高い制作物をお届けするためのプロセス</p>

            <div class="process-grid">
                <div class="process-item fade-in">
                    <div class="process-step">1</div>
                    <div class="process-icon">💭</div>
                    <h4>企画・構成</h4>
                    <p>クライアント様のご要望を詳しくお伺いし、最適な企画と構成を練り上げます</p>
                    <div class="process-arrow">→</div>
                </div>

                <div class="process-item fade-in">
                    <div class="process-step">2</div>
                    <div class="process-icon">🎨</div>
                    <h4>デザイン・設計</h4>
                    <p>企画に基づいてデザインカンプや設計書を作成し、方向性を確認します</p>
                    <div class="process-arrow">→</div>
                </div>

                <div class="process-item fade-in">
                    <div class="process-step">3</div>
                    <div class="process-icon">⚙️</div>
                    <h4>制作・開発</h4>
                    <p>承認いただいたデザインを基に、実際の制作・開発作業を進めます</p>
                    <div class="process-arrow">→</div>
                </div>

                <div class="process-item fade-in">
                    <div class="process-step">4</div>
                    <div class="process-icon">✨</div>
                    <h4>仕上げ・納品</h4>
                    <p>最終チェックと調整を行い、高品質な制作物として納品いたします</p>
                </div>
            </div>
        </div>
    </section>

    <!-- お客様の成果 -->
    <section class="client-results section">
        <div class="container">
            <h2 class="section-title">Client Results</h2>
            <p class="section-subtitle">実際にお客様が得られた成果</p>

            <div class="results-grid">
                <div class="result-item fade-in">
                    <div class="result-number">300%</div>
                    <div class="result-label">フォロワー増加率</div>
                    <p>SNS運用代行により、6ヶ月でフォロワー数が3倍に増加</p>
                </div>

                <div class="result-item fade-in">
                    <div class="result-number">150%</div>
                    <div class="result-label">CV率向上</div>
                    <p>Webサイトリニューアルにより、コンバージョン率が1.5倍に改善</p>
                </div>

                <div class="result-item fade-in">
                    <div class="result-number">10,000+</div>
                    <div class="result-label">YouTube登録者数</div>
                    <p>YouTubeチャンネル運営開始から1年で登録者1万人を突破</p>
                </div>

                <div class="result-item fade-in">
                    <div class="result-number">200%</div>
                    <div class="result-label">売上向上</div>
                    <p>動画マーケティング活用により、商品売上が2倍に増加</p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- ポートフォリオモーダル -->
<div id="portfolio-modal" class="portfolio-modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <button class="modal-close" aria-label="閉じる">&times;</button>
        <div class="modal-body">
            <div class="modal-media">
                <!-- スライドショーコンテナ -->
                <div class="slideshow-container"></div>
                <!-- スライドショーコントロール -->
                <div class="slideshow-controls" style="display: none;">
                    <button class="slide-prev" aria-label="前の画像">‹</button>
                    <button class="slide-next" aria-label="次の画像">›</button>
                </div>
                <!-- サムネイル一覧 -->
                <div class="slideshow-thumbnails" style="display: none;"></div>
            </div>
            <div class="modal-info">
                <h3 class="modal-title"></h3>
                <div class="modal-description"></div>
                <div class="modal-tags"></div>
            </div>
        </div>
    </div>
</div>

<style>
/* ページヘッダー */
.page-hero {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e9ecef 100%);
    padding: 8rem 0 4rem;
    text-align: center;
}

.page-title {
    font-size: 3rem;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #333 0%, #FFD700 50%, #FFA500 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
}

.page-subtitle {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 2rem;
}

/* フィルタータブ */
.portfolio-filter {
    padding: 2rem 0;
}

.filter-tabs {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.category-tab {
    padding: 0.8rem 2rem;
    border: 2px solid #e0e0e0;
    background: white;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.category-tab.active,
.category-tab:hover {
    border-color: #FFD700;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: white;
}

/* ポートフォリオグリッド */
.portfolio-showcase {
    padding: 2rem 0 4rem;
}

.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-bottom: 3rem;
}

.portfolio-item {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    opacity: 1;
    transform: scale(1);
    cursor: pointer;
}

.portfolio-item.hidden {
    display: none;
}

.portfolio-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 215, 0, 0.2);
}

.portfolio-image {
    height: 250px;
    position: relative;
    overflow: hidden;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

.portfolio-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ギャラリーバッジ */
.gallery-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: bold;
    z-index: 2;
}

.video-thumb, .default-thumb {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
}

.design-thumb {
    background: linear-gradient(135deg, #4ECDC4, #6FDDDD);
}

.sns-thumb {
    background: linear-gradient(135deg, #A8E6CF, #C3F0CA);
}

.youtube-thumb {
    background: linear-gradient(135deg, #FFD93D, #FFE066);
}

.web-thumb {
    background: linear-gradient(135deg, #FF8C42, #FFAB66);
}

.office-thumb {
    background: linear-gradient(135deg, #00B894, #00CEC9);
}

.ads-thumb {
    background: linear-gradient(135deg, #6C5CE7, #A29BFE);
}

.play-button,
.play-button-overlay {
    font-size: 2rem;
    color: white;
}

.play-button-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 3rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    pointer-events: none;
    z-index: 2;
}

.no-image {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e0e0e0, #f5f5f5);
    color: #999;
    font-weight: bold;
}

.portfolio-content {
    padding: 2rem;
}

.portfolio-content h4 {
    margin-bottom: 1rem;
    color: #333;
    font-weight: bold;
}

.portfolio-content p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.portfolio-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.portfolio-tag {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

/* もっと見るボタン */
.more-portfolio {
    text-align: center;
    margin-top: 2rem;
}

/* 制作プロセス */
.creation-process {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f1f3f4 100%);
}

.process-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    margin-top: 3rem;
    position: relative;
}

.process-item {
    background: white;
    padding: 2.5rem 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    position: relative;
    transition: all 0.3s ease;
}

.process-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(255, 215, 0, 0.2);
}

.process-step {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
}

.process-icon {
    font-size: 2rem;
    margin: 1rem 0;
}

.process-item h4 {
    margin-bottom: 1rem;
    color: #333;
    font-weight: bold;
}

.process-item p {
    color: #666;
    line-height: 1.6;
}

.process-arrow {
    position: absolute;
    top: 50%;
    right: -2rem;
    transform: translateY(-50%);
    font-size: 2rem;
    color: #FFD700;
    font-weight: bold;
}

.process-item:last-child .process-arrow {
    display: none;
}

/* 成果セクション */
.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.result-item {
    background: white;
    padding: 2.5rem 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.result-number {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.result-label {
    font-weight: bold;
    color: #333;
    margin-bottom: 1rem;
}

.result-item p {
    color: #666;
    line-height: 1.6;
}

/* ポートフォリオモーダル */
.portfolio-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
}

.portfolio-modal.active {
    display: block;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    cursor: pointer;
}

.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 20px;
    max-width: 900px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    z-index: 10001;
}

.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10002;
}

.modal-close:hover {
    background: rgba(0, 0, 0, 0.8);
    transform: rotate(90deg);
}

.modal-body {
    padding: 2rem;
}

.modal-media {
    margin-bottom: 2rem;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

/* スライドショーコンテナ */
.slideshow-container {
    position: relative;
    width: 100%;
}

.slideshow-container img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 10px;
}

.slideshow-container iframe,
.slideshow-container blockquote {
    width: 100%;
    min-height: 400px;
}

.slide-item {
    display: none;
}

.slide-item.active {
    display: block;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* スライドショーコントロール */
.slideshow-controls {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 1rem;
    pointer-events: none;
}

.slide-prev,
.slide-next {
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 2rem;
    cursor: pointer;
    transition: all 0.3s ease;
    pointer-events: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
}

.slide-prev:hover,
.slide-next:hover {
    background: rgba(255, 215, 0, 0.9);
    transform: scale(1.1);
}

/* サムネイル一覧 */
.slideshow-thumbnails {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
    overflow-x: auto;
    padding: 0.5rem 0;
}

.thumb-item {
    width: 80px;
    height: 80px;
    flex-shrink: 0;
    cursor: pointer;
    border-radius: 5px;
    overflow: hidden;
    border: 3px solid transparent;
    transition: all 0.3s ease;
}

.thumb-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumb-item.active {
    border-color: #FFD700;
}

.thumb-item:hover {
    border-color: #FFA500;
    transform: scale(1.05);
}

.modal-title {
    font-size: 1.8rem;
    color: #333;
    margin-bottom: 1rem;
    font-weight: bold;
}

.modal-description {
    color: #666;
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

.modal-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.modal-tags .portfolio-tag {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 15px;
    font-size: 0.9rem;
    font-weight: 500;
}

/* レスポンシブ */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .filter-tabs {
        gap: 0.5rem;
    }
    
    .category-tab {
        padding: 0.6rem 1.5rem;
        font-size: 0.9rem;
    }
    
    .portfolio-grid {
        grid-template-columns: 1fr;
    }
    
    .process-grid {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .process-arrow {
        display: none;
    }
    
    .results-grid {
        grid-template-columns: 1fr;
    }
    
    .modal-content {
        width: 95%;
        max-height: 95vh;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .slideshow-controls {
        padding: 0 0.5rem;
    }
    
    .slide-prev,
    .slide-next {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
    }
    
    .thumb-item {
        width: 60px;
        height: 60px;
    }
}

/* タブレット: 2列表示 */
@media (min-width: 769px) and (max-width: 1024px) {
    .portfolio-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.category-tab');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    // フィルター機能
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

    // モーダル機能
    const modal = document.getElementById('portfolio-modal');
    const modalClose = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');
    let currentSlideIndex = 0;
    let galleryImages = [];

    portfolioItems.forEach(item => {
        item.addEventListener('click', function() {
            const mediaType = this.dataset.mediaType;
            const videoUrl = this.dataset.videoUrl;
            const title = this.querySelector('h4').textContent;
            const description = this.querySelector('.portfolio-content p').textContent;
            const tags = this.querySelectorAll('.portfolio-tag');
            const galleryData = this.dataset.gallery;
            
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
                fetch('<?php echo admin_url("admin-ajax.php"); ?>?action=get_video_embed&video_url=' + encodeURIComponent(videoUrl))
                    .then(response => response.text())
                    .then(html => {
                        slideshowContainer.innerHTML = html;
                        slideshowControls.style.display = 'none';
                        slideshowThumbnails.style.display = 'none';
                    });
            } else if (galleryData) {
                // 複数画像のスライドショー
                try {
                    galleryImages = JSON.parse(galleryData);
                    if (galleryImages.length > 0) {
                        currentSlideIndex = 0;
                        renderSlideshow();
                        
                        // 複数画像の場合のみコントロールとサムネイルを表示
                        if (galleryImages.length > 1) {
                            slideshowControls.style.display = 'flex';
                            slideshowThumbnails.style.display = 'flex';
                            renderThumbnails();
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
                const img = this.querySelector('.portfolio-image img');
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
        });
    });

    // スライドショーを描画
    function renderSlideshow() {
        const container = document.querySelector('.slideshow-container');
        container.innerHTML = '';
        
        galleryImages.forEach((image, index) => {
            const slideDiv = document.createElement('div');
            slideDiv.className = 'slide-item' + (index === currentSlideIndex ? ' active' : '');
            slideDiv.innerHTML = '<img src="' + image.url + '" alt="画像' + (index + 1) + '">';
            container.appendChild(slideDiv);
        });
    }

    // サムネイルを描画
    function renderThumbnails() {
        const container = document.querySelector('.slideshow-thumbnails');
        container.innerHTML = '';
        
        galleryImages.forEach((image, index) => {
            const thumbDiv = document.createElement('div');
            thumbDiv.className = 'thumb-item' + (index === currentSlideIndex ? ' active' : '');
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
            if (index === currentSlideIndex) {
                slide.classList.add('active');
            } else {
                slide.classList.remove('active');
            }
        });
        
        thumbs.forEach((thumb, index) => {
            if (index === currentSlideIndex) {
                thumb.classList.add('active');
            } else {
                thumb.classList.remove('active');
            }
        });
    }

    // 前へボタン
    document.querySelector('.slide-prev').addEventListener('click', function(e) {
        e.stopPropagation();
        if (galleryImages.length > 0) {
            currentSlideIndex = (currentSlideIndex - 1 + galleryImages.length) % galleryImages.length;
            updateSlideshow();
        }
    });

    // 次へボタン
    document.querySelector('.slide-next').addEventListener('click', function(e) {
        e.stopPropagation();
        if (galleryImages.length > 0) {
            currentSlideIndex = (currentSlideIndex + 1) % galleryImages.length;
            updateSlideshow();
        }
    });

    // キーボード操作
    document.addEventListener('keydown', function(e) {
        if (modal.classList.contains('active')) {
            if (e.key === 'ArrowLeft') {
                document.querySelector('.slide-prev').click();
            } else if (e.key === 'ArrowRight') {
                document.querySelector('.slide-next').click();
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
});
</script>

<?php get_footer(); ?>