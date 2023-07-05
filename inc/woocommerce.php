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

}