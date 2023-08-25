<?php
/*
Template name: Fabrics Page Template
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
                    <h2 class="faq__question-title">Сатин</h2>
                    <div class="faq__question-icon">
                        <svg width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="faq__answer visually-hidden">
                    <?php the_field("satin_info") ?>
                </div>
            </div>
            <div class="faq__item">
                <div class="faq__question">
                    <h2 class="faq__question-title">Ранфорс</h2>
                    <div class="faq__question-icon">
                        <svg width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="faq__answer visually-hidden">
                    <?php the_field("ranfors_info") ?>
                </div>
            </div>
            <div class="faq__item">
                <div class="faq__question">
                    <h2 class="faq__question-title">Котон</h2>
                    <div class="faq__question-icon">
                        <svg width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="faq__answer visually-hidden">
                    <?php the_field("cotton_info") ?>
                </div>
            </div>
            <div class="faq__item">
                <div class="faq__question">
                    <h2 class="faq__question-title">Муслін</h2>
                    <div class="faq__question-icon">
                        <svg width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="faq__answer visually-hidden">
                    <?php the_field("muslin_info") ?>
                </div>
            </div>
            <div class="faq__item">
                <div class="faq__question">
                    <h2 class="faq__question-title">Махрові та бавовняні рушники</h2>
                    <div class="faq__question-icon">
                        <svg width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="faq__answer visually-hidden">
                    <?php the_field("terry_and_cotton_towels_info") ?>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<div class="animate__animated animate__faster modal-backdrop visually-hidden">
    <?php echo do_shortcode('[modalAuth_markup]') ?>
    <?php echo do_shortcode('[modal_markup]') ?>
</div>

<?php echo do_shortcode('[insta_block]') ?>

<?php
get_footer();