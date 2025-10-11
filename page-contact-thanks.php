<?php
/**
 * Template Name: Contact Thanks Page
 * お問い合わせ完了ページ - DIYONE Corporate Website
 */
get_header(); ?>

<main id="primary" class="site-main contact-thanks-page">
    <section class="thank-you-hero">
        <div class="container">
            <div class="thank-you-content">
                <div class="thank-you-icon">
                    <div class="icon-circle">
                        <div class="checkmark">✓</div>
                    </div>
                </div>
                
                <h1 class="thank-you-title">
                    <span class="title-en">\ THANK YOU !! /</span>
                    <span class="title-jp">お問い合わせが完了いたしました</span>
                </h1>
                
                <div class="thank-you-message">
                    <p class="message-main">お問い合わせありがとうございました。</p>
                    <p>この度はお問い合わせフォームのご入力をお送りいただきありがとうございます。</p>
                    <p>後ほど、担当者よりご連絡をさせていただきます。</p>
                    <p class="message-highlight">今しばらくお待ちくださいますようよろしくお願い申し上げます。</p>
                </div>
                
                <div class="contact-info">
                    <p class="info-title">なお、しばらくたっても当社より返信、返答がない場合は、</p>
                    <p>お客様によりご入力いただいたメールアドレスに誤りがある場合がございます。</p>
                    <p class="contact-detail">その際は、お手数ですが再度お問い合わせフォームより送信いただくか、</p>
                    <p class="email-contact">直接メール（<a href="mailto:diyone001@gmail.com">diyone001@gmail.com</a>）までご連絡いただけますと幸いです。</p>
                </div>
                
                <div class="back-to-home">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="home-button">
                        TOPへ戻る
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>