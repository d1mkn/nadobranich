<?php
/*
Template name: Information Page Template
*/
get_header();
?>

<?php
do_action('woocommerce_before_main_content');
?>

<section class="faq__section">
    <div class="container">
        <h1 class="faq__section-title">
            <?php the_title() ?>
        </h1>
        <div class="faq__items-wrap">
            <div class="faq__item">
                <div class="faq__question">
                    <h2 class="faq__question-title">Доставка та оплата</h2>
                    <div class="faq__question-icon">
                        <svg width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="faq__answer visually-hidden">
                    <?php the_field("delivery_info") ?>
                </div>
            </div>
            <div class="faq__item">
                <div class="faq__question">
                    <h2 class="faq__question-title">Повернення та обмін товару</h2>
                    <div class="faq__question-icon">
                        <svg width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="faq__answer visually-hidden">
                    <?php the_field("purchase_returns_info") ?>
                </div>
            </div>
            <div class="faq__item">
                <div class="faq__question">
                    <h2 class="faq__question-title">Догляд</h2>
                    <div class="faq__question-icon">
                        <svg width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="faq__answer visually-hidden">
                    <?php the_field("care_info") ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-store">
    <div class="container">
        <h3 class="about-store__title">Про магазин</h3>
        <p class="about-store__desc">
            <?php the_field('about_store_info') ?>
        </p>
    </div>
</section>
<section class="contacts">
    <div class="container">
        <h3 class="contacts__title">Контакти</h3>
        <div class="contacts__content">
            <div class="contacts__img">
                <?php 
                $image = get_field('faq_image')
                ?>
                <img src="<?php echo $image["url"]?>" alt="<?php echo $image["alt"] ?>">
            </div>
            <div class="contacts__info">
                <h4 class="contacts__location">
                    <?php the_field('address') ?>
                </h4>
                <ul class="contacts__info-list">
                    <?php the_field('contacts') ?>
                </ul>
            </div>
        </div>
    </div>
</section>
</main>

<div class="animate__animated animate__faster modal-backdrop visually-hidden">
    <?php echo do_shortcode('[modalAuth_markup]') ?>
    <?php echo do_shortcode('[modal_markup]') ?>
</div>

<?php
get_footer();