<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header('shop'); ?>

<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('woocommerce_before_main_content');
?>

<?php while (have_posts()): ?>
	<?php the_post();
	global $product;
	$productPrice = $product->price;
	$isSimple = $product->is_type('simple');
	$aboutSizes = get_field('about_size');
	$productVariations = $product->get_children(
		array(
			'post_parent' => $product->ID,
			'post_type' => 'product_variation',
		)
	);
	$variations = array();
	foreach ($productVariations as $variation_id) {
		$variation = wc_get_product($variation_id);
		$variationDesc = $variation->attribute_summary;
		$variationQty = $variation->get_stock_quantity();

		$variations[] = array(
			'variationDesc' => $variationDesc . ", Кількісь: $variationQty",
			'variationQty' => $variationQty,
		);
	}
	$comments = array(
		wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments')))
	);
	// var_dump($comments);
	$_SESSION['aboutSingleProduct'] = array(
		'isSimple' => $isSimple,
		'price' => $productPrice,
		'variations' => $variations,
		'dir' => get_template_directory_uri(),
		'aboutSizes' => $aboutSizes,
		'comments' => $comments
	);
	?>

	<script>
		const aboutSingleProduct = <?php echo json_encode($_SESSION['aboutSingleProduct']); ?>;
		localStorage.setItem('aboutSingleProduct', JSON.stringify(aboutSingleProduct));
	</script>

	<div class="container item__container">
		<?php wc_get_template_part('content', 'single-product'); ?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action('woocommerce_after_single_product_summary');
?>
<?php endwhile; // end of the loop. ?>
<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');
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
								<li class="modal__images-item js-modal-gallery"><a href="#"><img src="#" alt="#"></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="modal__body-desc">
						<div class="modal__body-header">
							<h5 class="modal__body-title"> </h5>
							<p class="modal__body-composition"> </p>
						</div>
						<div>
							<div class="body-price-wrap">
								<p class="body-price js-modal-price">###</p>
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
							<a class="modal__body-actions-item-page js-to-item-page" href="#">На
								сторінку
								товару</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */