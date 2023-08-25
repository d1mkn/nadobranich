<?php
/*
Template name: Information Page Template
*/
get_header();
?>

<?php
do_action('woocommerce_before_main_content');
?>

</main>

<div class="animate__animated animate__faster modal-backdrop visually-hidden">
    <?php echo do_shortcode('[modalAuth_markup]') ?>
    <?php echo do_shortcode('[modal_markup]') ?>
</div>

<?php
get_footer();