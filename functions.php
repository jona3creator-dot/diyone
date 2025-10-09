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

// ポートフォリオカスタム投稿タイプの登録
function diyone_register_portfolio_post_type() {
    $labels = array(
        'name'                  => 'ポートフォリオ',
        'singular_name'         => 'ポートフォリオ',
        'menu_name'             => 'ポートフォリオ',
        'add_new'               => '新規追加',
        'add_new_item'          => '新規ポートフォリオを追加',
        'edit_item'             => 'ポートフォリオを編集',
        'new_item'              => '新規ポートフォリオ',
        'view_item'             => 'ポートフォリオを表示',
        'search_items'          => 'ポートフォリオを検索',
        'not_found'             => 'ポートフォリオが見つかりませんでした',
        'not_found_in_trash'    => 'ゴミ箱にポートフォリオはありません',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => false,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'portfolio-item'),
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-portfolio',
        'supports'              => array('title', 'editor', 'thumbnail'),
        'show_in_rest'          => true,
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'diyone_register_portfolio_post_type');

// ポートフォリオカテゴリー（タクソノミー）の登録
function diyone_register_portfolio_taxonomy() {
    $labels = array(
        'name'              => 'カテゴリー',
        'singular_name'     => 'カテゴリー',
        'search_items'      => 'カテゴリーを検索',
        'all_items'         => 'すべてのカテゴリー',
        'edit_item'         => 'カテゴリーを編集',
        'update_item'       => 'カテゴリーを更新',
        'add_new_item'      => '新規カテゴリーを追加',
        'new_item_name'     => '新規カテゴリー名',
        'menu_name'         => 'カテゴリー',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'portfolio-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('portfolio_category', array('portfolio'), $args);
}
add_action('init', 'diyone_register_portfolio_taxonomy');

// ポートフォリオタグ（タクソノミー）の登録
function diyone_register_portfolio_tags() {
    $labels = array(
        'name'              => 'タグ',
        'singular_name'     => 'タグ',
        'search_items'      => 'タグを検索',
        'all_items'         => 'すべてのタグ',
        'edit_item'         => 'タグを編集',
        'update_item'       => 'タグを更新',
        'add_new_item'      => '新規タグを追加',
        'new_item_name'     => '新規タグ名',
        'menu_name'         => 'タグ',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'portfolio-tag'),
        'show_in_rest'      => true,
    );

    register_taxonomy('portfolio_tag', array('portfolio'), $args);
}
add_action('init', 'diyone_register_portfolio_tags');

