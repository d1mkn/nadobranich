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
		$regular_price = $variation->get_regular_price();
		$salePrice = $variation->sale_price;

		$variations[] = array(
			'variationId' => $variation_id,
			'variationDesc' => $variationDesc . ", Кількісь: $variationQty",
			'variationQty' => $variationQty,
			'regularPrice' => $regular_price,
			'salePrice' => $salePrice
		);
	}
	$_SESSION['aboutSingleProduct'] = array(
		'isSimple' => $isSimple,
		'price' => $productPrice,
		'variations' => $variations,
		'dir' => get_template_directory_uri(),
		'aboutSizes' => $aboutSizes
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
<?php echo do_shortcode('[recently_viewed_products]') ?>

<div class="animate__animated animate__faster modal-backdrop visually-hidden">
	<?php echo do_shortcode('[modalAuth_markup]') ?>
	<?php echo do_shortcode('[modal_markup]') ?>
</div>

<?php echo do_shortcode('[modalToCart_markup]') ?>
<?php echo do_shortcode('[insta_block]') ?>

<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */