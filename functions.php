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
    // 共通CSS/JS（全ページで読み込み）
    wp_enqueue_style('diyone-style', get_stylesheet_uri(), array(), '1.0.1');
    wp_enqueue_script('diyone-script', get_template_directory_uri() . '/js/script.js', array(), '1.0.1', true);
    
    // トップページ：スライダー
    if (is_front_page() || is_home()) {
        wp_enqueue_script('diyone-slider', get_template_directory_uri() . '/js/slider.js', array(), '1.0.0', true);
    }
    
    // ポートフォリオページ専用
    if (is_page_template('page-portfolio.php')) {
        wp_enqueue_style('portfolio-style', get_template_directory_uri() . '/css/portfolio.css', array('diyone-style'), '1.0.0');
        wp_enqueue_script('portfolio-script', get_template_directory_uri() . '/js/portfolio.js', array('diyone-script'), '1.0.0', true);
        
        // AJAX用のURLを渡す
        wp_localize_script('portfolio-script', 'portfolioData', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }
    
    // お問い合わせサンクスページ専用
    if (is_page_template('page-contact-thanks.php')) {
        wp_enqueue_style('thanks-style', get_template_directory_uri() . '/css/contact-thanks.css', array('diyone-style'), '1.0.0');
    }
    
    // プライバシーポリシーページ専用
    if (is_page_template('page-privacy.php')) {
        wp_enqueue_style('privacy-style', get_template_directory_uri() . '/css/privacy.css', array('diyone-style'), '1.0.0');
    }
    
    // メディアアップローダー用スクリプト（管理画面のみ）
    if (is_admin()) {
        wp_enqueue_media();
    }
}
add_action('wp_enqueue_scripts', 'diyone_enqueue_scripts');
add_action('admin_enqueue_scripts', 'diyone_enqueue_scripts');

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

