<?php
/**
 * The main template file - DIYONE Corporate Website (修正版)
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

    <!-- 実績（Portfolio） -->
    <section id="portfolio" class="section portfolio">
        <div class="container">
            <h2 class="section-title fade-in">Portfolio</h2>
            <p class="section-subtitle fade-in">これまでの制作実績をご紹介</p>
            
            <div class="portfolio-grid">
                <!-- YouTube動画制作 -->
                <div class="portfolio-item fade-in">
                    <div class="portfolio-image video-thumb">
                        <div class="play-button">▶</div>
                    </div>
                    <div class="portfolio-content">
                        <h4>企業PR動画制作</h4>
                        <p>BtoB企業向けの会社紹介動画を制作。視聴完了率85%を達成</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">映像制作</span>
                            <span class="portfolio-tag">企業PR</span>
                        </div>
                    </div>
                </div>

                <!-- デザイン制作 -->
                <div class="portfolio-item fade-in">
                    <div class="portfolio-image design-thumb">
                        <div class="design-icon">🎨</div>
                    </div>
                    <div class="portfolio-content">
                        <h4>ブランドロゴデザイン</h4>
                        <p>スタートアップ企業のロゴ・CI設計を担当。ブランド認知度40%向上</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">ブランディング</span>
                            <span class="portfolio-tag">ロゴ制作</span>
                        </div>
                    </div>
                </div>

                <!-- プレゼン資料 -->
                <div class="portfolio-item fade-in">
                    <div class="portfolio-image presentation-thumb">
                        <div class="presentation-icon">📊</div>
                    </div>
                    <div class="portfolio-content">
                        <h4>営業資料作成</h4>
                        <p>プレゼンテーション資料を戦略的に設計。成約率30%向上に貢献</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">資料作成</span>
                            <span class="portfolio-tag">営業支援</span>
                        </div>
                    </div>
                </div>

                <!-- SNS運用 -->
                <div class="portfolio-item fade-in">
                    <div class="portfolio-image sns-thumb">
                        <div class="sns-icon">📱</div>
                    </div>
                    <div class="portfolio-content">
                        <h4>Instagram運用代行</h4>
                        <p>カフェのInstagramアカウント運用。フォロワー数を6ヶ月で3倍に増加</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">SNS運用</span>
                            <span class="portfolio-tag">Instagram</span>
                        </div>
                    </div>
                </div>

                <!-- Web制作 -->
                <div class="portfolio-item fade-in">
                    <div class="portfolio-image web-thumb">
                        <div class="web-icon">💻</div>
                    </div>
                    <div class="portfolio-content">
                        <h4>コーポレートサイト</h4>
                        <p>建設会社のコーポレートサイトをWordPressで制作。お問い合わせ数200%向上</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">Web制作</span>
                            <span class="portfolio-tag">WordPress</span>
                        </div>
                    </div>
                </div>

                <!-- YouTube運営 -->
                <div class="portfolio-item fade-in">
                    <div class="portfolio-image youtube-thumb">
                        <div class="play-button">▶</div>
                    </div>
                    <div class="portfolio-content">
                        <h4>YouTubeチャンネル運営</h4>
                        <p>教育系YouTubeチャンネル立ち上げ。チャンネル登録者1万人達成</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">YouTube運営</span>
                            <span class="portfolio-tag">教育コンテンツ</span>
                        </div>
                    </div>
                </div>

                <!-- 広告運用 -->
                <div class="portfolio-item fade-in">
                    <div class="portfolio-image ad-thumb">
                        <div class="ad-icon">📊</div>
                    </div>
                    <div class="portfolio-content">
                        <h4>Meta広告運用</h4>
                        <p>ECサイトのMeta広告を運用。ROAS300%を達成し売上大幅向上</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">広告運用</span>
                            <span class="portfolio-tag">Meta広告</span>
                        </div>
                    </div>
                </div>

                <!-- オンライン事務 -->
                <div class="portfolio-item fade-in">
                    <div class="portfolio-image office-thumb">
                        <div class="office-icon">💼</div>
                    </div>
                    <div class="portfolio-content">
                        <h4>データ入力・整理</h4>
                        <p>大手企業の顧客データベース整理。作業効率を50%向上させました</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">オンライン事務</span>
                            <span class="portfolio-tag">データ整理</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- もっと見るボタン -->
            <div class="more-portfolio">
                <a href="<?php echo esc_url(home_url('/portfolio')); ?>" class="cta-button">もっと見る</a>
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
                        <td><a href="mailto:diyone001@gmail.com" class="email-link">diyone001@gmail.com</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</main>

<style>
/* サービスカード開閉の修正 */
.service-toggle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
    transition: transform 0.3s ease;
    cursor: pointer;
}

.service-card.active .service-toggle {
    transform: rotate(45deg);
}

.service-card.active .service-toggle::after {
    content: '-';
}

/* ポートフォリオセクション */
.portfolio {
    background: 
        linear-gradient(135deg, rgba(255, 215, 0, 0.03) 0%, rgba(255, 165, 0, 0.03) 100%),
        linear-gradient(45deg, #fafafa 0%, #ffffff 50%, #f5f5f5 100%);
    position: relative;
}

.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 3rem;
}

