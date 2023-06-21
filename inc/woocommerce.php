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
                $currency_symbol = '';
        }
        return $currency_symbol;
    }
    add_filter('woocommerce_currency_symbol', 'custom_currency_symbol', 10, 2);
}