// お客様の声カスタム投稿タイプの登録
function diyone_register_testimonial_post_type() {
    $labels = array(
        'name'                  => 'お客様の声',
        'singular_name'         => 'お客様の声',
        'menu_name'             => 'お客様の声',
        'add_new'               => '新規追加',
        'add_new_item'          => '新規お客様の声を追加',
        'edit_item'             => 'お客様の声を編集',
        'new_item'              => '新規お客様の声',
        'view_item'             => 'お客様の声を表示',
        'search_items'          => 'お客様の声を検索',
        'not_found'             => 'お客様の声が見つかりませんでした',
        'not_found_in_trash'    => 'ゴミ箱にお客様の声はありません',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => false,
        'has_archive'           => false,
        'publicly_queryable'    => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => false,
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-testimonial',
        'supports'              => array('title', 'editor'),
        'show_in_rest'          => true,
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'diyone_register_testimonial_post_type');

// お客様の声のカスタムフィールド
function diyone_add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_info',
        'お客様情報',
        'diyone_testimonial_info_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'diyone_add_testimonial_meta_boxes');

// お客様の声カスタムフィールドの表示
function diyone_testimonial_info_callback($post) {
    wp_nonce_field('diyone_testimonial_meta_nonce', 'testimonial_meta_nonce');
    
    $customer_name = get_post_meta($post->ID, '_testimonial_customer_name', true);
    $company = get_post_meta($post->ID, '_testimonial_company', true);
    $service_tag = get_post_meta($post->ID, '_testimonial_service_tag', true);
    $show_on_top = get_post_meta($post->ID, '_testimonial_show_on_top', true);
    $display_order = get_post_meta($post->ID, '_testimonial_display_order', true);
    $profile_image_id = get_post_meta($post->ID, '_testimonial_profile_image', true);
    $profile_image_url = $profile_image_id ? wp_get_attachment_image_url($profile_image_id, 'thumbnail') : '';
    ?>
    <p style="margin-bottom: 20px; color: #666; font-size: 13px;">
        <strong>使い方:</strong><br>
        ・タイトル欄に「田中様」「佐藤様」などお客様名を入力<br>
        ・本文にお客様の声（コメント）を入力<br>
        ・下記の項目を入力して、「トップページに表示する」にチェックを入れてください
    </p>
    
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 10px; font-weight: bold;">プロフィール画像:</label>
        <div id="profile_image_preview" style="margin-bottom: 10px;">
            <?php if ($profile_image_url) : ?>
                <img src="<?php echo esc_url($profile_image_url); ?>" style="max-width: 150px; height: auto; border-radius: 50%; border: 3px solid #FFD700;">
            <?php else : ?>
                <div style="width: 150px; height: 150px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 3rem;">
                    <?php echo esc_html($customer_name ? substr($customer_name, 0, 1) : '?'); ?>
                </div>
            <?php endif; ?>
        </div>
        <input type="hidden" name="testimonial_profile_image" id="testimonial_profile_image" value="<?php echo esc_attr($profile_image_id); ?>">
        <button type="button" id="upload_profile_image" class="button">画像を選択</button>
        <button type="button" id="remove_profile_image" class="button" style="<?php echo $profile_image_url ? '' : 'display:none;'; ?>">画像を削除</button>
        <p style="margin-top: 5px; color: #666; font-size: 13px;">
            プロフィール画像をアップロードしない場合、下記の「お客様名（アイコン用）」の文字が円形アイコンとして表示されます
        </p>
    </div>
    
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 10px; font-weight: bold;">お客様名（アイコン用）:</label>
        <input type="text" name="testimonial_customer_name" id="testimonial_customer_name" value="<?php echo esc_attr($customer_name); ?>" style="width: 100%; padding: 8px;" placeholder="例: 田中様" maxlength="2">
        <p style="margin-top: 5px; color: #666; font-size: 13px;">
            プロフィール画像がない場合、アイコンの中央に表示される文字を入力（1〜2文字推奨: A, B, 田, 佐藤 など）
        </p>
    </div>
    
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 10px; font-weight: bold;">会社名・業種:</label>
        <input type="text" name="testimonial_company" value="<?php echo esc_attr($company); ?>" style="width: 100%; padding: 8px;" placeholder="例: 製造業">
        <p style="margin-top: 5px; color: #666; font-size: 13px;">お客様の業種や会社名を入力</p>
    </div>
    
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 10px; font-weight: bold;">サービスタグ:</label>
        <input type="text" name="testimonial_service_tag" value="<?php echo esc_attr($service_tag); ?>" style="width: 100%; padding: 8px;" placeholder="例: 映像制作">
        <p style="margin-top: 5px; color: #666; font-size: 13px;">ご利用いただいたサービス名を入力（映像制作、Web制作、SNS運用代行 など）</p>
    </div>
    
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 10px; font-weight: bold;">表示順序:</label>
        <input type="number" name="testimonial_display_order" value="<?php echo esc_attr($display_order ? $display_order : 0); ?>" style="width: 100px; padding: 8px;" min="0">
        <p style="margin-top: 5px; color: #666; font-size: 13px;">小さい数字ほど先に表示されます（0が最初）</p>
    </div>
    
    <div style="margin-bottom: 20px; padding: 15px; background: #f0f8ff; border-left: 4px solid #FFD700; border-radius: 5px;">
        <label style="display: flex; align-items: center; cursor: pointer;">
            <input type="checkbox" name="testimonial_show_on_top" value="1" <?php checked($show_on_top, '1'); ?> style="margin-right: 10px; width: 18px; height: 18px;">
            <span style="font-weight: bold; font-size: 14px;">トップページに表示する</span>
        </label>
        <p style="margin: 10px 0 0 28px; color: #666; font-size: 13px;">
            チェックを入れると、トップページのお客様の声セクションに表示されます<br>
            ※最大5件まで表示されます（表示順序の小さい順）
        </p>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        var profileFrame;
        
        // プロフィール画像アップロード
        $('#upload_profile_image').on('click', function(e) {
            e.preventDefault();
            
            if (profileFrame) {
                profileFrame.open();
                return;
            }
            
            profileFrame = wp.media({
                title: 'プロフィール画像を選択',
                button: {
                    text: '画像を使用'
                },
                multiple: false
            });
            
            profileFrame.on('select', function() {
                var attachment = profileFrame.state().get('selection').first().toJSON();
                $('#testimonial_profile_image').val(attachment.id);
                $('#profile_image_preview').html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto; border-radius: 50%; border: 3px solid #FFD700;">');
                $('#remove_profile_image').show();
            });
            
            profileFrame.open();
        });
        
        // プロフィール画像削除
        $('#remove_profile_image').on('click', function(e) {
            e.preventDefault();
            $('#testimonial_profile_image').val('');
            var customerName = $('#testimonial_customer_name').val();
            var initial = customerName ? customerName.charAt(0) : '?';
            $('#profile_image_preview').html('<div style="width: 150px; height: 150px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 3rem;">' + initial + '</div>');
            $(this).hide();
        });
        
        // お客様名が変更されたらプレビューも更新
        $('#testimonial_customer_name').on('input', function() {
            if (!$('#testimonial_profile_image').val()) {
                var initial = $(this).val() ? $(this).val().charAt(0) : '?';
                $('#profile_image_preview').html('<div style="width: 150px; height: 150px; background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 3rem;">' + initial + '</div>');
            }
        });
    });
    </script>
    <?php
}

