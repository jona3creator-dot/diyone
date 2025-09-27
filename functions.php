<?php
/**
 * DIYONE Corporate Theme Functions (ver.1.1.3)
 * 最新版：重複削除、セキュリティ向上、パフォーマンス最適化
 */

// テーマのセットアップ
function diyone_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'
    ));
    add_theme_support('customize-selective-refresh-widgets');
    
    // RSS フィードのサポート
    add_theme_support('automatic-feed-links');
    
    // エディターのスタイル
    add_theme_support('editor-styles');
    
    // ワイドアライメントのサポート
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'diyone_theme_setup');

// スタイルとスクリプトの読み込み
function diyone_enqueue_scripts() {
    $theme_version = wp_get_theme()->get('Version');
    
    // スタイルシート
    wp_enqueue_style('diyone-style', get_stylesheet_uri(), array(), $theme_version);
    
    // JavaScriptファイル
    wp_enqueue_script('diyone-script', get_template_directory_uri() . '/js/script.js', array(), $theme_version, true);
    
    // WordPress標準のスクリプト
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'diyone_enqueue_scripts');

// お問い合わせフォームの処理
function handle_contact_form_submission() {
    // セキュリティチェック
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_die('セキュリティチェックに失敗しました。', 'エラー', array('response' => 403));
    }
    
    // レート制限チェック（1分間に3回まで）
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $rate_limit_key = 'contact_form_' . md5($user_ip);
    $attempts = get_transient($rate_limit_key);
    
    if ($attempts && $attempts >= 3) {
        wp_die('送信制限に達しました。しばらくしてからもう一度お試しください。', 'エラー', array('response' => 429));
    }
    
    // 入力データの取得とサニタイズ
    $name = sanitize_text_field($_POST['name']);
    $furigana = sanitize_text_field($_POST['furigana']);
    $company = sanitize_text_field($_POST['company']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);
    $privacy_agree = isset($_POST['privacy-agree']) ? 1 : 0;
    
    // バリデーション
    $errors = array();
    
    if (empty($name)) {
        $errors[] = 'お名前は必須です。';
    }
    
    if (empty($furigana)) {
        $errors[] = 'ふりがなは必須です。';
    }
    
    if (empty($email) || !is_email($email)) {
        $errors[] = '有効なメールアドレスを入力してください。';
    }
    
    if (empty($message)) {
        $errors[] = 'お問い合わせ内容は必須です。';
    }
    
    if (!$privacy_agree) {
        $errors[] = 'プライバシーポリシーに同意してください。';
    }
    
    // スパムチェック（簡易）
    if (preg_match('/https?:\/\//', $message) && substr_count($message, 'http') > 2) {
        $errors[] = 'スパムの可能性があります。';
    }
    
    if (!empty($errors)) {
        $error_message = implode('\\n', $errors);
        wp_die('<script>alert("' . esc_js($error_message) . '"); history.back();</script>');
    }
    
    // レート制限カウンターの更新
    $new_attempts = $attempts ? $attempts + 1 : 1;
    set_transient($rate_limit_key, $new_attempts, 60); // 1分間

    // Googleスプレッドシートに送信
    $spreadsheet_url = 'https://script.google.com/macros/s/AKfycbz1KnDw3y2OmYHg-vwLz0zjD4cRUljqHCdcqOWZreWHJYIvDOG2Ew1FZ2BGOoTUh_RT/exec'; // Step 2-8で取得したURL
    
    $post_data = array(
        'name' => $name,
        'furigana' => $furigana,
        'company' => $company,
        'email' => $email,
        'phone' => $phone,
        'service' => $service,
        'message' => $message,
        'ip' => $_SERVER['REMOTE_ADDR']
    );
    
    // Google Apps Scriptに送信
    $response = wp_remote_post($spreadsheet_url, array(
        'body' => $post_data,
        'timeout' => 30
    ));
    
    // 管理者へのメール送信
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    $subject = 'お問い合わせがありました - ' . $site_name;
    
    $admin_message = "お問い合わせフォームから新しいメッセージが届きました。\n\n";
    $admin_message .= "【送信者情報】\n";
    $admin_message .= "お名前: " . $name . "\n";
    $admin_message .= "ふりがな: " . $furigana . "\n";
    $admin_message .= "会社名: " . $company . "\n";
    $admin_message .= "メールアドレス: " . $email . "\n";
    $admin_message .= "電話番号: " . $phone . "\n";
    $admin_message .= "希望サービス: " . $service . "\n\n";
    $admin_message .= "【お問い合わせ内容】\n";
    $admin_message .= $message . "\n\n";
    $admin_message .= "【システム情報】\n";
    $admin_message .= "送信日時: " . date('Y-m-d H:i:s') . "\n";
    $admin_message .= "IPアドレス: " . $user_ip . "\n";
    $admin_message .= "ユーザーエージェント: " . sanitize_text_field($_SERVER['HTTP_USER_AGENT']) . "\n";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );
    
    $mail_sent = wp_mail($admin_email, $subject, $admin_message, $headers);
    
    if (!$mail_sent) {
        error_log('DIYONE: Failed to send admin email for contact form');
    }
    
    // お客様への自動返信メール
    $customer_subject = 'お問い合わせありがとうございます - ' . $site_name;
    
    $customer_message = $name . " 様\n\n";
    $customer_message .= "この度は、DIYONEにお問い合わせいただき、誠にありがとうございます。\n\n";
    $customer_message .= "以下の内容でお問い合わせを受け付けいたしました。\n";
    $customer_message .= "内容を確認の上、2営業日以内にご連絡させていただきます。\n\n";
    $customer_message .= "【お問い合わせ内容】\n";
    $customer_message .= "お名前: " . $name . "\n";
    $customer_message .= "ふりがな: " . $furigana . "\n";
    $customer_message .= "会社名: " . $company . "\n";
    $customer_message .= "メールアドレス: " . $email . "\n";
    $customer_message .= "電話番号: " . $phone . "\n";
    $customer_message .= "希望サービス: " . $service . "\n";
    $customer_message .= "お問い合わせ内容:\n" . $message . "\n\n";
    $customer_message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $customer_message .= "DIYONE（ディーワイワン）\n";
    $customer_message .= "オンライン完結のワンストップデジタルサービス\n";
    $customer_message .= "メール: diyone001@gmail.com\n";
    $customer_message .= "ウェブサイト: " . home_url() . "\n";
    $customer_message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    
    $customer_headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: DIYONE <' . $admin_email . '>'
    );
    
    $customer_mail_sent = wp_mail($email, $customer_subject, $customer_message, $customer_headers);
    
    if (!$customer_mail_sent) {
        error_log('DIYONE: Failed to send customer email for contact form');
    }
    
    // リダイレクト
    wp_redirect(home_url('/contact-thanks/'));
    exit;
}
add_action('admin_post_submit_contact_form', 'handle_contact_form_submission');
add_action('admin_post_nopriv_submit_contact_form', 'handle_contact_form_submission');