.portfolio-item {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.portfolio-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 215, 0, 0.2);
}

.portfolio-image {
    height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    font-size: 1.5rem;
    color: white;
    font-weight: bold;
}

.video-thumb {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
}

.design-thumb {
    background: linear-gradient(135deg, #4ECDC4, #6FDDDD);
}

.presentation-thumb {
    background: linear-gradient(135deg, #A8E6CF, #C3F0CA);
}

.sns-thumb {
    background: linear-gradient(135deg, #FFD93D, #FFE066);
}

.web-thumb {
    background: linear-gradient(135deg, #FF8C42, #FFAB66);
}

.youtube-thumb {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
}

.ad-thumb {
    background: linear-gradient(135deg, #6C5CE7, #A29BFE);
}

.office-thumb {
    background: linear-gradient(135deg, #00B894, #00CEC9);
}

.play-button,
.design-icon,
.presentation-icon,
.sns-icon,
.web-icon,
.ad-icon,
.office-icon {
    font-size: 2rem;
}

.portfolio-content {
    padding: 1.5rem;
}

.portfolio-content h4 {
    margin-bottom: 0.8rem;
    color: #333;
    font-weight: bold;
    font-size: 1.1rem;
}

.portfolio-content p {
    color: #666;
    line-height: 1.5;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.portfolio-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.portfolio-tag {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: white;
    padding: 0.25rem 0.7rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.more-portfolio {
    text-align: center;
    margin-top: 2rem;
}

/* お客様の声スライダー */
.testimonials-slider {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
}

.testimonial-wrapper {
    position: relative;
    overflow: hidden;
}

.testimonial-item {
    background: white;
    padding: 3rem 2rem 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    display: none;
    margin: 0 1rem;
}

.testimonial-item.active {
    display: block;
}

.testimonial-content {
    margin-bottom: 2rem;
    position: relative;
}

.quote {
    font-size: 4rem;
    color: #FFD700;
    position: absolute;
    top: -2rem;
    left: -0.5rem;
    font-family: serif;
    opacity: 0.3;
    line-height: 1;
}

.testimonial-content p {
    color: #333;
    line-height: 1.8;
    font-style: italic;
    margin-left: 2rem;
    font-size: 1.1rem;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-left: 2rem;
}

.author-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.author-info .author-name {
    font-weight: bold;
    color: #333;
    margin-bottom: 0.2rem;
    font-size: 1.1rem;
}

.author-info .author-company {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.3rem;
}

.author-info .author-service {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: white;
    padding: 0.2rem 0.8rem;
    border-radius: 12px;
    font-size: 0.8rem;
    display: inline-block;
}

.slider-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    margin-top: 2rem;
}

.slider-btn {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
}

.slider-dots {
    display: flex;
    gap: 0.5rem;
}

.dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #ddd;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot.active {
    background: #FFD700;
    transform: scale(1.3);
}

/* プライバシーポリシーの箇条書き修正 */
.privacy-list {
    list-style: none;
    padding-left: 0;
    margin: 1rem 0;
}

.privacy-list li {
    padding: 0.2rem 0;
    color: #666;
    position: relative;
    padding-left: 1rem;
}

.privacy-list li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #FFD700;
    font-weight: bold;
}

/* レスポンシブ */
@media (max-width: 768px) {
    .portfolio-grid {
        grid-template-columns: 1fr;
        grid-template-rows: repeat(8, 1fr);
    }
    
    .testimonial-item {
        padding: 2rem 1.5rem;
        margin: 0 0.5rem;
    }
    
    .testimonial-content p {
        font-size: 1rem;
        margin-left: 1rem;
    }
    
    .testimonial-author {
        margin-left: 1rem;
    }
    
    .slider-nav {
        gap: 1rem;
    }
}
</style>

<script>
// サービスカード開閉機能（個別対応）
document.addEventListener('DOMContentLoaded', function() {
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        const toggle = card.querySelector('.service-toggle');
        
        card.addEventListener('click', function(e) {
            // 他のカードを閉じる
            serviceCards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('active');
                    const otherToggle = otherCard.querySelector('.service-toggle');
                    otherToggle.textContent = '+';
                }
            });
            
            // クリックしたカードを開閉
            this.classList.toggle('active');
            if (this.classList.contains('active')) {
                toggle.textContent = '−';
            } else {
                toggle.textContent = '+';
            }
        });
    });

    // お客様の声スライダー
    let currentSlide = 0;
    const testimonials = document.querySelectorAll('.testimonial-item');
    const dots = document.querySelectorAll('.dot');
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
    document.querySelector('.slider-btn.next').addEventListener('click', nextSlide);
    document.querySelector('.slider-btn.prev').addEventListener('click', prevSlide);

    // ドットナビゲーション
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // 自動スライド（5秒間隔）
    setInterval(nextSlide, 5000);
});
</script>

<?php get_footer(); ?>