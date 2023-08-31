<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined('ABSPATH') || exit;

global $product;

if (!comments_open()) {
	return;
}

?>
<div id="reviews" class="container reviews">
	<div id="comments">
		<div class="reviews__top">
			<div class="reviews__top-left-wrap">
				<p class="reviews__title">Відгуки</p>
				<span class="reviews__rating">
					<?php do_action('woocommerce_reviews_rating'); ?>
				</span>
			</div> <button class="js-form-open-btn reviews__form-open-btn" type="button"> Написати відгук </button>
		</div>

		<?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())): ?>
			<div id="review_form_wrapper" class="js-review-form reviews__form h0 o0 visually-hidden">
				<div id="review_form">
					<?php
					$commenter = wp_get_current_commenter();
					$comment_form = array(
						/* translators: %s is product title */
						'title_reply' => 'Оцінка',
						/* translators: %s is product title */
						'title_reply_to' => 'Оцінка',
						'title_reply_before' => '<div class="reviews__form-label"><label for="rating">',
						'title_reply_after' => '</label></div>',
						'comment_notes_after' => '',
						'label_submit' => esc_html__('Надіслати відгук', 'woocommerce'),
						'logged_in_as' => '',
						'comment_field' => '',
						'submit_button' => '<button name="%1$s" type="submit" class="reviews__form-submit-btn">%4$s</button>',
						'submit_field' => '<div class="reviews__form-submit-btn-wrap">%1$s %2$s</div>',
					);

					$comment_form['fields'] = array();

					$account_page_url = wc_get_page_permalink('myaccount');
					if ($account_page_url) {
						/* translators: %s opening and closing link tags respectively */
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
					}

					if (wc_review_ratings_enabled()) {
						$comment_form['comment_field'] = '<div class="reviews__form-rating"><select name="rating" id="rating" required>
						<option value="">' . esc_html__('Rate&hellip;', 'woocommerce') . '</option>
						<option value="5">' . esc_html__('Perfect', 'woocommerce') . '</option>
						<option value="4">' . esc_html__('Good', 'woocommerce') . '</option>
						<option value="3">' . esc_html__('Average', 'woocommerce') . '</option>
						<option value="2">' . esc_html__('Not that bad', 'woocommerce') . '</option>
						<option value="1">' . esc_html__('Very poor', 'woocommerce') . '</option>
					</select>
					<span class="error visually-hidden">Оцініть товар</span>
					</div>';
					}
					comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
					?>
				</div>
			</div>
		<?php else: ?>
			<p class="woocommerce-verification-required">
				<?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?>
			</p>
		<?php endif; ?>

		<?php if (have_comments()): ?>
			<ul class="reviews__list commentlist">
				<?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
			</ul>

			<?php
			if (get_comment_pages_count() > 1 && get_option('page_comments')):
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
							'next_text' => is_rtl() ? '&larr;' : '&rarr;',
							'type' => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else: ?>
			<p class="woocommerce-noreviews">
				<?php esc_html_e('There are no reviews yet.', 'woocommerce'); ?>
			</p>
		<?php endif; ?>
		</p>
	</div>



	<div class="clear"></div>
</div>