// カスタムフィールドの追加（メディアタイプと動画URL）
function diyone_add_portfolio_meta_boxes() {
    add_meta_box(
        'portfolio_media_info',
        'メディア情報',
        'diyone_portfolio_media_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'diyone_add_portfolio_meta_boxes');

// カスタムフィールドの表示
function diyone_portfolio_media_callback($post) {
    wp_nonce_field('diyone_portfolio_meta_nonce', 'portfolio_meta_nonce');
    
    $media_type = get_post_meta($post->ID, '_portfolio_media_type', true);
    $video_url = get_post_meta($post->ID, '_portfolio_video_url', true);
    $show_on_top = get_post_meta($post->ID, '_portfolio_show_on_top', true);
    ?>
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 10px; font-weight: bold;">メディアタイプ:</label>
        <select name="portfolio_media_type" id="portfolio_media_type" style="width: 100%; padding: 5px;">
            <option value="image" <?php selected($media_type, 'image'); ?>>画像</option>
            <option value="video" <?php selected($media_type, 'video'); ?>>動画（YouTube/Instagram/TikTok）</option>
        </select>
        <p style="margin-top: 5px; color: #666; font-size: 13px;">
            画像の場合: 右サイドバーの「アイキャッチ画像」から画像を設定してください<br>
            動画の場合: 下記に動画URLを入力してください
        </p>
    </div>
    
    <div id="video_url_field" style="margin-bottom: 20px; <?php echo ($media_type === 'video') ? '' : 'display:none;'; ?>">
        <label style="display: block; margin-bottom: 10px; font-weight: bold;">動画URL:</label>
        <input type="url" name="portfolio_video_url" id="portfolio_video_url" value="<?php echo esc_attr($video_url); ?>" style="width: 100%; padding: 8px;" placeholder="https://www.youtube.com/watch?v=...">
        <p style="margin-top: 5px; color: #666; font-size: 13px;">
            <strong>対応URL:</strong><br>
            • YouTube: https://www.youtube.com/watch?v=xxxxx<br>
            • YouTube Shorts: https://www.youtube.com/shorts/xxxxx<br>
            • TikTok: https://www.tiktok.com/@username/video/xxxxx<br>
            • Instagram: https://www.instagram.com/p/xxxxx/<br>
            <br>
            <strong style="color: #00B894;">✅ 直接再生可能:</strong> YouTube、YouTube Shorts<br>
            <strong style="color: #FF8C42;">🔗 外部リンク:</strong> Instagram、TikTok（APIの制限により）<br>
            <br>
            <strong>サムネイル設定について:</strong><br>
            Instagram/TikTokのサムネイルが表示されない場合は、<br>
            右サイドバーの「アイキャッチ画像」を手動で設定してください
        </p>
    </div>
    
    <div style="margin-bottom: 20px; padding: 15px; background: #f0f8ff; border-left: 4px solid #FFD700; border-radius: 5px;">
        <label style="display: flex; align-items: center; cursor: pointer;">
            <input type="checkbox" name="portfolio_show_on_top" id="portfolio_show_on_top" value="1" <?php checked($show_on_top, '1'); ?> style="margin-right: 10px; width: 18px; height: 18px;">
            <span style="font-weight: bold; font-size: 14px;">トップページに表示する</span>
        </label>
        <p style="margin: 10px 0 0 28px; color: #666; font-size: 13px;">
            チェックを入れると、トップページのポートフォリオセクションに表示されます<br>
            ※最大8件まで表示されます（新しい順）
        </p>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mediaTypeSelect = document.getElementById('portfolio_media_type');
        const videoUrlField = document.getElementById('video_url_field');
        
        mediaTypeSelect.addEventListener('change', function() {
            if (this.value === 'video') {
                videoUrlField.style.display = 'block';
            } else {
                videoUrlField.style.display = 'none';
            }
        });
    });
    </script>
    <?php
}

// カスタムフィールドの保存
function diyone_save_portfolio_meta($post_id) {
    if (!isset($_POST['portfolio_meta_nonce']) || !wp_verify_nonce($_POST['portfolio_meta_nonce'], 'diyone_portfolio_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['portfolio_media_type'])) {
        update_post_meta($post_id, '_portfolio_media_type', sanitize_text_field($_POST['portfolio_media_type']));
    }

    if (isset($_POST['portfolio_video_url'])) {
        update_post_meta($post_id, '_portfolio_video_url', esc_url_raw($_POST['portfolio_video_url']));
    }

    // トップページ表示チェックボックスの保存
    if (isset($_POST['portfolio_show_on_top'])) {
        update_post_meta($post_id, '_portfolio_show_on_top', '1');
    } else {
        delete_post_meta($post_id, '_portfolio_show_on_top');
    }
}
add_action('save_post_portfolio', 'diyone_save_portfolio_meta');

// 動画URLからサムネイルを取得する関数
function diyone_get_video_thumbnail($url) {
    if (empty($url)) {
        return '';
    }

    // YouTube（通常動画とショート動画）
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id) || 
        preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id) ||
        preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id) ||
        preg_match('/youtube\.com\/shorts\/([^\&\?\/]+)/', $url, $id)) {
        return 'https://img.youtube.com/vi/' . $id[1] . '/maxresdefault.jpg';
    }

    // Instagram - 手動でアイキャッチ画像を設定してもらう
    if (strpos($url, 'instagram.com') !== false) {
        return ''; // アイキャッチ画像を使用
    }

    // TikTok - oEmbedでサムネイル取得を試みる
    if (strpos($url, 'tiktok.com') !== false) {
        $oembed_url = 'https://www.tiktok.com/oembed?url=' . urlencode($url);
        $response = wp_remote_get($oembed_url, array('timeout' => 10));
        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $data = json_decode(wp_remote_retrieve_body($response), true);
            if (isset($data['thumbnail_url'])) {
                return $data['thumbnail_url'];
            }
        }
    }

    return '';
}