// お問い合わせ成功メッセージ
/*function show_contact_success_message() {
    if (isset($_GET['contact']) && $_GET['contact'] === 'success') {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                alert("お問い合わせありがとうございました。\\n2営業日以内にご連絡させていただきます。");
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, "' . esc_js(home_url('/')) . '");
                }
                setTimeout(function() {
                    const contactSection = document.getElementById("contact");
                    if (contactSection) {
                        contactSection.scrollIntoView({ behavior: "smooth" });
                    }
                }, 500);
            });
        </script>';
    }
}
add_action('wp_head', 'show_contact_success_message');
*/

// カスタマイザー設定
function diyone_customize_register($wp_customize) {
    // ヒーローセクション
    $wp_customize->add_section('hero_section', array(
        'title'    => 'ヒーローセクション',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'オンライン完結のワンストップサポート',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'    => 'ヒーローサブタイトル',
        'section'  => 'hero_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default'           => '唯一無二の価値を<br>あなたのビジネスに',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'    => 'ヒーロータイトル',
        'section'  => 'hero_section',
        'type'     => 'textarea',
    ));
    
    $wp_customize->add_setting('hero_description', array(
        'default'           => 'コンテンツ制作からSNSマーケティングまで、<br>オンライン完結の打ち合わせだけでワンストップでサポートします',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('hero_description', array(
        'label'    => 'ヒーロー説明文',
        'section'  => 'hero_section',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'diyone_customize_register');

// セキュリティ強化
function diyone_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'diyone_security_headers');

// 不要なWordPressヘッダー情報を削除
function diyone_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_header');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
}
add_action('init', 'diyone_cleanup_head');

// 画像の最適化
function diyone_add_image_sizes() {
    add_image_size('portfolio-thumb', 400, 300, true);
    add_image_size('hero-image', 1200, 600, true);
}
add_action('after_setup_theme', 'diyone_add_image_sizes');

// パフォーマンス最適化
function diyone_optimize_performance() {
    // 不要なCSSとJSを削除
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('classic-theme-styles');
    }
}
add_action('wp_enqueue_scripts', 'diyone_optimize_performance', 100);

// コンタクトフォームのログ記録
function diyone_log_contact_form($name, $email, $message) {
    $log_entry = array(
        'timestamp' => current_time('mysql'),
        'name' => $name,
        'email' => $email,
        'message' => substr($message, 0, 100) . '...',
        'ip' => $_SERVER['REMOTE_ADDR']
    );
    
    $logs = get_option('diyone_contact_logs', array());
    $logs[] = $log_entry;
    
    // 最新50件のみ保持
    if (count($logs) > 50) {
        $logs = array_slice($logs, -50);
    }
    
    update_option('diyone_contact_logs', $logs);
}

// 管理画面のカスタマイズ
function diyone_admin_init() {
    // 管理画面にコンタクトフォームのログを表示するメニューを追加
    add_menu_page(
        'お問い合わせログ',
        'お問い合わせログ',
        'manage_options',
        'diyone-contact-logs',
        'diyone_contact_logs_page'
    );
}
add_action('admin_menu', 'diyone_admin_init');

function diyone_contact_logs_page() {
    $logs = get_option('diyone_contact_logs', array());
    ?>
    <div class="wrap">
        <h1>お問い合わせログ</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>日時</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>メッセージ（抜粋）</th>
                    <th>IPアドレス</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($logs)): ?>
                <tr>
                    <td colspan="5">ログがありません</td>
                </tr>
                <?php else: ?>
                <?php foreach (array_reverse($logs) as $log): ?>
                <tr>
                    <td><?php echo esc_html($log['timestamp']); ?></td>
                    <td><?php echo esc_html($log['name']); ?></td>
                    <td><?php echo esc_html($log['email']); ?></td>
                    <td><?php echo esc_html($log['message']); ?></td>
                    <td><?php echo esc_html($log['ip']); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// WordPress標準のCSS最適化
function diyone_optimize_css() {
    if (!is_admin() && !is_customize_preview()) {
        // Emoji関連のスクリプトを無効化
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
    }
}
add_action('init', 'diyone_optimize_css');

// エラーログの設定
function diyone_error_handler($errno, $errstr, $errfile, $errline) {
    if (strpos($errfile, 'diyone') !== false) {
        error_log("DIYONE Theme Error: $errstr in $errfile on line $errline");
    }
}
set_error_handler('diyone_error_handler');

// ===== ポートフォリオ管理システム =====

// ポートフォリオのカスタム投稿タイプを登録
function diyone_register_portfolio_post_type() {
    $args = array(
        'label' => 'ポートフォリオ',
        'labels' => array(
            'name' => 'ポートフォリオ',
            'singular_name' => 'ポートフォリオ',
            'add_new' => '新規追加',
            'add_new_item' => '新しいポートフォリオを追加',
            'edit_item' => 'ポートフォリオを編集',
            'new_item' => '新規ポートフォリオ',
            'view_item' => 'ポートフォリオを表示',
            'search_items' => 'ポートフォリオを検索',
            'not_found' => 'ポートフォリオが見つかりません',
            'all_items' => '全てのポートフォリオ',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'work'),
        'menu_position' => 20,
        'capability_type' => 'post',
        'hierarchical' => false,
    );
    register_post_type('portfolio', $args);
}
add_action('init', 'diyone_register_portfolio_post_type');

// ポートフォリオのカテゴリータクソノミーを登録
function diyone_register_portfolio_taxonomy() {
    $args = array(
        'label' => 'カテゴリー',
        'labels' => array(
            'name' => 'ポートフォリオカテゴリー',
            'singular_name' => 'カテゴリー',
            'add_new_item' => '新しいカテゴリーを追加',
            'edit_item' => 'カテゴリーを編集',
            'update_item' => 'カテゴリーを更新',
            'view_item' => 'カテゴリーを表示',
            'separate_items_with_commas' => 'カテゴリーをカンマで区切る',
            'add_or_remove_items' => 'カテゴリーを追加または削除',
            'choose_from_most_used' => 'よく使われるカテゴリーから選択',
            'popular_items' => '人気のカテゴリー',
            'search_items' => 'カテゴリーを検索',
            'not_found' => 'カテゴリーが見つかりません',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'portfolio-category'),
    );
    register_taxonomy('portfolio_category', 'portfolio', $args);
}
add_action('init', 'diyone_register_portfolio_taxonomy');

// カスタムフィールドの追加
function diyone_add_portfolio_meta_boxes() {
    add_meta_box(
        'portfolio_details',
        'ポートフォリオ詳細情報',
        'diyone_portfolio_meta_box_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'diyone_add_portfolio_meta_boxes');

// カスタムフィールドの表示
function diyone_portfolio_meta_box_callback($post) {
    wp_nonce_field('diyone_save_portfolio_meta', 'diyone_portfolio_nonce');
    
    $client_name = get_post_meta($post->ID, '_client_name', true);
    $project_type = get_post_meta($post->ID, '_project_type', true);
    $results = get_post_meta($post->ID, '_results', true);
    $tags = get_post_meta($post->ID, '_tags', true);
    $result_numbers = get_post_meta($post->ID, '_result_numbers', true);
    $social_url = get_post_meta($post->ID, '_social_url', true);
    $media_type = get_post_meta($post->ID, '_media_type', true) ?: 'image';
    $featured_on_home = get_post_meta($post->ID, '_featured_on_home', true);
    $home_display_order = get_post_meta($post->ID, '_home_display_order', true) ?: '1';
    ?>
    <style>
        .portfolio-meta-table { width: 100%; border-collapse: collapse; }
        .portfolio-meta-table th { width: 20%; padding: 10px; vertical-align: top; background: #f1f1f1; }
        .portfolio-meta-table td { padding: 10px; }
        .portfolio-meta-table input, .portfolio-meta-table select, .portfolio-meta-table textarea { width: 100%; }
        .portfolio-meta-table textarea { height: 80px; resize: vertical; }
        .social-preview { margin-top: 10px; padding: 10px; background: #f9f9f9; border-radius: 5px; }
        .social-field { display: none; }
        .social-field.active { display: table-row; }
        .featured-order-field { display: none; }
        .featured-order-field.active { display: table-row; }
    </style>
    
    <table class="portfolio-meta-table">
        <tr>
            <th><label for="media_type">メディアタイプ</label></th>
            <td>
                <select id="media_type" name="media_type" onchange="toggleMediaFields()">
                    <option value="image" <?php selected($media_type, 'image'); ?>>画像のみ</option>
                    <option value="youtube_video" <?php selected($media_type, 'youtube_video'); ?>>YouTube動画</option>
                    <option value="youtube_channel" <?php selected($media_type, 'youtube_channel'); ?>>YouTubeチャンネル</option>
                    <option value="instagram_account" <?php selected($media_type, 'instagram_account'); ?>>Instagramアカウント</option>
                    <option value="instagram_post" <?php selected($media_type, 'instagram_post'); ?>>Instagram投稿</option>
                    <option value="instagram_reel" <?php selected($media_type, 'instagram_reel'); ?>>Instagramリール</option>
                    <option value="tiktok_account" <?php selected($media_type, 'tiktok_account'); ?>>TikTokアカウント</option>
                    <option value="tiktok_video" <?php selected($media_type, 'tiktok_video'); ?>>TikTok動画</option>
                </select>
                <p><small>ソーシャルメディアを選択した場合、アイキャッチ画像は自動で適切な表示に変わります</small></p>
            </td>
        </tr>
        
        <tr class="social-field <?php echo ($media_type !== 'image') ? 'active' : ''; ?>">
            <th><label for="social_url">ソーシャルメディアURL</label></th>
            <td>
                <input type="url" id="social_url" name="social_url" value="<?php echo esc_attr($social_url); ?>" placeholder="URLを入力してください" />
                <div class="social-preview">
                    <p><strong>対応URL形式：</strong></p>
                    <ul>
                        <li><strong>YouTube動画:</strong> https://www.youtube.com/watch?v=xxxxx または https://youtu.be/xxxxx</li>
                        <li><strong>YouTube Shorts:</strong> https://www.youtube.com/shorts/xxxxx</li>
                        <li><strong>YouTubeチャンネル:</strong> https://www.youtube.com/channel/xxxxx または https://www.youtube.com/@username</li>
                        <li><strong>Instagram投稿:</strong> https://www.instagram.com/p/xxxxx/</li>
                        <li><strong>Instagramリール:</strong> https://www.instagram.com/reel/xxxxx/</li>
                        <li><strong>Instagramアカウント:</strong> https://www.instagram.com/username/</li>
                        <li><strong>TikTok動画:</strong> https://www.tiktok.com/@username/video/xxxxx</li>
                        <li><strong>TikTokアカウント:</strong> https://www.tiktok.com/@username</li>
                    </ul>
                    <p><strong>注意:</strong> アイキャッチ画像を設定すると、そちらが優先表示されます。自動アイコンを使いたい場合はアイキャッチ画像を設定しないでください。</p>
                </div>
            </td>
        </tr>
        
        <tr>
            <th><label for="client_name">クライアント名</label></th>
            <td><input type="text" id="client_name" name="client_name" value="<?php echo esc_attr($client_name); ?>" placeholder="例: 製造業A社様" /></td>
        </tr>
        
        <tr>
            <th><label for="project_type">プロジェクトタイプ</label></th>
            <td>
                <select id="project_type" name="project_type">
                    <option value="">選択してください</option>
                    <option value="video" <?php selected($project_type, 'video'); ?>>映像制作</option>
                    <option value="design" <?php selected($project_type, 'design'); ?>>デザイン制作</option>
                    <option value="web" <?php selected($project_type, 'web'); ?>>Web制作</option>
                    <option value="sns" <?php selected($project_type, 'sns'); ?>>SNS運用</option>
                    <option value="ads" <?php selected($project_type, 'ads'); ?>>広告運用</option>
                    <option value="youtube" <?php selected($project_type, 'youtube'); ?>>YouTube運営とM&A</option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th><label for="result_numbers">成果（数値）</label></th>
            <td><input type="text" id="result_numbers" name="result_numbers" value="<?php echo esc_attr($result_numbers); ?>" placeholder="例: 視聴完了率: 85%, 売上向上: 150%" /></td>
        </tr>
        
        <tr>
            <th><label for="results">成果詳細説明</label></th>
            <td><textarea id="results" name="results" placeholder="成果の詳細説明を入力してください"><?php echo esc_textarea($results); ?></textarea></td>
        </tr>
        
        <tr>
            <th><label for="tags">タグ</label></th>
            <td><input type="text" id="tags" name="tags" value="<?php echo esc_attr($tags); ?>" placeholder="例: 企業PR, 撮影, 編集（カンマ区切り）" /></td>
        </tr>
        
        <tr>
            <th><label for="featured_on_home">トップページ表示</label></th>
            <td>
                <input type="checkbox" id="featured_on_home" name="featured_on_home" value="1" <?php checked($featured_on_home, '1'); ?> />
                <label for="featured_on_home">このポートフォリオをトップページに表示する</label>
                <p><small>チェックを入れると、トップページのポートフォリオセクションに表示されます（最大8つ）</small></p>
            </td>
        </tr>

        <tr class="featured-order-field <?php echo $featured_on_home ? 'active' : ''; ?>">
            <th><label for="home_display_order">表示順序</label></th>
            <td>
                <input type="number" id="home_display_order" name="home_display_order" value="<?php echo esc_attr($home_display_order); ?>" min="1" max="8" />
                <p><small>1-8の数字で表示順序を指定（1が最初）</small></p>
            </td>
        </tr>
    </table>
    
    <script>
    function toggleMediaFields() {
        const mediaType = document.getElementById('media_type').value;
        const socialField = document.querySelector('.social-field');
        
        if (mediaType !== 'image') {
            socialField.classList.add('active');
        } else {
            socialField.classList.remove('active');
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        toggleMediaFields();
        
        document.getElementById('featured_on_home').addEventListener('change', function() {
            const orderField = document.querySelector('.featured-order-field');
            if (this.checked) {
                orderField.classList.add('active');
            } else {
                orderField.classList.remove('active');
            }
        });
    });
    </script>
    <?php
}

function diyone_save_portfolio_meta($post_id) {
    // セキュリティチェック
    if (!isset($_POST['diyone_portfolio_nonce']) || !wp_verify_nonce($_POST['diyone_portfolio_nonce'], 'diyone_save_portfolio_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // フィールドの保存（social_urlに変更）
    $fields = array('client_name', 'project_type', 'results', 'tags', 'result_numbers', 'social_url', 'media_type', 'featured_on_home', 'home_display_order');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
            if ($field === 'results') {
                $value = sanitize_textarea_field($value);
            } elseif ($field === 'social_url') {
                $value = esc_url_raw($value);
            } else {
                $value = sanitize_text_field($value);
            }
            update_post_meta($post_id, '_' . $field, $value);
        } else {
            if ($field === 'featured_on_home') {
                delete_post_meta($post_id, '_featured_on_home');
            }
        }
    }
}
add_action('save_post', 'diyone_save_portfolio_meta');

// 管理画面のポートフォリオ一覧にカスタムカラムを追加
function diyone_portfolio_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['client_name'] = 'クライアント名';
    $new_columns['project_type'] = 'タイプ';
    $new_columns['portfolio_category'] = 'カテゴリー';
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_portfolio_posts_columns', 'diyone_portfolio_columns');

// カスタムカラムの内容を表示
function diyone_portfolio_column_content($column, $post_id) {
    switch ($column) {
        case 'client_name':
            echo esc_html(get_post_meta($post_id, '_client_name', true));
            break;
        case 'project_type':
            $type = get_post_meta($post_id, '_project_type', true);
            $type_labels = array(
                'video' => '映像制作',
                'design' => 'デザイン制作',
                'web' => 'Web制作',
                'sns' => 'SNS運用',
                'ads' => '広告運用',
                'youtube' => 'YouTube運営',
            );
            echo isset($type_labels[$type]) ? $type_labels[$type] : '未設定';
            break;
        case 'portfolio_category':
            $terms = get_the_terms($post_id, 'portfolio_category');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array();
                foreach ($terms as $term) {
                    $term_names[] = $term->name;
                }
                echo implode(', ', $term_names);
            }
            break;
    }
}
add_action('manage_portfolio_posts_custom_column', 'diyone_portfolio_column_content', 10, 2);

// URL書き換えルールを更新
function diyone_flush_rewrite_rules() {
    diyone_register_portfolio_post_type();
    diyone_register_portfolio_taxonomy();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'diyone_flush_rewrite_rules');

// ===== ポートフォリオ管理システム終了 =====

// サムネイル自動取得関数
function get_social_media_thumbnail($media_type, $social_url, $post_id) {
    // アイキャッチ画像が設定されている場合は優先
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail($post_id, 'medium');
    }
    
    // メディアタイプ別のサムネイル取得
    switch($media_type) {
        case 'youtube_video':
            return get_youtube_thumbnail($social_url);
        case 'youtube_channel':
            return get_youtube_channel_thumbnail($social_url);
        case 'instagram_post':
        case 'instagram_reel':
            return get_instagram_thumbnail($social_url);
        case 'instagram_account':
            return get_instagram_profile_image($social_url);
        case 'tiktok_video':
            return get_tiktok_thumbnail($social_url);
        case 'tiktok_account':
            return get_tiktok_profile_image($social_url);
        default:
            return get_social_media_icon($media_type, $social_url);
    }
}

// YouTube動画サムネイル取得
function get_youtube_thumbnail($url) {
    $video_id = extract_youtube_video_id($url);
    if ($video_id) {
        $thumbnail_url = "https://img.youtube.com/vi/{$video_id}/maxresdefault.jpg";
        return '<img src="' . esc_url($thumbnail_url) . '" alt="YouTube Thumbnail" style="width:100%;height:100%;object-fit:cover;" onerror="this.src=\'https://img.youtube.com/vi/' . $video_id . '/hqdefault.jpg\'">';
    }
    return '<div class="social-icon youtube-icon">📺</div>';
}

// YouTubeチャンネルサムネイル（プレースホルダー）
function get_youtube_channel_thumbnail($url) {
    // チャンネル画像はAPI必須のため、プレースホルダー使用
    return '<div class="channel-placeholder youtube-channel">
                <div class="channel-icon">📺</div>
                <div class="channel-text">YouTube<br>Channel</div>
            </div>';
}

// Instagram投稿サムネイル（プレースホルダー）
function get_instagram_thumbnail($url) {
    return '<div class="social-placeholder instagram-post">
                <div class="social-icon">📸</div>
                <div class="social-text">Instagram<br>Post</div>
            </div>';
}

// Instagramプロフィール画像（プレースホルダー）
function get_instagram_profile_image($url) {
    return '<div class="social-placeholder instagram-profile">
                <div class="social-icon">👤</div>
                <div class="social-text">Instagram<br>Profile</div>
            </div>';
}

// TikTok動画サムネイル（プレースホルダー）
function get_tiktok_thumbnail($url) {
    return '<div class="social-placeholder tiktok-video">
                <div class="social-icon">🎵</div>
                <div class="social-text">TikTok<br>Video</div>
            </div>';
}

// TikTokプロフィール画像（プレースホルダー）
function get_tiktok_profile_image($url) {
    return '<div class="social-placeholder tiktok-profile">
                <div class="social-icon">👤</div>
                <div class="social-text">TikTok<br>Profile</div>
            </div>';
}

// YouTube Video ID抽出関数
function extract_youtube_video_id($url) {
    $patterns = [
        '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^#&?]*)/',
        '/youtube\.com\/shorts\/([^#&?]*)/',
        '/youtube\.com\/v\/([^#&?]*)/'
    ];
    
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
    }
    return false;
}

?>

