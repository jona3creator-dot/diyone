<?php
/**
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
                <button class="category-tab" data-category="video">映像制作</button>
                <button class="category-tab" data-category="design">デザイン制作</button>
                <button class="category-tab" data-category="web">Web制作</button>
                <button class="category-tab" data-category="sns">SNS運用</button>
                <button class="category-tab" data-category="ads">広告運用</button>
                <button class="category-tab" data-category="youtube">YouTube運営とM&A</button>
            </div>
        </div>
    </section>

    <!-- ポートフォリオグリッド -->
    <section class="portfolio-showcase section">
        <div class="container">
            <div class="portfolio-grid">
                <?php
                $portfolio_query = new WP_Query(array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($portfolio_query->have_posts()) :
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        $project_type = get_post_meta(get_the_ID(), '_project_type', true);
                        $client_name = get_post_meta(get_the_ID(), '_client_name', true);
                        $result_numbers = get_post_meta(get_the_ID(), '_result_numbers', true);
                        $tags = get_post_meta(get_the_ID(), '_tags', true);
                        $media_type = get_post_meta(get_the_ID(), '_media_type', true);
                        $youtube_url = get_post_meta(get_the_ID(), '_youtube_url', true);
                        
                        // 背景色の設定
                        $bg_class = 'video-thumb';
                        switch($project_type) {
                            case 'video': $bg_class = 'video-thumb'; break;
                            case 'design': $bg_class = 'design-thumb'; break;
                            case 'web': $bg_class = 'web-thumb'; break;
                            case 'sns': $bg_class = 'sns-thumb'; break;
                            case 'ads': $bg_class = 'ads-thumb'; break;
                            case 'youtube': $bg_class = 'youtube-thumb'; break;
                        }
                        
                        // YouTube動画の場合はdata属性を追加
                        $youtube_attr = '';
                        if ($media_type === 'youtube' && $youtube_url) {
                            $youtube_attr = 'data-youtube-url="' . esc_attr($youtube_url) . '"';
                        }
                        ?>
                        <div class="portfolio-item fade-in" data-category="<?php echo $project_type; ?>" <?php echo $youtube_attr; ?>>
    <div class="portfolio-image <?php echo $bg_class; ?>">
        <?php 
    $thumbnail_html = get_social_media_thumbnail($media_type, $social_url, get_the_ID());
    echo $thumbnail_html;
    ?>
        
        <!-- ホバーオーバーレイを復活 -->
        <div class="portfolio-overlay">
            <h3><?php the_title(); ?></h3>
            <?php if ($client_name): ?>
                <p><?php echo esc_html($client_name); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="portfolio-content">
        <h4><?php the_title(); ?></h4>
        <?php if ($client_name): ?>
            <p><strong><?php echo esc_html($client_name); ?></strong></p>
        <?php endif; ?>
        <p><?php echo wp_trim_words(get_the_content(), 25, '...'); ?></p>
        
        <?php if ($tags): ?>
        <div class="portfolio-tags">
            <?php 
            $tag_array = explode(',', $tags);
            foreach ($tag_array as $tag): 
            ?>
            <span class="portfolio-tag"><?php echo trim($tag); ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <?php if ($result_numbers): ?>
        <div class="portfolio-results">
            <span class="result-item"><?php echo esc_html($result_numbers); ?></span>
        </div>
        <?php endif; ?>
    </div>
</div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<div class="no-portfolio"><p>現在、ポートフォリオはありません。</p></div>';
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>

<?php get_footer(); ?>