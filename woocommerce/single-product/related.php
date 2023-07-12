<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if ($related_products): ?>

	<section class="related products container single-category swiper-container">

		<?php
		$heading = apply_filters('woocommerce_product_related_products_heading', __('Це може вам сподобатись', 'woocommerce'));

		if ($heading):
			?>
			<div class="single-category__title-wrap">
				<h3 class="single-category__title">
					<?php echo esc_html($heading); ?>
				</h3>
				<div class="single-category__navigation">
					<div class="swiper-button-next"> <svg class="single-category__navigation-icon-next" width="30" height="30">
							<use href="<?php bloginfo(
								"template_url",
							); ?>/assets/images/icons.svg#arrowR-s"></use>
						</svg> </div>
					<div class="swiper-button-prev" style="opacity: 0.5;"> <svg
							class="single-category__navigation-icon-prev" width="30" height="30">
							<use href="<?php bloginfo(
								"template_url",
							); ?>/assets/images/icons.svg#arrowL-s"></use>
						</svg> </div>
				</div>
			</div>

		<?php endif; ?>

		<?php woocommerce_product_loop_start(); ?>

		<?php foreach ($related_products as $related_product): ?>

			<?php
			$post_object = get_post($related_product->get_id());

			setup_postdata($GLOBALS['post'] =& $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
	
			wc_get_template_part('content', 'product');
			?>

		<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;

wp_reset_postdata();