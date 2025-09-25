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
    wp_redirect(home_url('/?contact=success'));
    exit;
}
add_action('admin_post_submit_contact_form', 'handle_contact_form_submission');
add_action('admin_post_nopriv_submit_contact_form', 'handle_contact_form_submission');

// お問い合わせ成功メッセージ
function show_contact_success_message() {
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

?>