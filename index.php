<?php
/**
 * The main template file - DIYONE Corporate Website
 */
get_header(); ?>

<main id="primary" class="site-main">
    <!-- メインビジュアル -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-subtitle"><?php echo wp_kses_post(get_theme_mod('hero_subtitle', 'オンライン完結のワンストップサポート')); ?></div>
            <h1><?php echo wp_kses_post(get_theme_mod('hero_title', '唯一無二の価値を<br>あなたのビジネスに')); ?></h1>
            <p><?php echo wp_kses_post(get_theme_mod('hero_description', 'コンテンツ制作からSNSマーケティングまで、<br>オンライン完結の打ち合わせだけでワンストップでサポートします')); ?></p>
            <a href="#contact" class="cta-button">無料相談を申し込む</a>
        </div>
    </section>

<!-- サービスセクション（修正版 - display切り替え方式） -->
<section id="services" class="section services">
    <div class="container">
        <h2 class="section-title fade-in">Service</h2>
        <p class="section-subtitle fade-in">オンラインで完結する幅広いデジタルサービスを提供</p>
        
        <div class="services-grid">
            <!-- 映像制作 -->
            <div class="service-card fade-in">
                <div class="service-header">
                    <div class="service-info">
                        <div class="service-icon">🎥</div>
                        <h3 class="service-title">映像制作</h3>
                    </div>
                    <div class="service-toggle">+</div>
                </div>
                <div class="service-content" style="display: none;">
                    <p class="service-description">企業PR動画、商品紹介、イベント映像など、目的に応じた高品質な映像コンテンツを制作。AI技術も活用し効率的で革新的な制作を実現します</p>
                    <ul class="service-features">
                        <li>企業PR・会社紹介動画</li>
                        <li>商品・サービス紹介動画</li>
                        <li>イベント・セミナー映像</li>
                        <li>AIツールを活用した効率制作</li>
                    </ul>
                </div>
            </div>

            <!-- デザイン制作 -->
            <div class="service-card fade-in">
                <div class="service-header">
                    <div class="service-info">
                        <div class="service-icon">🎨</div>
                        <h3 class="service-title">デザイン制作</h3>
                    </div>
                    <div class="service-toggle">+</div>
                </div>
                <div class="service-content" style="display: none;">
                    <p class="service-description">サムネイル、バナー、ロゴ、チラシまで、ブランドイメージを向上させるデザインを提供。AIデザインツールも駆使し、迅速で高品質な制作をお約束します</p>
                    <ul class="service-features">
                        <li>ロゴ・ブランドアイデンティティ</li>
                        <li>SNS用バナー・サムネイル</li>
                        <li>チラシ・ポスターデザイン</li>
                        <li>AIデザインツール活用</li>
                    </ul>
                </div>
            </div>

            <!-- Web制作 -->
            <div class="service-card fade-in">
                <div class="service-header">
                    <div class="service-info">
                        <div class="service-icon">💻</div>
                        <h3 class="service-title">Web制作</h3>
                    </div>
                    <div class="service-toggle">+</div>
                </div>
                <div class="service-content" style="display: none;">
                    <p class="service-description">コーポレートサイトからECサイトまで、目的に応じたWebサイトを制作。レスポンシブ対応とSEO最適化で成果につながるサイトを提供します</p>
                    <ul class="service-features">
                        <li>コーポレートサイト制作</li>
                        <li>ECサイト構築</li>
                        <li>ランディングページ制作</li>
                        <li>WordPress開発</li>
                    </ul>
                </div>
            </div>

            <!-- SNS運用 -->
            <div class="service-card fade-in">
                <div class="service-header">
                    <div class="service-info">
                        <div class="service-icon">📱</div>
                        <h3 class="service-title">SNS運用</h3>
                    </div>
                    <div class="service-toggle">+</div>
                </div>
                <div class="service-content" style="display: none;">
                    <p class="service-description">Instagram、Twitter、TikTokなど各SNSの特性を活かした戦略的な運用をサポート。データに基づいた最適化で成果を最大化します</p>
                    <ul class="service-features">
                        <li>Instagram・Twitter・TikTok運用</li>
                        <li>コンテンツ企画・制作</li>
                        <li>フォロワー獲得戦略</li>
                        <li>分析・改善提案</li>
                    </ul>
                </div>
            </div>

            <!-- 広告運用 -->
            <div class="service-card fade-in">
                <div class="service-header">
                    <div class="service-info">
                        <div class="service-icon">📊</div>
                        <h3 class="service-title">広告運用</h3>
                    </div>
                    <div class="service-toggle">+</div>
                </div>
                <div class="service-content" style="display: none;">
                    <p class="service-description">Meta広告、Google広告の運用から、GA4を活用した詳細分析まで。データドリブンな広告戦略でROIを最大化します</p>
                    <ul class="service-features">
                        <li>Meta広告（Facebook・Instagram）</li>
                        <li>Google広告・YouTube広告</li>
                        <li>GA4分析・コンバージョン最適化</li>
                        <li>広告クリエイティブ制作</li>
                    </ul>
                </div>
            </div>

            <!-- YouTube運営とM&A -->
            <div class="service-card fade-in">
                <div class="service-header">
                    <div class="service-info">
                        <div class="service-icon">📺</div>
                        <h3 class="service-title">YouTube運営とM&A</h3>
                    </div>
                    <div class="service-toggle">+</div>
                </div>
                <div class="service-content" style="display: none;">
                    <p class="service-description">チャンネル設計から動画制作、分析まで、YouTubeマーケティングを一括サポート。収益化からM&A支援まで戦略的に構築します</p>
                    <ul class="service-features">
                        <li>チャンネル設計・最適化</li>
                        <li>動画企画・制作・編集</li>
                        <li>SEO対策・サムネイル制作</li>
                        <li>収益化戦略・M&A支援</li>
                    </ul>
                </div>
            </div>

            <!-- オンライン事務 -->
            <div class="service-card fade-in">
                <div class="service-header">
                    <div class="service-info">
                        <div class="service-icon">💼</div>
                        <h3 class="service-title">オンライン事務</h3>
                    </div>
                    <div class="service-toggle">+</div>
                </div>
                <div class="service-content" style="display: none;">
                    <p class="service-description">データ入力、資料作成、スプレッドシート関数まで、業務効率化をサポート。ルーチンワークの自動化で生産性を向上させます</p>
                    <ul class="service-features">
                        <li>データ入力・整理</li>
                        <li>資料作成・プレゼン制作</li>
                        <li>スプレッドシート関数・自動化</li>
                        <li>業務フロー最適化</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- 制作フロー -->
    <section id="workflow" class="section workflow">
        <div class="workflow-container">
            <div class="container">
                <h2 class="section-title fade-in">Work Flow</h2>
                <p class="section-subtitle fade-in">お客様との制作フローをわかりやすくご説明</p>
                
                <div class="workflow-grid">
                    <div class="workflow-item fade-in">
                        <div class="workflow-step">1</div>
                        <div class="workflow-icon">💬</div>
                        <h4>ZOOMヒアリング</h4>
                        <p>お客様のご要望や目標をZOOMでしっかりとお伺いし、最適なプランをご提案いたします</p>
                        <div class="workflow-arrow">→</div>
                    </div>
                    
                    <div class="workflow-item fade-in">
                        <div class="workflow-step">2</div>
                        <div class="workflow-icon">📝</div>
                        <h4>企画・提案</h4>
                        <p>ヒアリング内容を基に、戦略的な企画書とお見積りをご提示。詳細をすり合わせます</p>
                        <div class="workflow-arrow">→</div>
                    </div>
                    
                    <div class="workflow-item fade-in">
                        <div class="workflow-step">3</div>
                        <div class="workflow-icon">⚡</div>
                        <h4>制作・実行</h4>
                        <p>プロのクリエイターチームが連携し、高品質なコンテンツを制作・実行いたします</p>
                        <div class="workflow-arrow">→</div>
                    </div>
                    
                    <div class="workflow-item fade-in">
                        <div class="workflow-step">4</div>
                        <div class="workflow-icon">✅</div>
                        <h4>納品・サポート</h4>
                        <p>完成したコンテンツを納品し、その後のアフターサポートも充実しています</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 強み（3つに変更） -->
    <section id="strengths" class="section strengths">
        <div class="strengths-container">
            <div class="container">
                <h2 class="section-title fade-in">Our Strengths</h2>
                <p class="section-subtitle fade-in">DIYONEが選ばれる理由</p>
                
                <div class="strengths-grid">
                    <div class="strength-item fade-in">
                        <span class="strength-number">01</span>
                        <h3>オンライン完結</h3>
                        <p>全ての業務をオンラインで完結できるため、全国どこからでもスピーディーにサービスをご利用いただけます</p>
                    </div>
                    
                    <div class="strength-item fade-in">
                        <span class="strength-number">02</span>
                        <h3>ワンストップサービス</h3>
                        <p>企画から制作、運用まで一貫してサポート。複数の業者とやり取りする手間を省けます</p>
                    </div>
                    
                    <div class="strength-item fade-in">
                        <span class="strength-number">03</span>
                        <h3>柔軟な対応力</h3>
                        <p>お客様のご要望に合わせて柔軟にカスタマイズし、最適なソリューションを提供します</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 実績（Portfolio） - トップページ表示用 -->
    <section id="portfolio" class="section portfolio">
        <div class="container">
            <h2 class="section-title fade-in">Portfolio</h2>
            <p class="section-subtitle fade-in">これまでの制作実績をご紹介</p>
            
            <div class="portfolio-grid">
                <?php
                // 「トップページに表示」にチェックが入っている8件を取得
                $portfolio_args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key' => '_portfolio_show_on_top',
                            'value' => '1',
                            'compare' => '='
                        )
                    )
                );
                $portfolio_query = new WP_Query($portfolio_args);

                if ($portfolio_query->have_posts()) :
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        $media_type = get_post_meta(get_the_ID(), '_portfolio_media_type', true);
                        $video_url = get_post_meta(get_the_ID(), '_portfolio_video_url', true);
                        $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                        $tags = get_the_terms(get_the_ID(), 'portfolio_tag');
                        $gallery_images = diyone_get_portfolio_gallery_images(get_the_ID());
                        
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
                        
                        // カテゴリーからクラス名を生成
                        $category_class = 'default-thumb';
                        if ($categories && !is_wp_error($categories)) {
                            $cat_slug = $categories[0]->slug;
                            $category_class = $cat_slug . '-thumb';
                        }
                        
                        // ギャラリー画像のデータを準備
                        $gallery_data = '';
                        if (!empty($gallery_images)) {
                            $gallery_data = 'data-gallery=\'' . esc_attr(json_encode($gallery_images)) . '\'';
                        }
                ?>
                <div class="portfolio-item fade-in" 
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
                    <p style="grid-column: 1/-1; text-align: center; color: #666;">
                        ポートフォリオがまだ登録されていません。<br>
                        <small>※管理画面で「トップページに表示する」にチェックを入れたポートフォリオが表示されます</small>
                    </p>
                <?php endif; ?>
            </div>

            <!-- もっと見るボタン（修正版） -->
            <div class="more-portfolio">
                <?php
                // ポートフォリオページをスラッグで検索
                $portfolio_page = get_page_by_path('portfolio');
                if ($portfolio_page) {
                    // ページが存在する場合、そのURLを使用
                    $portfolio_url = get_permalink($portfolio_page->ID);
                } else {
                    // ページが存在しない場合、デフォルトのURLを使用
                    $portfolio_url = home_url('/portfolio/');
                }
                ?>
                <a href="<?php echo esc_url($portfolio_url); ?>" class="cta-button">もっと見る</a>
            </div>
        </div>
    </section>

    <!-- お客様の声（スライド形式） -->
    <section id="testimonials" class="section testimonials">
        <div class="container">
            <h2 class="section-title fade-in">Testimonials</h2>
            <p class="section-subtitle fade-in">お客様からの声</p>
            
            <div class="testimonials-slider">
                <div class="testimonial-wrapper">
                    <!-- お客様の声1 -->
                    <div class="testimonial-item active">
                        <div class="testimonial-tag">映像制作</div>
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>迅速で丁寧な対応に大変満足しています。動画制作から運用まで一貫してお願いできるので、非常に助かっています。品質も期待以上でした。企画段階から細かくヒアリングしていただき、私たちの要望を的確に形にしてくださいました。納品後のフォローも手厚く、長期的なパートナーとして信頼できる会社だと感じています。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">A</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">田中様</div>
                                <div class="author-company">製造業</div>
                            </div>
                        </div>
                    </div>

                    <!-- お客様の声2 -->
                    <div class="testimonial-item">
                        <div class="testimonial-tag">SNS運用代行</div>
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>SNS運用を任せてから、フォロワー数が大幅に増加し、売上にも直結しています。戦略的な運用で成果が目に見えて分かります。投稿内容の企画から分析まで、すべてをプロフェッショナルに対応していただき、私たちは本業に集中できるようになりました。データに基づいた改善提案も的確で、継続的な成長を実感しています。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">B</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">佐藤様</div>
                                <div class="author-company">小売業</div>
                            </div>
                        </div>
                    </div>

                    <!-- お客様の声3 -->
                    <div class="testimonial-item">
                        <div class="testimonial-tag">デザイン制作</div>
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>デザインのクオリティが高く、ブランドイメージの向上につながりました。細かい要望にも柔軟に対応していただけました。初回の提案から完成度が高く、修正回数も最小限で済みました。トレンドを押さえつつも、私たちのブランドらしさを表現してくださり、お客様からの反響も非常に良好です。今後も継続してお願いしたいと思っています。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">C</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">山田様</div>
                                <div class="author-company">IT企業</div>
                            </div>
                        </div>
                    </div>

                    <!-- お客様の声4 -->
                    <div class="testimonial-item">
                        <div class="testimonial-tag">YouTube運営</div>
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>YouTubeチャンネルの運営をお願いして大正解でした。登録者数が順調に伸び、収益化まで達成できました。企画の段階から視聴者のニーズを分析し、効果的なコンテンツ作りをサポートしていただきました。サムネイルやタイトルの最適化、SEO対策まで細かくフォローしてくださり、想像以上の成果を上げることができています。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">D</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">鈴木様</div>
                                <div class="author-company">教育事業</div>
                            </div>
                        </div>
                    </div>

                    <!-- お客様の声5 -->
                    <div class="testimonial-item">
                        <div class="testimonial-tag">Web制作</div>
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>Web制作からSEO対策まで一括でお任せできて助かりました。おかげでお問い合わせ数が大幅に増加しています。使いやすいデザインと分かりやすい導線設計で、訪問者の滞在時間も伸びました。定期的なメンテナンスやアップデートの提案もいただけるので、常に最新の状態を保つことができています。投資対効果が非常に高いと実感しています。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">E</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">高橋様</div>
                                <div class="author-company">建設業</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- スライダーナビゲーション -->
                <div class="slider-nav">
                    <button class="slider-btn prev" aria-label="前へ">‹</button>
                    <div class="slider-dots">
                        <span class="dot active" data-slide="0"></span>
                        <span class="dot" data-slide="1"></span>
                        <span class="dot" data-slide="2"></span>
                        <span class="dot" data-slide="3"></span>
                        <span class="dot" data-slide="4"></span>
                    </div>
                    <button class="slider-btn next" aria-label="次へ">›</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Give & Take セクション（非表示） -->
    <section id="give-take" class="section give-take" style="display: none;">
        <div class="container">
            <div class="give-take-hero">
                <div class="give-take-content">
                    <h2>Give & Take</h2>
                    <div class="subtitle">
                        スキルシェアプラットフォーム
                        <span class="coming-soon-badge">Coming Soon</span>
                    </div>
                    <p>クリエイターとクライアントをつなぐ新しいプラットフォームを準備中です。あなたのスキルを活かして、新しい働き方を始めませんか？</p>
                    
                    <div class="give-take-features">
                        <div class="feature-item">
                            <div class="feature-icon">🎨</div>
                            <div class="feature-title">クリエイター登録</div>
                            <div class="feature-desc">あなたのスキルを登録</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">🤝</div>
                            <div class="feature-title">マッチング</div>
                            <div class="feature-desc">最適なプロジェクトをご紹介</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">💰</div>
                            <div class="feature-title">収益化</div>
                            <div class="feature-desc">スキルを収入に変換</div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">📈</div>
                            <div class="feature-title">成長サポート</div>
                            <div class="feature-desc">スキルアップ支援</div>
                        </div>
                    </div>
                    
                    <a href="#contact" class="cta-button">事前登録はこちら</a>
                </div>
            </div>
        </div>
    </section>

    <!-- お問い合わせ -->
    <section id="contact" class="section contact">
        <div class="container">
            <h2 class="section-title fade-in">Contact</h2>
            <p class="section-subtitle fade-in">お気軽にお問い合わせください</p>
            
            <form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                <input type="hidden" name="action" value="submit_contact_form">
                
                <div class="form-group">
                    <label for="name">お名前 <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="furigana">ふりがな <span class="required">*</span></label>
                    <input type="text" id="furigana" name="furigana" required>
                </div>
                
                <div class="form-group">
                    <label for="company">会社名・団体名</label>
                    <input type="text" name="company">
                </div>
                
                <div class="form-group">
                    <label for="email">メールアドレス <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">電話番号</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                
                <div class="form-group">
                    <label for="service">ご希望のサービス</label>
                    <select id="service" name="service">
                        <option value="">選択してください</option>
                        <option value="ZOOMヒアリング希望(無料)">ZOOMヒアリング希望(無料)</option>
                        <option value="映像制作">映像制作</option>
                        <option value="デザイン制作">デザイン制作</option>
                        <option value="Web制作">Web制作</option>
                        <option value="SNS運用">SNS運用</option>
                        <option value="広告運用">広告運用</option>
                        <option value="YouTube運営とM&A">YouTube運営とM&A</option>
                        <option value="オンライン事務">オンライン事務</option>
                        <option value="その他">その他</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message">お問い合わせ内容 <span class="required">*</span></label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                
                <div class="privacy-policy">
                    <h4>プライバシーポリシー</h4>
                    <div class="privacy-policy-content">
                        <p>DIYONE（以下、「当社」という。）は、ユーザーの個人情報について適切に管理し、以下の目的で利用いたします：</p>
                        <ul class="privacy-list">
                            <li>お問い合わせへの対応</li>
                            <li>サービスの提供・運営</li>
                            <li>サービスに関するご案内・連絡</li>
                            <li>サービスの改善・開発</li>
                        </ul>
                        <p>詳細については、<a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy'))); ?>" target="_blank" style="color: #FFD700;">プライバシーポリシー</a>をご確認ください。</p>
                    </div>
                    <div class="privacy-checkbox">
                        <input type="checkbox" id="privacy-agree" name="privacy-agree" required>
                        <label for="privacy-agree">プライバシーポリシーに同意します <span class="required">*</span></label>
                    </div>
                </div>
                
                <button type="submit" class="form-submit">送信する</button>
            </form>
        </div>
    </section>

    <!-- 会社概要 -->
    <section id="company" class="section company">
        <div class="container">
            <h2 class="section-title fade-in">Company</h2>
            <p class="section-subtitle fade-in">会社概要</p>
            
            <div class="company-info fade-in">
                <table class="company-table">
                    <tr>
                        <th>会社名</th>
                        <td>DIYONE</td>
                    </tr>
                    <tr>
                        <th>代表者</th>
                        <td>代表取締役 粟野滉</td>
                    </tr>
                    <tr>
                        <th>設立</th>
                        <td>2024年</td>
                    </tr>
                    <tr>
                        <th>所在地</th>
                        <td>Gg. Tunjung Sari, Sanur Kauh, Denpasar Selatan, Kota Denpasar, Bali 80228</td>
                    </tr>
                    <tr>
                        <th>事業内容</th>
                        <td>
                            映像制作、デザイン制作、Web制作、SNS運用、<br>
                            広告運用、YouTube運営とM&A、オンライン事務
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td><a href="mailto:diyone001@gmail.com" class="email-link">diyone001@gmail.com</a></td>
                    </tr>
                </table>
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