// お客様の声カスタムフィールドの保存
function diyone_save_testimonial_meta($post_id) {
    if (!isset($_POST['testimonial_meta_nonce']) || !wp_verify_nonce($_POST['testimonial_meta_nonce'], 'diyone_testimonial_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['testimonial_profile_image'])) {
        $image_id = intval($_POST['testimonial_profile_image']);
        if ($image_id > 0) {
            update_post_meta($post_id, '_testimonial_profile_image', $image_id);
        } else {
            delete_post_meta($post_id, '_testimonial_profile_image');
        }
    }

    if (isset($_POST['testimonial_customer_name'])) {
        update_post_meta($post_id, '_testimonial_customer_name', sanitize_text_field($_POST['testimonial_customer_name']));
    }

    if (isset($_POST['testimonial_company'])) {
        update_post_meta($post_id, '_testimonial_company', sanitize_text_field($_POST['testimonial_company']));
    }

    if (isset($_POST['testimonial_service_tag'])) {
        update_post_meta($post_id, '_testimonial_service_tag', sanitize_text_field($_POST['testimonial_service_tag']));
    }

    if (isset($_POST['testimonial_display_order'])) {
        update_post_meta($post_id, '_testimonial_display_order', intval($_POST['testimonial_display_order']));
    }

    if (isset($_POST['testimonial_show_on_top'])) {
        update_post_meta($post_id, '_testimonial_show_on_top', '1');
    } else {
        delete_post_meta($post_id, '_testimonial_show_on_top');
    }
}
add_action('save_post_testimonial', 'diyone_save_testimonial_meta');

// カスタムフィールドの追加（メディアタイプと動画URL、複数画像）
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
    $gallery_images = get_post_meta($post->ID, '_portfolio_gallery_images', true);
    
    if (!is_array($gallery_images)) {
        $gallery_images = array();
    }
    ?>
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 10px; font-weight: bold;">メディアタイプ:</label>
        <select name="portfolio_media_type" id="portfolio_media_type" style="width: 100%; padding: 5px;">
            <option value="image" <?php selected($media_type, 'image'); ?>>画像</option>
            <option value="video" <?php selected($media_type, 'video'); ?>>動画（YouTube/Instagram/TikTok）</option>
        </select>
        <p style="margin-top: 5px; color: #666; font-size: 13px;">
            画像の場合: 右サイドバーの「アイキャッチ画像」が1枚目のサムネイルになります。複数画像は下記で追加できます<br>
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
    
    <!-- 複数画像アップロード -->
    <div id="gallery_images_field" style="margin-bottom: 20px; <?php echo ($media_type === 'image') ? '' : 'display:none;'; ?>">
        <label style="display: block; margin-bottom: 10px; font-weight: bold; font-size: 14px; color: #0073aa;">📸 ギャラリー画像（2枚目以降）:</label>
        <div style="background: #f0f8ff; padding: 15px; border-radius: 8px; border: 2px dashed #0073aa; margin-bottom: 15px;">
            <p style="margin: 0 0 10px 0; color: #666; font-size: 13px; line-height: 1.6;">
                <strong>🎯 使い方：</strong><br>
                <strong style="color: #00B894;">1枚目：</strong> 右サイドバーの「アイキャッチ画像」を設定 → サムネイルになります<br>
                <strong style="color: #0073aa;">2枚目以降：</strong> ここで追加した画像がスライドショーで表示されます<br>
                <br>
                <strong>💡 例：</strong> Web制作の場合、トップページ・下層ページ・スマホ表示などを追加
            </p>
        </div>
        
        <div id="gallery_images_container" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px; padding: 10px; background: #fafafa; border-radius: 5px; min-height: 120px;">
            <?php if (!empty($gallery_images)) : ?>
                <?php foreach ($gallery_images as $image_id) : ?>
                    <?php $image_url = wp_get_attachment_image_url($image_id, 'thumbnail'); ?>
                    <?php if ($image_url) : ?>
                        <div class="gallery-image-item" style="position: relative; width: 100px; height: 100px; border: 2px solid #0073aa; border-radius: 8px; overflow: hidden;">
                            <img src="<?php echo esc_url($image_url); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <button type="button" class="remove-gallery-image" data-image-id="<?php echo esc_attr($image_id); ?>" style="position: absolute; top: -5px; right: -5px; background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 14px; line-height: 1; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">×</button>
                            <input type="hidden" name="portfolio_gallery_images[]" value="<?php echo esc_attr($image_id); ?>">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <div style="width: 100%; text-align: center; padding: 30px; color: #999;">
                    <p style="margin: 0; font-size: 14px;">📷 まだ画像が追加されていません</p>
                    <p style="margin: 5px 0 0 0; font-size: 12px;">下のボタンから画像を追加してください</p>
                </div>
            <?php endif; ?>
        </div>
        
        <button type="button" id="add_gallery_images" class="button button-primary button-large" style="width: 100%; padding: 10px; font-size: 14px; font-weight: bold;">
            ➕ 画像を追加（複数選択可能）
        </button>
        <p style="margin-top: 10px; color: #666; font-size: 12px; text-align: center;">
            ※ 画像は複数選択できます。ドラッグ&ドロップで並び替えも可能です
        </p>
    </div>
    
    <div style="margin-bottom: 20px; padding: 15px; background: #fffbea; border-left: 4px solid #FFD700; border-radius: 5px;">
        <label style="display: flex; align-items: center; cursor: pointer;">
            <input type="checkbox" name="portfolio_show_on_top" id="portfolio_show_on_top" value="1" <?php checked($show_on_top, '1'); ?> style="margin-right: 10px; width: 18px; height: 18px;">
            <span style="font-weight: bold; font-size: 14px;">⭐ トップページに表示する</span>
        </label>
        <p style="margin: 10px 0 0 28px; color: #666; font-size: 13px;">
            チェックを入れると、トップページのポートフォリオセクションに表示されます<br>
            ※最大8件まで表示されます（新しい順）
        </p>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // メディアタイプ切り替え
        $('#portfolio_media_type').on('change', function() {
            if ($(this).val() === 'video') {
                $('#video_url_field').slideDown(300);
                $('#gallery_images_field').slideUp(300);
            } else {
                $('#video_url_field').slideUp(300);
                $('#gallery_images_field').slideDown(300);
            }
        });
        
        // ギャラリー画像追加
        var galleryFrame;
        $('#add_gallery_images').on('click', function(e) {
            e.preventDefault();
            
            if (galleryFrame) {
                galleryFrame.open();
                return;
            }
            
            galleryFrame = wp.media({
                title: '📸 ギャラリー画像を選択',
                button: {
                    text: '画像を追加'
                },
                multiple: true,
                library: {
                    type: 'image'
                }
            });
            
            galleryFrame.on('select', function() {
                var attachments = galleryFrame.state().get('selection').toJSON();
                var container = $('#gallery_images_container');
                
                // 「まだ画像が追加されていません」メッセージを削除
                container.find('div[style*="text-align: center"]').remove();
                
                attachments.forEach(function(attachment) {
                    var imageHtml = '<div class="gallery-image-item" style="position: relative; width: 100px; height: 100px; border: 2px solid #0073aa; border-radius: 8px; overflow: hidden;">' +
                        '<img src="' + attachment.sizes.thumbnail.url + '" style="width: 100%; height: 100%; object-fit: cover;">' +
                        '<button type="button" class="remove-gallery-image" data-image-id="' + attachment.id + '" style="position: absolute; top: -5px; right: -5px; background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 14px; line-height: 1; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">×</button>' +
                        '<input type="hidden" name="portfolio_gallery_images[]" value="' + attachment.id + '">' +
                        '</div>';
                    container.append(imageHtml);
                });
                
                // 成功メッセージ
                showNotification('✅ 画像を追加しました！', 'success');
            });
            
            galleryFrame.open();
        });
        
        // ギャラリー画像削除
        $(document).on('click', '.remove-gallery-image', function() {
            var $item = $(this).closest('.gallery-image-item');
            $item.fadeOut(300, function() {
                $(this).remove();
                
                // 画像がなくなった場合、メッセージを表示
                var container = $('#gallery_images_container');
                if (container.find('.gallery-image-item').length === 0) {
                    container.html('<div style="width: 100%; text-align: center; padding: 30px; color: #999;"><p style="margin: 0; font-size: 14px;">📷 まだ画像が追加されていません</p><p style="margin: 5px 0 0 0; font-size: 12px;">下のボタンから画像を追加してください</p></div>');
                }
            });
            
            showNotification('🗑️ 画像を削除しました', 'info');
        });
        
        // 通知表示関数
        function showNotification(message, type) {
            var bgColor = type === 'success' ? '#00B894' : '#0073aa';
            var $notification = $('<div style="position: fixed; top: 32px; right: 20px; background: ' + bgColor + '; color: white; padding: 15px 20px; border-radius: 5px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); z-index: 999999; font-weight: bold;">' + message + '</div>');
            $('body').append($notification);
            setTimeout(function() {
                $notification.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 2000);
        }
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

    // ギャラリー画像の保存
    if (isset($_POST['portfolio_gallery_images']) && is_array($_POST['portfolio_gallery_images'])) {
        $gallery_images = array_map('intval', $_POST['portfolio_gallery_images']);
        update_post_meta($post_id, '_portfolio_gallery_images', $gallery_images);
    } else {
        delete_post_meta($post_id, '_portfolio_gallery_images');
    }

    // トップページ表示チェックボックスの保存
    if (isset($_POST['portfolio_show_on_top'])) {
        update_post_meta($post_id, '_portfolio_show_on_top', '1');
    } else {
        delete_post_meta($post_id, '_portfolio_show_on_top');
    }
}
add_action('save_post_portfolio', 'diyone_save_portfolio_meta');

// ポートフォリオのギャラリー画像を取得する関数
function diyone_get_portfolio_gallery_images($post_id) {
    $gallery_images = get_post_meta($post_id, '_portfolio_gallery_images', true);
    
    if (!is_array($gallery_images)) {
        $gallery_images = array();
    }
    
    $images = array();
    
    // アイキャッチ画像を1枚目として追加
    if (has_post_thumbnail($post_id)) {
        $thumbnail_id = get_post_thumbnail_id($post_id);
        $thumbnail_url = get_the_post_thumbnail_url($post_id, 'large');
        $full_url = get_the_post_thumbnail_url($post_id, 'full');
        
        if ($thumbnail_url && $full_url) {
            $images[] = array(
                'id' => $thumbnail_id,
                'url' => $thumbnail_url,
                'full_url' => $full_url
            );
        }
    }
    
    // ギャラリー画像を追加（2枚目以降）
    if (!empty($gallery_images)) {
        foreach ($gallery_images as $image_id) {
            $image_id = intval($image_id);
            if ($image_id > 0) {
                $image_url = wp_get_attachment_image_url($image_id, 'large');
                $full_url = wp_get_attachment_image_url($image_id, 'full');
                
                if ($image_url && $full_url) {
                    $images[] = array(
                        'id' => $image_id,
                        'url' => $image_url,
                        'full_url' => $full_url
                    );
                }
            }
        }
    }
    
    return $images;
}

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