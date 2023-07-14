<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>
<div class="container">
	<div class="cart__content">
		<div class="cart__content-left">
			<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
				<?php do_action('woocommerce_before_cart_table'); ?>

				<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
					<tbody>
						<?php do_action('woocommerce_before_cart_contents'); ?>

						<?php
						foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
							$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
							$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
							?>

							<?php
							/**
							 * Filter the product name.
							 *
							 * @since 7.8.0
							 * @param string $product_name Name of the product in the cart.
							 */
							$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

							if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
								$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
								?>
								<tr
									class="cart__item woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
									<div>
										<td class="product-thumbnail">
											<div class="cart__item-img">
												<?php
												$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

												if (!$product_permalink) {
													echo $thumbnail; // PHPCS: XSS ok.
												} else {
													printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
												}
												?>
											</div>
										</td>
										<td class="product-name cart__item-details"
											data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
											<?php
											if (!$product_permalink) {
												/**
												 * Filter the product name.
												 *
												 * @since 7.8.0
												 * @param string $product_name Name of the product in the cart.
												 * @param array $cart_item The product in the cart.
												 * @param string $cart_item_key Key for the product in the cart.
												 */
												echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key) . '&nbsp;');
											} else {
												/**
												 * Filter the product name.
												 *
												 * @since 7.8.0
												 * @param string $product_url URL the product in the cart.
												 */
												echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a class="cart__item-title" href="%s">%s</a>', esc_url($product_permalink), $_product->get_title()), $cart_item, $cart_item_key));
											}

											do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

											$variation_desc = $_product->attribute_summary;
											preg_match('/Колір: ([^,]+)/u', $variation_desc, $color_matches);
											$color = isset($color_matches[1]) ? trim($color_matches[1]) : '';
											echo "<p class='cart__item-color'> Колір: <span class='cart__item-span'>$color</span></p>";

											preg_match('/Розмір: ([^,]+)/u', $variation_desc, $size_matches);
											$size = isset($size_matches[1]) ? trim($size_matches[1]) : '';
											echo "<p class='cart__item-size'> Розмір: <span class='cart__item-span'>$size</span></p>";

											// Meta data.
											echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.
									
											// Backorder notification.
											if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
												echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
											}
											?>
										</td>
									</div>

									<td class="empty-td"></td>

									<td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
										<?php
										if ($_product->is_sold_individually()) {
											$min_quantity = 1;
											$max_quantity = 1;
										} else {
											$min_quantity = 0;
											$max_quantity = $_product->get_max_purchase_quantity();
										}

										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name' => "cart[{$cart_item_key}][qty]",
												'input_value' => $cart_item['quantity'],
												'max_value' => $max_quantity,
												'min_value' => $min_quantity,
												'product_name' => $product_name,
											),
											$_product,
											false
										);

										echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
										?>
									</td>

									<td class="cart__item-price" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
										<?php
										$subtotal = apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
								
										echo $_product->get_price() * $cart_item['quantity'] . ' грн';
										?>
									</td>

									<td class="cart__item-delete-btn">
										<?php
										echo apply_filters(
											// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg width="15" height="15"> <use href="' . get_template_directory_uri() . '/assets/images/icons.svg#close"></use> </svg></a>',
												esc_url(wc_get_cart_remove_url($cart_item_key)),
												/* translators: %s is the product name */
												esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), $product_name)),
												esc_attr($product_id),
												esc_attr($_product->get_sku())
											),
											$cart_item_key
										);
										?>
									</td>
								</tr>
								<?php
							}
						}
						?>

						<?php do_action('woocommerce_cart_contents'); ?>

						<tr>
							<td colspan="6" class="actions">

								<?php if (wc_coupons_enabled()) { ?>
									<div class="coupon">
										<label for="coupon_code" class="screen-reader-text">
											<?php esc_html_e('Coupon:', 'woocommerce'); ?>
										</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code"
											value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
										<button type="submit"
											class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
											name="apply_coupon"
											value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
										<?php do_action('woocommerce_cart_coupon'); ?>
									</div>
								<?php } ?>

								<button type="submit"
									class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
									name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

								<?php do_action('woocommerce_cart_actions'); ?>

								<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
							</td>
						</tr>

						<?php do_action('woocommerce_after_cart_contents'); ?>
					</tbody>
				</table>
				<?php do_action('woocommerce_after_cart_table'); ?>
			</form>
		</div>


		<?php do_action('woocommerce_before_cart_collaterals'); ?>

		<div class="cart__content-right">
			<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action('woocommerce_cart_collaterals');
			?>
		</div>

		<?php do_action('woocommerce_after_cart'); ?>