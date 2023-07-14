<?php
/*
Template name: Cart Template
*/
get_header();
?>

<?php
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    do_action('woocommerce_before_main_content');
}
?>
<main>
    <div class="container">
        <div class="cart-title__wrap">
            <h1 class="cart-title">
                <?php the_title() ?>
            </h1>
            <a class="cart-title__link" href="<?php echo site_url() ?>">Продовжити покупки</a>
        </div>
    </div>

    <?php
    while (have_posts()):
        the_post();

        the_content();


    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();