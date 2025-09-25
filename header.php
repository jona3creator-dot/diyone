<?php
/**
 * Header template - DIYONE Corporate Website (ver.1.1.3)
 * 最新版：重複削除、SEO最適化、アクセシビリティ向上
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- SEO関連のメタタグ -->
    <meta name="description" content="DIYONEは映像制作、デザイン制作、SNS運用代行など、オンライン完結のワンストップデジタルサービスを提供します。">
    <meta name="keywords" content="映像制作, デザイン制作, SNS運用, YouTube運営, オンライン事務, 広告運用">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php bloginfo('name'); ?> - 唯一無二の価値をあなたのビジネスに">
    <meta property="og:description" content="コンテンツ制作からSNSマーケティングまで、オンライン完結のワンストップサービス">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="オンライン完結のワンストップデジタルサービス">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <!-- スキップリンク（アクセシビリティ対応） -->
    <a class="sr-only sr-only-focusable" href="#primary">メインコンテンツにスキップ</a>

    <header id="masthead" class="site-header">
        <nav class="main-navigation" role="navigation" aria-label="メインナビゲーション">
            <div class="nav-container">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" aria-label="DIYONEホームページ">
                    <div class="logo-icon" aria-hidden="true">D</div>
                    <span>DIYONE</span>
                </a>
                
                <ul class="nav-menu" role="menubar">
                    <li role="menuitem">
                        <a href="<?php echo esc_url(home_url('/#services')); ?>">サービス</a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo esc_url(home_url('/#workflow')); ?>">制作フロー</a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo esc_url(home_url('/#strengths')); ?>">強み</a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo esc_url(home_url('/#portfolio')); ?>">実績</a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo esc_url(home_url('/#testimonials')); ?>">お客様の声</a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo esc_url(home_url('/#company')); ?>">会社概要</a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="cta-button">お問い合わせ</a>
                    </li>
                </ul>
                
                <button class="mobile-menu-toggle" aria-label="モバイルメニューを開く" aria-expanded="false" aria-controls="mobile-menu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </button>
            </div>
        </nav>
    </header>

    <div class="mobile-menu-overlay" id="mobile-menu-overlay" aria-hidden="true">
        <div class="mobile-menu" id="mobile-menu" role="dialog" aria-labelledby="mobile-menu-title">
            <h2 id="mobile-menu-title" class="sr-only">モバイルメニュー</h2>
            <button class="mobile-menu-close" aria-label="メニューを閉じる">&times;</button>
            <ul class="mobile-nav-menu" role="menubar">
                <li role="menuitem">
                    <a href="<?php echo esc_url(home_url('/#services')); ?>">サービス</a>
                </li>
                <li role="menuitem">
                    <a href="<?php echo esc_url(home_url('/#workflow')); ?>">制作フロー</a>
                </li>
                <li role="menuitem">
                    <a href="<?php echo esc_url(home_url('/#strengths')); ?>">強み</a>
                </li>
                <li role="menuitem">
                    <a href="<?php echo esc_url(home_url('/#portfolio')); ?>">実績</a>
                </li>
                <li role="menuitem">
                    <a href="<?php echo esc_url(home_url('/#testimonials')); ?>">お客様の声</a>
                </li>
                <li role="menuitem">
                    <a href="<?php echo esc_url(home_url('/#company')); ?>">会社概要</a>
                </li>
                <li role="menuitem">
                    <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="mobile-cta-button">お問い合わせ</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- 構造化データ（JSON-LD） -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "DIYONE",
        "description": "オンライン完結のワンストップデジタルサービス",
        "url": "<?php echo home_url(); ?>",
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "email": "diyone001@gmail.com"
        },
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "ID",
            "addressLocality": "Bali"
        }
    }
    </script>