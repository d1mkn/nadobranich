<?php
/*
Template name: Checkout Template
*/
get_header();
?>

<?php
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    do_action('woocommerce_before_main_content');
    $user = wp_get_current_user();
}
?>

<div class="container">
    <div class="ordering-title__wrap">
        <h1 class="ordering-title">
            <?php the_title() ?>
        </h1>
    </div>
    <div class="ordering__content">
        <div class="ordering__content-left">
            <div class="ordering__form-wrap">
                <form class="ordering__form">
                    <div class="ordering__form-section">
                        <p class="ordering__form-title">Контактні дані</p>
                        <div class="ordering__form-inputs-group">
                            <div class="ordering__form-input-wrap">
                                <input class="ordering__form-input" type="text" id="billing_first_name"
                                    name="billing_first_name" placeholder=" "
                                    pattern="^[A-ZА-ЯЄІЇҐ][a-zA-Zа-яА-Яєіїґ]{1,}$" required=""
                                    value="<?php echo esc_attr($user->first_name) ?>">
                                <label class="ordering__form-label" for="billing_first_name">Ім'я</label>
                                <p class="invalid-input-message">Вкажіть ім'я з великої літери</p>
                            </div>

                            <div class="ordering__form-input-wrap">
                                <input class="ordering__form-input" type="text" id="billing_last_name"
                                    name="billing_last_name" placeholder=" "
                                    pattern="^[A-ZА-ЯЄІЇҐ][a-zA-Zа-яА-Яєіїґ]{1,}$" required=""
                                    value="<?php echo esc_attr($user->last_name) ?>">
                                <label class="ordering__form-label" for="billing_last_name">Прізвище</label>
                                <p class="invalid-input-message">Вкажіть прізвище з великої літери</p>
                            </div>

                            <div class="ordering__form-input-wrap">
                                <input class="ordering__form-input" type="tel" id="billing_phone" name="billing_phone"
                                    placeholder=" " required="" value="<?php echo esc_attr($user->billing_phone); ?>">
                                <label class="ordering__form-label" for="billing_phone">Телефон</label>
                                <p class="invalid-input-message">Це поле є обов'язковим</p>
                            </div>
                            <div class="ordering__form-input-wrap">
                                <input class="ordering__form-input" type="email" id="billing_email" name="billing_email"
                                    placeholder=" " required="" value="<?php echo esc_attr($user->user_email); ?>">
                                <label class="ordering__form-label" for="billing_email">Електронна адреса</label>
                                <p class="invalid-input-message"> Перевірте правильність вказаної електронної адреси
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="ordering__form-section">
                        <p class="ordering__form-title">Адреса та спосіб доставки</p>
                        <div>
                            <?php do_action('woocommerce_after_checkout_billing_form') ?>
                        </div>
                    </div>
                    <div class="ordering__form-section">
                        <p class="ordering__form-title">Спосіб оплати</p>
                        <div class="ordering__form-checkbox-wrap">
                            <input class="ordering__form-checkbox" type="radio" id="pay-on-delivery" name="how-to-pay">
                            <label for="pay-on-delivery">Оплата при отриманні</label>
                        </div>
                        <div class="pay-on-delivery-info">
                            <p class="pay-on-delivery-info-text"> Готівкою кур`єру або на відділенні Нової Пошти
                                (враховуйте комісію за накладений платіж). </p>
                            <p class="pay-on-delivery-info-text"> Карткою Visa/MasterCard за допомогою термінала у
                                кур`єра або на відділенні Нової Пошти. </p>
                        </div>
                        <div class="m0 ordering__form-checkbox-wrap">
                            <input class="ordering__form-checkbox" type="radio" id="online-payment" name="how-to-pay">
                            <label for="online-payment">Оплата картою онлайн (через LiqPay)</label>
                        </div>
                    </div>
                    <p class="ordering__form-title">Додати коментар до замовлення</p> <textarea
                        class="ordering__form-input-comment" id="order_comments" name="order_comments"></textarea>
                    <div class="ordering__form-submit-wrap">
                        <button class="ordering__form-submit" type="submit">Купити</button>
                        <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
                    </div>
                </form>
            </div>
        </div>
        <div class="ordering__content-right ordering-details-js">
            <div class="ordering__details">
                <p class="ordering__details-text">
                    <svg class="ordering__details-icon" width="24" height="24">
                        <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#cart"></use>
                    </svg>
                    <span class="mdn">Показати деталі замовлення</span>
                    <span class="tdn">Показати деталі</span>
                    <span class="ordering__details-icon-wrap">
                        <svg class="ordering__details-icon" width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>
                    </span>
                </p>
                <p class="ordering__details-text">
                    <?php echo number_format(WC()->cart->total, 0, '', ' ') ?> грн
                </p>
            </div>
            <div class="ordering-items-js">
                <div class="ordering__items-wrap">
                    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                        $image_id = $_product->image_id;
                        ?>
                        <div class="ordering__item">
                            <?php
                            $image_url = wp_get_attachment_url($image_id);
                            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                            ?>
                            <img class="ordering__item-img" src="<?php echo $image_url ?>" alt="<?php echo $image_alt ?>">
                            <div class="ordering__item-details">
                                <h2 class="ordering__item-title">
                                    <?php echo $_product->get_title() ?>
                                </h2>
                                <p class="ordering__item-color-size">
                                    <?php
                                    $variation_desc = $_product->attribute_summary;
                                    preg_match('/Колір: ([^,]+)/u', $variation_desc, $color_matches);
                                    $color = isset($color_matches[1]) ? trim($color_matches[1]) : '';

                                    preg_match('/Розмір: ([^,]+)/u', $variation_desc, $size_matches);
                                    $size = isset($size_matches[1]) ? trim($size_matches[1]) : ''; ?>
                                    <?php echo "$color / $size" ?>
                                </p>
                                <p class="ordering__item-price">
                                    <?php echo $cart_item['quantity'] . ' x ' . number_format($_product->price, 0, '', ' ') ?>
                                    грн
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="ordering__total-wrap">
                    <p class="ordering__total-price">Кількість товарів: <span class="ordering-title-span">
                            <?php echo WC()->cart->get_cart_contents_count() ?>
                        </span>
                    </p>
                    <p class="ordering__total-price">Загальна сума: <span class="ordering-title-span">
                            <?php echo number_format(WC()->cart->total, 0, '', ' ') ?> грн
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</main><!-- #main -->

<div class="animate__animated animate__faster modal-backdrop visually-hidden">
    <?php echo do_shortcode('[modalAuth_markup]') ?>
</div>

<?php
get_footer();