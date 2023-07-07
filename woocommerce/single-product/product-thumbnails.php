<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$productImagesIds = $product->get_gallery_image_ids();

if ($product->get_image_id()) { ?>
	<?php foreach ($productImagesIds as $image_id) {
		$image_url = wp_get_attachment_url($image_id);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true); ?>
		<li class="item__images-item js-single-gallery"><a href="<?php echo $image_url ?>"><img src="<?php echo $image_url ?>"
					alt="<?php echo $image_alt ?>"></a></li>
	<?php }
}