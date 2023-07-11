<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
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

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $product;

if (!wc_review_ratings_enabled()) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average = $product->get_average_rating();
$ratingPercentage = ($average * 100) / 5;
$adjustedPercentage = $ratingPercentage + floor($ratingPercentage / 20) * 0.5;
?>


<div class="item__body-raiting">

	<?php if ($rating_count > 0) { ?>

		<div class="rating-pack">
			<img src="<?php bloginfo(
				"template_url",
			); ?>/assets/images/rating-stars-nbg" alt="rating">
			<div class='js-modal-rating' style='width: <?php echo $adjustedPercentage ?>%'> </div>
		</div>
		<?php if (comments_open()): ?>
			<?php //phpcs:disable ?>
			<a href="#reviews" class="modal__body-raiting-link" rel="nofollow">
				<?php echo $product->review_count ?>
			</a>
			<?php // phpcs:enable ?>
		<?php endif ?>

	<?php } else { ?>
		<div class="rating-pack">
			<img src="<?php bloginfo(
				"template_url",
			); ?>/assets/images/rating-stars-nbg" alt="rating">
			<div class='js-modal-rating' style='width: 0%'> </div>
		</div>
		<?php if (comments_open()): ?>
			<?php //phpcs:disable ?>
			<a href="#reviews" class="modal__body-raiting-link" rel="nofollow">
				0
			</a>
			<?php // phpcs:enable ?>
		<?php endif ?>

	<?php }
	?>
</div>