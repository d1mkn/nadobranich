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
            echo '<p class="category-page__desc">' . $description . '</p>';
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
                echo $fields['email'] = '<div class="validation-wrap"><input class="reviews__form-input" type="email" name="email" placeholder="Електронна адреса" required="true"><span class="error visually-hidden">Вкажіть коректний e-mail</span></div>'
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
    function cart_update_qty_script()
    {
        if (is_cart()):
            ?>
            <script>
                jQuery('.woocommerce').on('change', '.item__body-select', function () {
                    jQuery("[name='update_cart']").trigger("click");
                });
                const main = document.querySelector('main');
                const observer = new MutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                        const cartTotal = document.querySelector('[data-title="Кількість товарів"]')
                        const cartCounter = document.querySelector('.js-cart-counter');
                        cartCounter.textContent = cartTotal.textContent;
                    });
                });
                const config = { childList: true, subtree: true };
                observer.observe(main, config);
            </script>
            <?php
        endif;
    }
    add_action('wp_footer', 'cart_update_qty_script');
}