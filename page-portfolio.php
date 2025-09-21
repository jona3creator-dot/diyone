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
                <!-- 映像制作 -->
                <div class="portfolio-item fade-in" data-category="video">
                    <div class="portfolio-image video-thumb">
                        <div class="play-button">▶</div>
                        <div class="portfolio-overlay">
                            <h3>企業PR動画制作</h3>
                            <p>製造業A社様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>企業紹介動画</h4>
                        <p>製造業A社様の企業理念と技術力をアピールする3分間のPR動画を制作。工場見学から社員インタビューまで包括的に撮影。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">企業PR</span>
                            <span class="portfolio-tag">撮影</span>
                            <span class="portfolio-tag">編集</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-in" data-category="video">
                    <div class="portfolio-image video-thumb">
                        <div class="play-button">▶</div>
                        <div class="portfolio-overlay">
                            <h3>商品紹介動画</h3>
                            <p>小売業B社様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>新商品プロモーション動画</h4>
                        <p>新商品のローンチに合わせたプロモーション動画。商品の特長を分かりやすく伝える構成で制作。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">商品PR</span>
                            <span class="portfolio-tag">プロモーション</span>
                            <span class="portfolio-tag">撮影</span>
                        </div>
                    </div>
                </div>

                <!-- デザイン制作 -->
                <div class="portfolio-item fade-in" data-category="design">
                    <div class="portfolio-image design-thumb">
                        <div class="portfolio-overlay">
                            <h3>ブランドロゴデザイン</h3>
                            <p>IT企業C社様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>コーポレートアイデンティティ</h4>
                        <p>IT企業のブランドロゴから名刺、会社案内パンフレットまで一貫したデザインで制作。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">ロゴデザイン</span>
                            <span class="portfolio-tag">CI/VI</span>
                            <span class="portfolio-tag">印刷物</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-in" data-category="design">
                    <div class="portfolio-image design-thumb">
                        <div class="portfolio-overlay">
                            <h3>Webバナー制作</h3>
                            <p>通販サイトD社様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>キャンペーンバナー</h4>
                        <p>季節のキャンペーンに合わせたWebバナーを複数パターン制作。CTR向上に貢献。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">Webバナー</span>
                            <span class="portfolio-tag">キャンペーン</span>
                            <span class="portfolio-tag">デジタル広告</span>
                        </div>
                    </div>
                </div>

                <!-- Web制作 -->
                <div class="portfolio-item fade-in" data-category="web">
                    <div class="portfolio-image web-thumb">
                        <div class="portfolio-overlay">
                            <h3>コーポレートサイト</h3>
                            <p>建設会社I社様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>建設会社のコーポレートサイト</h4>
                        <p>建設会社の信頼性を伝えるコーポレートサイトをWordPressで制作。レスポンシブ対応。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">WordPress</span>
                            <span class="portfolio-tag">コーポレートサイト</span>
                            <span class="portfolio-tag">レスポンシブ</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-in" data-category="web">
                    <div class="portfolio-image web-thumb">
                        <div class="portfolio-overlay">
                            <h3>ECサイト構築</h3>
                            <p>アパレルJ店様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>アパレルECサイト</h4>
                        <p>アパレルブランドのECサイトをShopifyで構築。決済システムから在庫管理まで連携。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">Shopify</span>
                            <span class="portfolio-tag">ECサイト</span>
                            <span class="portfolio-tag">アパレル</span>
                        </div>
                    </div>
                </div>

                <!-- SNS運用 -->
                <div class="portfolio-item fade-in" data-category="sns">
                    <div class="portfolio-image sns-thumb">
                        <div class="portfolio-overlay">
                            <h3>Instagram運用代行</h3>
                            <p>カフェE店様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>カフェのInstagram運用</h4>
                        <p>地域密着型カフェのInstagramアカウント運用。フォロワー数を6ヶ月で3倍に増加。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">Instagram</span>
                            <span class="portfolio-tag">コンテンツ制作</span>
                            <span class="portfolio-tag">投稿代行</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-in" data-category="sns">
                    <div class="portfolio-image sns-thumb">
                        <div class="portfolio-overlay">
                            <h3>TikTok動画制作</h3>
                            <p>美容サロンF様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>美容サロンのTikTok動画</h4>
                        <p>美容サロンの施術風景やビフォーアフターをTikTok向けにショート動画として制作。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">TikTok</span>
                            <span class="portfolio-tag">ショート動画</span>
                            <span class="portfolio-tag">美容</span>
                        </div>
                    </div>
                </div>

                <!-- 広告運用 -->
                <div class="portfolio-item fade-in" data-category="ads">
                    <div class="portfolio-image ads-thumb">
                        <div class="ads-icon">📊</div>
                        <div class="portfolio-overlay">
                            <h3>Meta広告運用</h3>
                            <p>ECサイトK社様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>Meta広告運用</h4>
                        <p>ECサイトのMeta広告を運用。ROAS300%を達成し売上大幅向上に貢献。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">Meta広告</span>
                            <span class="portfolio-tag">ROAS改善</span>
                            <span class="portfolio-tag">EC連携</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-in" data-category="ads">
                    <div class="portfolio-image ads-thumb">
                        <div class="ads-icon">📈</div>
                        <div class="portfolio-overlay">
                            <h3>Google広告運用</h3>
                            <p>サービス業L社様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>Google広告とGA4分析</h4>
                        <p>Google広告の運用とGA4を活用した詳細分析により、コンバージョン率を大幅改善。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">Google広告</span>
                            <span class="portfolio-tag">GA4分析</span>
                            <span class="portfolio-tag">CV改善</span>
                        </div>
                    </div>
                </div>

                <!-- YouTube運営とM&A -->
                <div class="portfolio-item fade-in" data-category="youtube">
                    <div class="portfolio-image youtube-thumb">
                        <div class="play-button">▶</div>
                        <div class="portfolio-overlay">
                            <h3>YouTubeチャンネル運営</h3>
                            <p>教育系G社様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>教育系YouTubeチャンネル</h4>
                        <p>教育コンテンツのYouTubeチャンネル立ち上げから運営まで。チャンネル登録者1万人達成。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">YouTube運営</span>
                            <span class="portfolio-tag">教育コンテンツ</span>
                            <span class="portfolio-tag">チャンネル設計</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-in" data-category="youtube">
                    <div class="portfolio-image youtube-thumb">
                        <div class="play-button">▶</div>
                        <div class="portfolio-overlay">
                            <h3>商品レビュー動画</h3>
                            <p>EC事業H社様</p>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h4>商品レビューチャンネル</h4>
                        <p>EC事業者様の商品レビュー動画を定期的に制作。購入率向上に大きく貢献。</p>
                        <div class="portfolio-tags">
                            <span class="portfolio-tag">商品レビュー</span>
                            <span class="portfolio-tag">EC連携</span>
                            <span class="portfolio-tag">動画制作</span>
                        </div>
                    </div>
                </div>


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
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
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

.video-thumb {
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

.play-button,
.ads-icon {
    font-size: 2rem;
    color: white;
}

.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.portfolio-item:hover .portfolio-overlay {
    opacity: 1;
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
}
</style>

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