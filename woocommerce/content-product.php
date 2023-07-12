<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>
<?php global $product;

// Дані для ренедру та мобального вікна
$is_on_sale = $product->is_on_sale();
$attributes = $product->get_attributes();
$productId = $product->get_id();
$productTitle = get_the_title();
$productPrice = $product->price;
$regular_price = null;
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
	$regular_price = $variation->get_regular_price();

	$variations[] = array(
		'variationId' => $variationId,
		'variationDesc' => $variationDesc,
		'variationPrice' => $variationPrice,
		'regularPrice' => $regular_price,
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
	'category' => $category_name,
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
?>
<li class="single-category__item <?php if (is_single()) {
	echo 'swiper-slide';
} ?>" productid=<?php echo $productId ?>>
	<?php
	// Якщо товар акціний, то буде плашка
	if ($is_on_sale): ?>
		<div class="single-category__sale-item">
			<p>Aкція</p>
		</div>
		<div class="single-category__item-link">
			<?php
		// Якщо не акціний, то буде звичайна картка
	else: ?>
			<div class="single-category__item-link">
			<?php endif; ?>
			<div class="js-quick-view single-category__item-overlay">
				<p class="single-category__item-overlay-text">Швидкий перегляд</p>
				<p class="single-category__item-overlay-text-tab">+</p>
			</div>
			<div class="single-category__item-about">
				<a href="<?php echo get_permalink() ?>">
					<div class="single-category__item-img">
						<?php echo get_the_post_thumbnail() ?>
					</div>
				</a>
				<h4 class="single-category__item-title">
					<?php echo $productTitle ?>
				</h4>
				<p class="single-category__item-desc">
					<?php echo $productShortDesc ?>
				</p>

				<?php
				// Якщо товар акціний, то буде стара та нова ціна
				if ($is_on_sale): ?>
					<span class="old-price single-category__item-price">Від <span class="item-price">
							<?php echo $regular_price ?> грн
						</span><span class="item-new-price">
							<?php echo $productPrice ?> грн
						</span></span>

					<?php
					// Якщо товар не акціний, то буде звичайна мінімальна ціна
				else: ?>
					<span class="single-category__item-price">Від
						<?php echo $productPrice ?> грн
					</span>
				<?php endif; ?>
				<?php
				// Якщо атрибути є, шукаємо атрибут "Color"
				if ($productAttributes) {
					foreach ($attributes as $attribute) {
						$attributeName = $attribute->get_name();
						if ($attributeName === 'pa_color') {
							$terms = get_the_terms($product->id, 'pa_color');
							?>
							<div class="modal__body-color-picker">
								<?php
								// Підставляємо значення кольору як bg для кружечків
								foreach ($terms as $term) {
									$color = $term->slug; ?>
									<a class="modal__body-color-item" href="<?php echo get_permalink() ?>"
										style="background-color: <?php echo $color ?>;">
									</a>
								<?php } ?>
							</div>
						<?php }
					}
				} ?>
			</div>
		</div>
</li>