<?php

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    //Woocommerce support
    function nadobranich_add_woocommerce_support()
    {
        add_theme_support('woocommerce');
    }
    add_action('after_setup_theme', 'nadobranich_add_woocommerce_support');



    function custom_currency_symbol($currency_symbol, $currency)
    {
        // Replace the currency symbol with text
        switch ($currency) {
            case 'UAH':
                $currency_symbol = 'грн';
                break;
            default:
                $currency_symbol = 'грн';
        }
        return $currency_symbol;
    }
    add_filter('woocommerce_currency_symbol', 'custom_currency_symbol', 10, 2);

    // Налаштування архівної сторінки
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

    remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
    remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_product_description', 10);
    function custom_woocommerce_archive_description()
    {
        if (is_product_category()) {
            global $wp_query;
            $cat_id = $wp_query->get_queried_object_id();
            $prod_term = get_term($cat_id, 'product_cat');
            $description = $prod_term->description;
            echo '<p class="page-desc">' . $description . '</p>';
        }
    }
    add_action('woocommerce_archive_description', 'custom_woocommerce_archive_description', 10);

    // single product page hooks
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 30);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

    add_filter('woocommerce_product_tabs', 'remove_woocommerce_product_tabs', 98);
    function remove_woocommerce_product_tabs($tabs)
    {
        unset($tabs['reviews']);
        return $tabs;
    }

    function nadobranich_add_comment()
    {
        ?>
        <div class="product-reviews reviews__wrap">
            <?php comments_template(); ?>
        </div>
        <?php

    }
    add_action('woocommerce_after_main_content', 'nadobranich_add_comment', 11);

    function nadobranich_reviews_rating()
    {
        global $product;
        if (!wc_review_ratings_enabled()) {
            return;
        }
        $rating_count = $product->get_rating_count();
        $average = $product->get_average_rating();
        $ratingPercentage = ($average * 100) / 5;
        $adjustedPercentage = $ratingPercentage + floor($ratingPercentage / 20) * 0.5;
        ?>
        <div>
            <?php if ($rating_count > 0) { ?>
                <div class="rating-pack">
                    <img src="<?php bloginfo(
                        "template_url",
                    ); ?>/assets/images/rating-stars-nbg" alt="rating">
                    <div class='js-item-rating' style='width: <?php echo $adjustedPercentage ?>%'> </div>
                </div>

            <?php } else { ?>
                <div class="rating-pack">
                    <img src="<?php bloginfo(
                        "template_url",
                    ); ?>/assets/images/rating-stars-nbg" alt="rating">
                    <div class='js-modal-rating' style='width: 0%'> </div>
                </div>
            <?php }
            ?>
        </div>
        <?php
    }
    add_action('woocommerce_reviews_rating', 'nadobranich_reviews_rating', 30);

    function nadobranich_remove_url_field($fields)
    {
        unset($fields['url']);
        return $fields;
    }
    add_filter('comment_form_default_fields', 'nadobranich_remove_url_field', 25);

    function get_extra_fields_html()
    {
        ob_start();
        ?>
        <div class="reviews__form-inputs-wrap">
            <div class="reviews__form-input-wrap">
                <?php
                echo $fields['author'] = '<div class="validation-wrap"><input class="reviews__form-input" type="name" name="author" placeholder="Ім\'я" required="true"><span class="error visually-hidden">Вкажіть ім\'я</span></div>';
                echo $fields['email'] = '<div class="validation-wrap"><input class="reviews__form-input" type="email" name="email" placeholder="Електронна адреса" required="true"><span class="error visually-hidden">Вкажіть e-mail</span></div>'
                    ?>
            </div>
            <?php
            echo $fields['title'] = '<div class="validation-wrap"><input class="reviews__form-input w820p" type="text" name="title" placeholder="Заголовок відгука" required="true"><span class="error visually-hidden">Напишіть заголовок відгука</span></div>';
            echo $fields['comment'] = '<div class="validation-wrap"><textarea class="reviews__form-textarea" name="comment" placeholder="Відгук" required="true"></textarea><span class="error visually-hidden">Напишіть відгук</span></div>'
                ?>
        </div>

        <?php
        return ob_get_clean();
    }

    function render_extra_fields($comment_field)
    {
        if (!is_product()) {
            return $comment_field;
        }

        return $comment_field . get_extra_fields_html();
    }
    add_filter('comment_form_field_comment', 'render_extra_fields', 99, 1);

    function save_review_title($comment_id, $approved, $commentdata)
    {
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $author = isset($_POST['author']) ? $_POST['author'] : '';

        add_comment_meta($comment_id, 'title', esc_html($title));
        add_comment_meta($comment_id, 'author', esc_html($author));
    }
    add_action('comment_post', 'save_review_title', 10, 3);

    function extend_comment_add_meta_box($comment)
    {
        $post_id = $comment->comment_post_ID;
        $product = wc_get_product($post_id);

        if ($product === null || $product === false) {
            return;
        }

        add_meta_box('pcf_fields', 'Title', 'render_pcf_fields_metabox', 'comment', 'normal', 'high');
    }
    add_action('add_meta_boxes_comment', 'extend_comment_add_meta_box', 10, 1);

    function render_pcf_fields_metabox($comment)
    {
        $title = get_comment_meta($comment->comment_ID, 'title', true); ?>

        <p>
            <label for="phone">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo esc_attr($title); ?>" class="widefat" />
        </p>
        <?php
    }
    function nadobranich_recently_viewed_product_cookie()
    {
        if (!is_product()) {
            return;
        }
        if (empty($_COOKIE['woocommerce_recently_viewed_2'])) {
            $viewed_products = array();
        } else {
            $viewed_products = (array) explode('|', $_COOKIE['woocommerce_recently_viewed_2']);
        }
        if (!in_array(get_the_ID(), $viewed_products)) {
            $viewed_products[] = get_the_ID();
        }
        if (sizeof($viewed_products) > 10) {
            array_shift($viewed_products);
        }
        wc_setcookie('woocommerce_recently_viewed_2', join('|', $viewed_products));
    }
    add_action('template_redirect', 'nadobranich_recently_viewed_product_cookie', 20);
    function nadobranich_cart_update_qty_script()
    {
        if (is_cart() && !WC()->cart->is_empty()):
            ?>
            <script>
                jQuery('body').on('click', '.item__body-select', function () {
                    var input = jQuery(this).closest('.cart__item').find('.old-selector');
                    var quantity = input[0].defaultValue;
                    jQuery("[name='update_cart']").removeAttr('disabled');
                    input.val(quantity).trigger('change');
                    jQuery('[name="update_cart"]').trigger('click');
                });
                const selects = document.querySelectorAll(".item__body-select-wrap");

                selects.forEach((select) => {
                    const optionsList = select.querySelector(".select-options-wrap");
                    const options = select.querySelectorAll(".item__body-select");
                    let selectedOption = select.querySelector(".selected-option");
                    const qtyEl = select.closest(".cart__item").querySelector(".old-selector");

                    select.addEventListener("click", (e) => {
                        selects.forEach((otherSelect) => {
                            if (otherSelect !== select) {
                                otherSelect.querySelector(".select-options-wrap").classList.add("visually-hidden");
                            }
                        });

                        optionsList.classList.toggle("visually-hidden");
                    });

                    options.forEach((option) => {
                        option.addEventListener("click", (e) => {
                            const clickedOption = e.currentTarget;
                            if (clickedOption.classList.contains("active")) {
                                return;
                            }
                            const activeOption = select.querySelector(".item__body-select.active");
                            if (activeOption) {
                                activeOption.classList.remove("active");
                            }
                            clickedOption.classList.add("active");
                            selectedOption.textContent = clickedOption.textContent;
                            qtyEl.setAttribute("value", clickedOption.textContent);
                            qtyEl.dispatchEvent(new Event("change"));
                        });
                    });
                    document.addEventListener("click", (e) => {
                        if (!e.target.closest(".item__body-select-wrap")) {
                            optionsList.classList.add("visually-hidden");
                        }
                    });
                });
                const main = document.querySelector('.cart__content-right');
                const observer = new MutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                        const cartTotal = document.querySelector('[data-title="Кількість товарів"]')
                        const cartCounter = document.querySelector('.js-cart-counter');
                        cartCounter.textContent = cartTotal.textContent;

                        document.querySelectorAll(".item__body-select-wrap").forEach((select) => {
                            const optionsList = select.querySelector(".select-options-wrap");
                            const options = select.querySelectorAll(".item__body-select");
                            let selectedOption = select.querySelector(".selected-option");
                            const qtyEl = select.closest(".cart__item").querySelector(".old-selector");

                            select.addEventListener("click", (e) => {
                                document.querySelectorAll(".item__body-select-wrap").forEach((otherSelect) => {
                                    if (otherSelect !== select) {
                                        otherSelect.querySelector(".select-options-wrap").classList.add("visually-hidden");
                                    }
                                });

                                optionsList.classList.toggle("visually-hidden");
                            });

                            options.forEach((option) => {
                                option.addEventListener("click", (e) => {
                                    const clickedOption = e.currentTarget;
                                    if (clickedOption.classList.contains("active")) {
                                        return;
                                    }
                                    const activeOption = select.querySelector(".item__body-select.active");
                                    if (activeOption) {
                                        activeOption.classList.remove("active");
                                    }
                                    clickedOption.classList.add("active");
                                    selectedOption.textContent = clickedOption.textContent;
                                    qtyEl.setAttribute("value", clickedOption.textContent);
                                    qtyEl.dispatchEvent(new Event("change"));
                                });
                            });
                            document.addEventListener("click", (e) => {
                                if (!e.target.closest(".item__body-select-wrap")) {
                                    optionsList.classList.add("visually-hidden");
                                }
                            });
                        });
                    });
                });
                const config = { childList: true, subtree: true };
                observer.observe(main, config);
            </script>
            <?php
        endif;
    }
    add_action('wp_footer', 'nadobranich_cart_update_qty_script');
    function nadobranich_disable_login_redirect($redirect, $request, $user)
    {
        return false;
    }
    add_filter('login_redirect', 'nadobranich_disable_login_redirect', 10, 3);
    function nadobranich_customer_login_redirect($redirect, $user)
    {
        wp_redirect('');
        exit();
    }
    add_action('wp_login', 'nadobranich_customer_login_redirect', 9999, 2);
    function nadobranich_logout_function()
    {
        wp_redirect('');
        exit();
    }
    add_action('wp_logout', 'nadobranich_logout_function');
    function nadobranich_form_registration_fields()
    {
        $billing_first_name = !empty($_POST['billing_first_name']) ? $_POST['billing_first_name'] : '';
        echo '<p class="form-row form-row-first">
		<label for="billing_first_name">Ім\'я<span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_first_name" id="billing_first_name" value="' . esc_attr($billing_first_name) . '" />
	</p>';
        $billing_last_name = !empty($_POST['billing_last_name']) ? $_POST['billing_last_name'] : '';
        echo '<p class="form-row form-row-last">
		<label for="billing_last_name">Прізвище<span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_last_name" id="billing_last_name" value="' . esc_attr($billing_last_name) . '" />
	</p>';
        $user_password = !empty($_POST['user_password']) ? $_POST['user_password'] : '';
        echo '<p class="form-row form-row-last">
		<label for="user_password">Пароль<span class="required">*</span></label>
		<input type="password" class="input-text" name="user_password" id="user_password" value="' . esc_attr($user_password) . '" />
	</p>';
        echo '<div class="clear"></div>';
    }
    add_action('register_form', 'nadobranich_form_registration_fields', 25);
    function nadobranich_save_register_fields($user_id)
    {
        $userdata = [];
        $userdata['ID'] = $user_id;
        if (isset($_POST['billing_first_name'])) {
            update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['billing_first_name']));
            update_user_meta($user_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
        }
        if (isset($_POST['billing_last_name'])) {
            update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['billing_last_name']));
            update_user_meta($user_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
        }
        if (isset($_POST['user_password'])) {
            $userdata['user_pass'] = $_POST['user_password'];
            wp_update_user($userdata);
            wp_set_auth_cookie($user_id);
        }
    }
    add_action('user_register', 'nadobranich_save_register_fields', 100);

    function nadobranich_save_edit_user()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                if (isset($_POST['account_first_name'])) {
                    $first_name = sanitize_text_field($_POST['account_first_name']);
                    wp_update_user(
                        array(
                            'ID' => $current_user->ID,
                            'first_name' => $first_name,
                        )
                    );
                }
                if (isset($_POST['account_first_name'])) {
                    $last_name = sanitize_text_field($_POST['account_last_name']);
                    wp_update_user(
                        array(
                            'ID' => $current_user->ID,
                            'last_name' => $last_name,
                        )
                    );
                }
                if (isset($_POST['account_email'])) {
                    $email = sanitize_text_field($_POST['account_email']);
                    wp_update_user(
                        array(
                            'ID' => $current_user->ID,
                            'user_email' => $email,
                        )
                    );
                }
                if (isset($_POST['account_phone'])) {
                    $phone = sanitize_text_field($_POST['account_phone']);
                    update_user_meta($current_user->ID, 'billing_phone', $phone);
                }
                if (isset($_POST['password_2'])) {
                    $current_password = sanitize_text_field($_POST['password_current']);
                    $password = sanitize_text_field($_POST['password_2']);
                    $password_match = wp_check_password($current_password, $current_user->user_pass, $current_user->ID);
                    if ($password_match) {
                        wp_update_user(
                            array(
                                'ID' => $current_user->ID,
                                'user_pass' => $password,
                            )
                        );
                        echo '<div class="pass-success">Пароль успішно змінено</div>';
                    } else {
                        echo '<div class="pass-error">Вказано невірний пароль</div>';
                    }
                }
                exit;
            }
        }
    }
    add_action('template_redirect', 'nadobranich_save_edit_user');
    function nadobranich_check_cart_items_availability()
    {
        $cart = WC()->cart;

        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            $product_id = $cart_item['product_id'];
            $variation_id = $cart_item['variation_id'];

            if ($variation_id > 0) {
                $product = wc_get_product($variation_id);
            } else {
                $product = wc_get_product($product_id);
            }

            if (!$product || !$product->is_in_stock()) {
                $cart->remove_cart_item($cart_item_key);
            }
        }
    }
    add_action('woocommerce_before_cart', 'nadobranich_check_cart_items_availability');
    function hide_core_update_notification()
    {
        remove_action('admin_notices', 'update_nag', 3);
    }
    add_action('admin_head', 'hide_core_update_notification');
    add_action('admin_bar_menu', function ($wp_adminbar) {
        $wp_adminbar->remove_node('updates');
    }, 999);

    add_action('admin_menu', function () {

        remove_action('admin_notices', 'update_nag', 3);

        remove_action('network_admin_notices', 'update_nag', 3);

        remove_action('update_footer', 'core_update_footer');

        remove_submenu_page('index.php', 'update-core.php');

        $GLOBALS['menu'][65][0] = __('Plugins');

        remove_menu_page("edit.php?post_type=acf-field-group"); # ACF
        remove_menu_page("WP-Optimize"); # WP-Optimize
        remove_menu_page("getwooplugins"); # 
        remove_menu_page("ald_setting"); # load more anything

    }, 999);

    add_action('admin_head-index.php', function () {
        ?>
                <style>
                    #wp-version-message .button {
                        display: none;
                    }
                </style>
                <?php
    });
}