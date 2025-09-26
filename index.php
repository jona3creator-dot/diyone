<?php
/**
 * The main template file - DIYONE Corporate Website (ver.1.1.1)
 * 最新版：重複削除、JavaScriptコンフリクト修正、完全版
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

    <!-- サービス -->
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
                    <div class="service-content">
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
                    <div class="service-content">
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
                    <div class="service-content">
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
                    <div class="service-content">
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
                    <div class="service-content">
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
                    <div class="service-content">
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
                    <div class="service-content">
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

    <!-- 強み -->
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

    <!-- 実績 -->
    <section id="portfolio" class="section portfolio">
        <div class="container">
            <h2 class="section-title fade-in">Portfolio</h2>
            <p class="section-subtitle fade-in">これまでの制作実績をご紹介</p>
        
        <div class="portfolio-grid">
            <?php
            // おすすめのポートフォリオを取得
            $portfolio_query = new WP_Query(array(
                'post_type' => 'portfolio',
                'posts_per_page' => 8,
                'meta_query' => array(
                    array(
                        'key' => '_featured_on_home',
                        'value' => '1',
                        'compare' => '='
                    )
                ),
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            
            if ($portfolio_query->have_posts()) :
                while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                    $project_type = get_post_meta(get_the_ID(), '_project_type', true);
                    $client_name = get_post_meta(get_the_ID(), '_client_name', true);
                    $results = get_post_meta(get_the_ID(), '_results', true);
                    $result_numbers = get_post_meta(get_the_ID(), '_result_numbers', true);
                    $tags = get_post_meta(get_the_ID(), '_tags', true);
                    $media_type = get_post_meta(get_the_ID(), '_media_type', true);
                    $youtube_url = get_post_meta(get_the_ID(), '_youtube_url', true);
                    
                    // プロジェクトタイプによる背景色の設定
                    $bg_class = '';
                    $icon = '';
                    switch($project_type) {
                        case 'video':
                            $bg_class = 'video-thumb';
                            $icon = '<div class="play-button">▶</div>';
                            break;
                        case 'design':
                            $bg_class = 'design-thumb';
                            $icon = '<div class="design-icon">🎨</div>';
                            break;
                        case 'web':
                            $bg_class = 'web-thumb';
                            $icon = '<div class="web-icon">💻</div>';
                            break;
                        case 'sns':
                            $bg_class = 'sns-thumb';
                            $icon = '<div class="sns-icon">📱</div>';
                            break;
                        case 'ads':
                            $bg_class = 'ads-thumb';
                            $icon = '<div class="ads-icon">📊</div>';
                            break;
                        case 'youtube':
                            $bg_class = 'youtube-thumb';
                            $icon = '<div class="play-button">▶</div>';
                            break;
                        default:
                            $bg_class = 'video-thumb';
                            $icon = '<div class="play-button">▶</div>';
                    }
                    
                    // YouTube動画の場合はdata属性を追加
                    $youtube_attr = '';
                    if ($media_type === 'youtube' && $youtube_url) {
                        $youtube_attr = 'data-youtube-url="' . esc_attr($youtube_url) . '"';
                    }
                    ?>
                    <div class="portfolio-item fade-in" <?php echo $youtube_attr; ?>>
                        <div class="portfolio-image <?php echo $bg_class; ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('portfolio-thumb'); ?>
                            <?php else: ?>
                                <?php echo $icon; ?>
                            <?php endif; ?>
                        </div>
                        <div class="portfolio-content">
                            <h4><?php the_title(); ?></h4>
                            <?php if ($client_name): ?>
                                <p><strong><?php echo esc_html($client_name); ?></strong></p>
                            <?php endif; ?>
                            <p><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                            
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
                // おすすめが設定されていない場合は、最新の8つを表示
                $fallback_query = new WP_Query(array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($fallback_query->have_posts()) :
                    while ($fallback_query->have_posts()) : $fallback_query->the_post();
                        // 上記と同じ表示処理...
                    endwhile;
                    wp_reset_postdata();
                endif;
            endif;
            ?>
        </div>

        <!-- もっと見るボタン -->
        <div class="more-portfolio">
            <a href="<?php echo esc_url(home_url('/portfolio')); ?>" class="cta-button">もっと見る</a>
        </div>
    </div>
    </section>

        <!-- もっと見るボタン -->
        <div class="more-portfolio">
            <a href="<?php echo esc_url(home_url('/portfolio')); ?>" class="cta-button">もっと見る</a>
        </div>
    </div>
</section>

    <!-- お客様の声 -->
    <section id="testimonials" class="section testimonials">
        <div class="container">
            <h2 class="section-title fade-in">Testimonials</h2>
            <p class="section-subtitle fade-in">お客様からの声</p>
            
            <div class="testimonials-slider">
                <div class="testimonial-wrapper">
                    <!-- お客様の声1 -->
                    <div class="testimonial-item active">
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>迅速で丁寧な対応に大変満足しています。動画制作から運用まで一貫してお願いできるので、非常に助かっています。品質も期待以上でした。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">A</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">田中様</div>
                                <div class="author-company">製造業</div>
                                <div class="author-service">映像制作</div>
                            </div>
                        </div>
                    </div>

                    <!-- お客様の声2 -->
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>SNS運用を任せてから、フォロワー数が大幅に増加し、売上にも直結しています。戦略的な運用で成果が目に見えて分かります。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">B</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">佐藤様</div>
                                <div class="author-company">小売業</div>
                                <div class="author-service">SNS運用代行</div>
                            </div>
                        </div>
                    </div>

                    <!-- お客様の声3 -->
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>デザインのクオリティが高く、ブランドイメージの向上につながりました。細かい要望にも柔軟に対応していただけました。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">C</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">山田様</div>
                                <div class="author-company">IT企業</div>
                                <div class="author-service">デザイン制作</div>
                            </div>
                        </div>
                    </div>

                    <!-- お客様の声4 -->
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>YouTubeチャンネルの運営をお願いして大正解でした。登録者数が順調に伸び、収益化まで達成できました。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">D</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">鈴木様</div>
                                <div class="author-company">教育事業</div>
                                <div class="author-service">YouTube運営</div>
                            </div>
                        </div>
                    </div>

                    <!-- お客様の声5 -->
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <div class="quote">"</div>
                            <p>Web制作からSEO対策まで一括でお任せできて助かりました。おかげでお問い合わせ数が大幅に増加しています。</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">E</div>
                            </div>
                            <div class="author-info">
                                <div class="author-name">高橋様</div>
                                <div class="author-company">建設業</div>
                                <div class="author-service">Web制作</div>
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
                    <input type="text" id="company" name="company">
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
                        <td>diyone001@gmail.com</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>