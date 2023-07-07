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

<div class="animate__animated js-to-cart-modal to-cart__wrap visually-hidden">
	<div class="to-cart__content">
		<button class="js-to-cart-close-btn to-cart__close-btn">
			<svg width="15" height="15">
				<use href="<?php bloginfo(
					"template_url",
				); ?>/assets/images/icons.svg#close"></use>
			</svg>
		</button>
		<h6 class="to-cart__content-title">Товар додано до кошика!</h6>
		<div class="to-cart__added-goods">
			<img class="to-cart__added-goods-img js-to-cart-modal-img" width="100" height="95" src="#" alt="" />
			<div class="to-cart__added-goods-text">
				<p class="to-cart__added-goods-title js-to-cart-modal-title">*</p>
				<p class="js-to-cart-modal-variation">* / *</p>
				<p class="js-to-cart-modal-qty">Кількість: * шт.</p>
			</div>
		</div>
		<div class="to-cart__nav">
			<a class="to-cart__nav-link" href="<?php echo wc_get_checkout_url() ?>">Купити</a>
			<a class="to-cart__nav-link" href="<?php echo wc_get_cart_url() ?>">Кошик</a>
		</div>
	</div>
</div>

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


		<script>
			const aboutProducts = <?php echo json_encode($_SESSION['aboutProducts']); ?>;
			localStorage.setItem('aboutProducts', JSON.stringify(aboutProducts));
		</script>



		<?php
		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		?>
		<div class="animate__animated animate__faster modal-backdrop visually-hidden">
			<div class="modal">
				<div class="modal__dialog">
					<div class="modal__content">
						<button class="modal__dialog-close" type="button">
							<svg class="modal__dialog-close-icon" width="15" height="15">
								<use href="<?php bloginfo(
									"template_url",
								); ?>/assets/images/icons.svg#close"></use>
							</svg>
						</button>
						<div class="modal__body">
							<div class="modal__images">
								<div class="modal__images-main-wrap">
								</div>
								<div class="modal__images-list-wrap">
									<ul class="modal__images-list js-modal-gallery">
										<li class="modal__images-item"><a href="#"><img src="#" alt="#"></a></li>
									</ul>
								</div>
							</div>
							<div class="modal__body-desc">
								<div class="modal__body-header">
									<h5 class="modal__body-title"> </h5>
									<p class="modal__body-composition"> </p>
								</div>
								<div>
									<div class="modal__body-price-wrap">
										<p class="modal__body-price js-modal-price">###</p>
									</div>
									<div class="modal__body-raiting">
										<svg class="rating-pack" width='145' height='33'>
											<use href="<?php bloginfo(
												"template_url",
											); ?>/assets/images/icons.svg#stars-pack-nf"></use>
										</svg>
										<div class='js-modal-rating'>
											<svg width='145' height='33'>
												<use href="<?php bloginfo(
													"template_url",
												); ?>/assets/images/icons.svg#stars-pack"></use>
											</svg>
										</div>
										<a class="modal__body-raiting-link" href="#">25</a>
									</div>
								</div>
								<div class="modal__body-color-wrap">
									<p class="modal__body-color">
										Колір:<span class="modal__body-item-color js-modal-color">###</span>
									</p>
									<div class="modal__body-color-picker js-modal-color-list">
										<a class="modal__body-color-item active" href="#"></a>
									</div>
								</div>
								<div class="modal__body-size-wrap">
									<div>
										<p class="modal__body-size">
											Розмір:<span class="modal__body-item-size js-modal-size">###</span>
										</p>
										<div class="modal__body-size-picker js-modal-size-list">
											<button class="modal__body-size-btn active" type="button"> </button>
										</div>
									</div>
								</div>
								<div class="modal__body-actions-wrap">
									<button class="js-add-to-cart modal__body-actions-add" type="button">
										Додати до кошика<span class="loader visually-hidden js-modal-loader"></span>
									</button>
									<a class="modal__body-actions-item-page js-to-item-page"
										href="/bedding/item.html">На
										сторінку
										товару</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
			do_action('woocommerce_after_main_content');

			echo do_shortcode('[insta_block]');

			get_footer();