<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>
<div class="cart_totals<?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">
	<div class="cart__total-wrap ">
		<?php do_action('woocommerce_before_cart_totals'); ?>

		<table cellspacing="0" class="shop_table shop_table_responsive">
			<tbody class="cart__total">
				<tr class="cart-subtotal">
					<th>
						<?php esc_html_e('Subtotal', 'woocommerce'); ?>
					</th>
					<td data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php wc_cart_totals_subtotal_html(); ?>
					</td>
				</tr>

				<?php foreach (WC()->cart->get_coupons() as $code => $coupon): ?>
					<tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
						<th>
							<?php wc_cart_totals_coupon_label($coupon); ?>
						</th>
						<td data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></td>
					</tr>
				<?php endforeach; ?>


				<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

				<tr class="order-total cart__total-item">
					<?php
					$total = WC()->cart->total;
					$total_price = str_replace('.00', '', $total);
					?>
					<th>
						<?php esc_html_e('Загальна сума:', 'woocommerce'); ?>
					</th>
					<td data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><?php echo $total_price . ' грн' ?>
					</td>
				</tr>

				<?php do_action('woocommerce_cart_totals_after_order_total'); ?>
			</tbody>
		</table>


		<div class="wc-proceed-to-checkout">
			<?php do_action('woocommerce_proceed_to_checkout'); ?>
		</div>
	</div>

	<?php do_action('woocommerce_after_cart_totals'); ?>

</div>
</div>
</div>