// 動画を埋め込むHTMLを取得する関数
function diyone_get_video_embed($url) {
    if (empty($url)) {
        return '';
    }

    // YouTube（通常動画とショート動画）
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id) || 
        preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id) ||
        preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id) ||
        preg_match('/youtube\.com\/shorts\/([^\&\?\/]+)/', $url, $id)) {
        return '<iframe width="100%" height="500" src="https://www.youtube.com/embed/' . $id[1] . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    }

    // Instagram
    if (strpos($url, 'instagram.com') !== false) {
        return '
        <div style="text-align: center; padding: 3rem 2rem;">
            <p style="color: #666; margin-bottom: 2rem; font-size: 1.1rem; line-height: 1.6;">
                Instagramの動画は、アプリまたはWebサイトで再生できます
            </p>
            <a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" style="display: inline-block; background: linear-gradient(135deg, #FFD700, #FFA500); color: white; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; font-weight: bold; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);">
                📱 Instagramで見る
            </a>
            <p style="color: #999; margin-top: 1.5rem; font-size: 0.9rem;">
                新しいタブで開きます
            </p>
        </div>';
    }

    // TikTok
    if (strpos($url, 'tiktok.com') !== false) {
        return '
        <div style="text-align: center; padding: 3rem 2rem;">
            <p style="color: #666; margin-bottom: 2rem; font-size: 1.1rem; line-height: 1.6;">
                TikTok動画は、アプリまたはWebサイトで再生できます
            </p>
            <a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" style="display: inline-block; background: linear-gradient(135deg, #FFD700, #FFA500); color: white; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; font-weight: bold; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);">
                🎵 TikTokで見る
            </a>
            <p style="color: #999; margin-top: 1.5rem; font-size: 0.9rem;">
                新しいタブで開きます
            </p>
        </div>';
    }

    return '<p style="color: #666; text-align: center; padding: 2rem;">サポートされていない動画URLです</p>';
}

// お問い合わせフォームの処理
function handle_contact_form_submission() {
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_die('セキュリティチェックに失敗しました。');
    }

    $name = sanitize_text_field($_POST['name']);
    $furigana = sanitize_text_field($_POST['furigana']);
    $company = sanitize_text_field($_POST['company']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);
    $privacy_agree = isset($_POST['privacy-agree']) ? 1 : 0;

    $errors = array();
    
    if (empty($name)) $errors[] = 'お名前は必須です。';
    if (empty($furigana)) $errors[] = 'ふりがなは必須です。';
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
    $admin_message .= "ふりがな: " . $furigana . "\n";
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
    $customer_message .= "ふりがな: " . $furigana . "\n";
    $customer_message .= "会社名: " . $company . "\n";
    $customer_message .= "メールアドレス: " . $email . "\n";
    $customer_message .= "電話番号: " . $phone . "\n";
    $customer_message .= "希望サービス: " . $service . "\n";
    $customer_message .= "お問い合わせ内容:\n" . $message . "\n\n";
    $customer_message .= "今後ともよろしくお願いいたします。\n\n";
    $customer_message .= "DIYONE\nメール: diyone001@gmail.com\n";

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

// AJAXハンドラー：動画埋め込みHTMLを取得
function diyone_ajax_get_video_embed() {
    $video_url = isset($_GET['video_url']) ? esc_url_raw($_GET['video_url']) : '';
    
    if (empty($video_url)) {
        echo '<p>動画URLが指定されていません</p>';
        wp_die();
    }
    
    echo diyone_get_video_embed($video_url);
    wp_die();
}
add_action('wp_ajax_get_video_embed', 'diyone_ajax_get_video_embed');
add_action('wp_ajax_nopriv_get_video_embed', 'diyone_ajax_get_video_embed');
?>