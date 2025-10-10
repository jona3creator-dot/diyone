<?php
/**
 * Template Name: Portfolio Page
 * Portfolio Page Template - DIYONE Corporate Website
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

<?php get_footer(); ?>