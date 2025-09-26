<?php
/**
 * Page Template: Contact Thanks
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
                    <p class="contact-detail">その際は、お手数ですが再度送信いただくか、</p>
                    <p class="phone-contact">お電話（<a href="tel:090-3265-2422">090-3265-2422</a>）までご連絡いただけますと幸いです。</p>
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

<style>
/* お問い合わせ完了ページ専用CSS */
.contact-thanks-page {
    margin-top: 100px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f1f3f4 100%);
    min-height: 80vh;
}

.thank-you-hero {
    padding: 5rem 0 4rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.thank-you-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 30% 70%, rgba(255, 215, 0, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 70% 30%, rgba(255, 165, 0, 0.05) 0%, transparent 50%);
    animation: float 10s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.7; }
}

.thank-you-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    background: rgba(255, 255, 255, 0.95);
    padding: 4rem 3rem;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

.thank-you-icon {
    margin-bottom: 2rem;
}

.icon-circle {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border-radius: 50%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: bounce 2s ease-in-out;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

.checkmark {
    color: white;
    font-size: 2.5rem;
    font-weight: bold;
}

.thank-you-title {
    margin-bottom: 2rem;
}

.title-en {
    display: block;
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
    letter-spacing: 3px;
}

.title-jp {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    line-height: 1.3;
}

.thank-you-message {
    margin-bottom: 3rem;
    line-height: 1.8;
}

.message-main {
    font-size: 1.3rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 1.5rem;
}

.thank-you-message p {
    color: #555;
    margin-bottom: 0.8rem;
    font-size: 1rem;
}

.message-highlight {
    font-weight: 600 !important;
    color: #333 !important;
}

.contact-info {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 3rem;
    border: 2px solid rgba(255, 215, 0, 0.2);
}

.info-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.8rem;
}

.contact-info p {
    margin-bottom: 0.8rem;
    color: #555;
    line-height: 1.6;
}

.phone-contact {
    font-weight: 600;
}

.phone-contact a {
    color: #FFD700;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.phone-contact a:hover {
    color: #FFA500;
    text-decoration: underline;
}

.back-to-home {
    margin-top: 2rem;
}

.home-button {
    display: inline-block;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: white;
    padding: 1rem 3rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
}

.home-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(255, 215, 0, 0.4);
    color: white;
}

/* レスポンシブデザイン */
@media (max-width: 768px) {
    .thank-you-content {
        padding: 3rem 2rem;
        margin: 0 1rem;
    }
    
    .title-en {
        font-size: 2rem;
        letter-spacing: 2px;
    }
    
    .title-jp {
        font-size: 1.6rem;
    }
    
    .message-main {
        font-size: 1.2rem;
    }
    
    .contact-info {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .thank-you-hero {
        padding: 3rem 0 2rem;
    }
    
    .thank-you-content {
        padding: 2rem 1.5rem;
    }
    
    .title-en {
        font-size: 1.8rem;
    }
    
    .title-jp {
        font-size: 1.4rem;
    }
    
    .icon-circle {
        width: 60px;
        height: 60px;
    }
    
    .checkmark {
        font-size: 2rem;
    }
}
</style>

<?php get_footer(); ?>