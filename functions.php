<?php
/**
 * DIYONE Corporate Theme Functions
 */

// テーマのセットアップ
function diyone_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'
    ));
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'diyone_theme_setup');

// スタイルとスクリプトの読み込み
function diyone_enqueue_scripts() {
    wp_enqueue_style('diyone-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_script('diyone-script', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'diyone_enqueue_scripts');

// お問い合わせフォームの処理
function handle_contact_form_submission() {
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_die('セキュリティチェックに失敗しました。');
    }

    $name = sanitize_text_field($_POST['name']);
    $company = sanitize_text_field($_POST['company']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);
    $privacy_agree = isset($_POST['privacy-agree']) ? 1 : 0;

    $errors = array();
    
    if (empty($name)) $errors[] = 'お名前は必須です。';
    if (empty($email) || !is_email($email)) $errors[] = '有効なメールアドレスを入力してください。';
    if (empty($message)) $errors[] = 'お問い合わせ内容は必須です。';
    if (!$privacy_agree) $errors[] = 'プライバシーポリシーに同意してください。';

    if (!empty($errors)) {
        $error_message = implode('\\n', $errors);
        wp_die('<script>alert("' . esc_js($error_message) . '"); history.back();</script>');
    }

    // 管理者へのメール送信
    $admin_email = get_option('admin_email');
    $subject = 'お問い合わせがありました - ' . get_bloginfo('name');
    
    $admin_message = "お問い合わせフォームから新しいメッセージが届きました。\n\n";
    $admin_message .= "お名前: " . $name . "\n";
    $admin_message .= "会社名: " . $company . "\n";
    $admin_message .= "メールアドレス: " . $email . "\n";
    $admin_message .= "電話番号: " . $phone . "\n";
    $admin_message .= "希望サービス: " . $service . "\n";
    $admin_message .= "お問い合わせ内容:\n" . $message . "\n\n";
    $admin_message .= "送信日時: " . date('Y-m-d H:i:s') . "\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . $admin_email . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    wp_mail($admin_email, $subject, $admin_message, $headers);

    // お客様への自動返信メール
    $customer_subject = 'お問い合わせありがとうございます - ' . get_bloginfo('name');
    
    $customer_message = $name . " 様\n\n";
    $customer_message .= "この度は、DIYONEにお問い合わせいただき、誠にありがとうございます。\n\n";
    $customer_message .= "以下の内容でお問い合わせを受け付けいたしました。\n";
    $customer_message .= "内容を確認の上、2営業日以内にご連絡させていただきます。\n\n";
    $customer_message .= "【お問い合わせ内容】\n";
    $customer_message .= "お名前: " . $name . "\n";
    $customer_message .= "会社名: " . $company . "\n";
    $customer_message .= "メールアドレス: " . $email . "\n";
    $customer_message .= "電話番号: " . $phone . "\n";
    $customer_message .= "希望サービス: " . $service . "\n";
    $customer_message .= "お問い合わせ内容:\n" . $message . "\n\n";
    $customer_message .= "今後ともよろしくお願いいたします。\n\n";
    $customer_message .= "DIYONE\nメール: info@diyone.com\n";

    $customer_headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: DIYONE <' . $admin_email . '>'
    );

    wp_mail($email, $customer_subject, $customer_message, $customer_headers);

    wp_redirect(home_url('/contact-thanks/'));
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
                    window.history.replaceState(null, null, "' . home_url('/') . '");
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
    $wp_customize->add_section('hero_section', array(
        'title'    => 'ヒーローセクション',
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'オンライン完結のワンストップサポート',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('hero_subtitle', array(
        'label'    => 'ヒーローサブタイトル',
        'section'  => 'hero_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('hero_title', array(
        'default'           => '唯一無二の価値を<br>あなたのビジネスに',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('hero_title', array(
        'label'    => 'ヒーロータイトル',
        'section'  => 'hero_section',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('hero_description', array(
        'default'           => 'コンテンツ制作からSNSマーケティングまで、<br>オンライン完結の打ち合わせだけでワンストップでサポートします',
        'sanitize_callback' => 'wp_kses_post',
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
    }
}
add_action('send_headers', 'diyone_security_headers');

// 不要なWordPressヘッダー情報を削除
function diyone_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'diyone_cleanup_head');
?>

