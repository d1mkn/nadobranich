<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$comment_id = get_comment_ID();
$comment = get_comment($comment_id);
$rating = get_comment_meta($comment_id, 'rating', true);
$ratingPercentage = ($rating * 100) / 5;
$title = get_comment_meta($comment_id, 'title', true);
$author = get_comment_meta($comment_id, 'author', true);
$first_letter = mb_substr($author, 0, 1, 'UTF-8');
$first_letter_uppercase = mb_strtoupper($first_letter, 'UTF-8');
$comment_date = get_comment_date('j F Y', $comment_id);
$parts = explode(' ', $comment_date);
$month = mb_strtolower($parts[1], 'UTF-8');
$parts[1] = $month;
$updated_date = implode(' ', $parts);
$comment_text = get_comment_text();
?>
<li class="reviews__item" id="li-comment-<?php comment_ID(); ?>">
	<div class="reviews__item-left"> <span class="reviews__item-raiting">
			<img src="<?php bloginfo(
				"template_url",
			); ?>/assets/images/rating-stars-nbg" alt="rating">
			<div class='review__raiting' style='width: <?php echo $ratingPercentage - 1 ?>%'> </div>
		</span>
		<div class="reviews__item-info">
			<div class="reviews__item-letter-wrap">
				<p class="reviews__item-letter">
					<?php echo $first_letter_uppercase ?>
				</p>
			</div>
			<div>
				<p class="reviews__item-name">
					<?php echo $author ?>
				</p>
				<p class="reviews__item-date">
					<?php echo $updated_date ?> p.
				</p>
			</div>
		</div>
	</div>
	<div class="reviews__item-right">
		<p class="reviews__item-title">
			<?php echo $title ?>
		</p>
		<p class="reviews__item-text">
			<?php echo $comment_text ?>
		</p>
	</div>
</li>