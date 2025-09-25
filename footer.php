<?php
/**
 * Footer template - DIYONE Corporate Website (ver.1.1.0)
 * 最新版：重複削除、構造最適化
 */
?>
    </div><!-- #page -->
    <footer id="colophon" class="site-footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-info">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-link">
                        <div class="footer-logo-icon">D</div>
                        DIYONE
                    </a>
                    <p class="footer-description">
                        オンライン完結のワンストップサービスで、あなたのビジネスに唯一無二の価値を提供します。コンテンツ制作からマーケティングまで、幅広いデジタルソリューションをお任せください。
                    </p>
                </div>
                <div class="footer-nav">
                    <div class="footer-nav-column">
                        <h4>サービス</h4>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/#services')); ?>">映像制作</a></li>
                            <li><a href="<?php echo esc_url(home_url('/#services')); ?>">デザイン制作</a></li>
                            <li><a href="<?php echo esc_url(home_url('/#services')); ?>">Web制作</a></li>
                            <li><a href="<?php echo esc_url(home_url('/#services')); ?>">SNS運用</a></li>
                            <li><a href="<?php echo esc_url(home_url('/#services')); ?>">広告運用</a></li>
                            <li><a href="<?php echo esc_url(home_url('/#services')); ?>">YouTube運営とM&A</a></li>
                            <li><a href="<?php echo esc_url(home_url('/#services')); ?>">オンライン事務</a></li>
                        </ul>
                    </div>
                    <div class="footer-nav-column">
                        <h4>会社情報</h4>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/#company')); ?>">会社概要</a></li>
                            <li><a href="<?php echo esc_url(home_url('/#contact')); ?>">お問い合わせ</a></li>
                            <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy'))); ?>">プライバシーポリシー</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> DIYONE. All rights reserved.</p>
                <p class="footer-credit">Created with passion for digital excellence</p>
            </div>
        </div>
    </footer>
    
    <!-- 上に戻るボタン -->
    <a href="#" class="back-to-top" id="back-to-top">
        ↑
    </a>
    
    <?php wp_footer(); ?>
</body>
</html>