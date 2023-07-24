<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$productId = $product->get_id();
$post_thumbnail_id = $product->get_image_id();
$mainImageId = get_post_thumbnail_id($productId);
$mainImageLink = wp_get_attachment_url(get_post_thumbnail_id($productId));
$mainImageAlt = get_post_meta($mainImageId, '_wp_attachment_image_alt', true);

$productImagesIds = $product->get_gallery_image_ids();
?>
<div class="item__body-left">

	<div class="item__images">
		<?php
		if ($post_thumbnail_id) { ?>
			<div class="swiper-container item__images-main-wrap js-single-gallery gallery-top">
				<div class="gallery-nav swiper-button-next"><svg width="15" height="30">
						<use href="<?php bloginfo(
							"template_url",
						); ?>/assets/images/icons.svg#gallery-arrow-next"></use>
					</svg></div>
				<div class="gallery-nav swiper-button-prev"><svg width="15" height="30">
						<use href="<?php bloginfo(
							"template_url",
						); ?>/assets/images/icons.svg#gallery-arrow-prev"></use>
					</svg>
				</div>

				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<a href="<?php echo $mainImageLink ?>"><img class="item__images-main"
								src="<?php echo $mainImageLink ?>" alt="<?php echo $mainImageAlt ?>"></a>
					</div>

					<?php foreach ($productImagesIds as $image_id) {
						$image_url = wp_get_attachment_url($image_id);
						$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true); ?>
						<div class="swiper-slide"><a href="<?php echo $image_url ?>"><img class="item__images-main"
									src="<?php echo $image_url ?>" alt="<?php echo $image_alt ?>"></a></div>
					<?php } ?>
				</div>
			</div>
		<?php } else {
			echo '<div class="item__images-main">';
			echo sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
			echo '</div>';
		} ?>

		<ul class="item__images-list swiper-container gallery-thumbs">
			<div class="swiper-wrapper">
				<?php do_action('woocommerce_product_thumbnails');
				?>
			</div>
		</ul>
	</div>
</div>