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


}