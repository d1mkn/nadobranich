<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header();
?>
<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>
<div class="container">
	<div class="category-page__text">
		<?php if (apply_filters('woocommerce_show_page_title', true)): ?>
			<h1 class="category-page__title">
				<?php woocommerce_page_title(); ?>
			</h1>
		<?php endif; ?>

		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action('woocommerce_archive_description');
		?>
	</div>

	<div class="category-page__filter-wrap">
		<div class="category-page__filter">
			<h2 class="category-page__filter-title">Фільтр:</h2>

			<?php
			echo do_shortcode('[fe_widget]');
			if (woocommerce_product_loop()) {

				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				echo '</div>';
				echo '<div class="category-page__sort">';
				echo '<h2 class="category-page__filter-title">Сортувати:</h2>';
				do_action('woocommerce_before_shop_loop');
				echo '</div>';
				echo do_shortcode('[fe_chips]');
				echo '</div>';
				woocommerce_product_loop_start();

				if (wc_get_loop_prop('total')) {
					while (have_posts()) {
						the_post();

						global $product;

						// Дані для ренедру та мобального вікна
						$is_on_sale = $product->is_on_sale();
						$attributes = $product->get_attributes();
						$productId = $product->get_id();
						$productTitle = get_the_title();
						$productPrice = $product->price;
						$productBeforeSalePrice = $product->regular_price;
						$productDesc = $product->description;
						$productShortDesc = $product->get_short_description();
						$productImagesIds = $product->get_gallery_image_ids();
						$mainImageId = get_post_thumbnail_id($productId);
						$mainImageAlt = get_post_meta($mainImageId, '_wp_attachment_image_alt', true);
						$productImages = array(
							'mainImg' => array(
								'url' => wp_get_attachment_url(get_post_thumbnail_id($productId)),
								'alt' => $mainImageAlt
							),
							'gallery' => [],
						);
						$productAttributes = array();
						$productRating = array(
							'average' => $product->average_rating,
							'reviewCount' => $product->review_count
						);

						//Атрибути
						foreach ($attributes as $attribute) {
							$attributeName = $attribute->get_name();
							$options = $attribute->get_options();

							if ($attributeName === 'pa_color') {
								$options = get_the_terms($product->id, 'pa_color');
							}

							if ($attributeName === 'pa_size') {
								$options = get_the_terms($product->id, 'pa_size');
							}

							$productAttributes[] = array(
								$attributeName => $options
							);
						}

						// Варіації Колір/Розмір + ціна
						$productVariations = get_children(
							array(
								'post_parent' => $productId,
								'post_type' => 'product_variation',
							)
						);

						$variations = array();

						foreach ($productVariations as $variation) {
							$variationDesc = $variation->post_excerpt;
							$variationId = $variation->ID;
							$variation = wc_get_product($variationId);
							$variationPrice = $variation->get_price();

							$variations[] = array(
								'variationId' => $variationId,
								'variationDesc' => $variationDesc,
								'variationPrice' => $variationPrice,
							);
						}

						// Посилання на зображення
						foreach ($productImagesIds as $image_id) {
							$image_url = wp_get_attachment_url($image_id);
							$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

							$productImages['gallery'][] = array(
								'url' => $image_url,
								'alt' => $image_alt
							);
						}

						$_SESSION['aboutProducts'][] = array(
							'id' => $productId,
							'productTitle' => $productTitle,
							'productDesc' => $productShortDesc,
							'productLink' => get_permalink(),
							'productImages' => $productImages,
							'price' => $productPrice,
							'beforeSalePrice' => $productBeforeSalePrice,
							'attributes' => $productAttributes,
							'variations' => $variations,
							'rating' => $productRating
						);
						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action('woocommerce_shop_loop');

						wc_get_template_part('content', 'product');
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action('woocommerce_after_shop_loop');
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action('woocommerce_no_products_found');
			} ?>

		</div>

		<?php
		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		?>

		<?php
		do_action('woocommerce_after_main_content');
		echo do_shortcode('[modal_markup]');
		echo do_shortcode('[insta_block]');

		get_footer();