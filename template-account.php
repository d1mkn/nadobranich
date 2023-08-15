<?php
/*
Template name: Account Template
*/
get_header();
?>

<?php
$user = wp_get_current_user();
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    do_action('woocommerce_before_main_content');
}
?>

<div class="container">
    <div class="cabinet-title__wrap">
        <h1 class="cabinet-title">
            <?php the_title() ?>
        </h1>
    </div>
    <div class="cabinet-content">
        <div class="cabinet-navigation__wrap">
            <ul class="cabinet-navigation__list">
                <li class="cabinet-navigation__item">
                    <button class="active cabinet-navigation__button js-cabinet-nav-item" data-target="section1"
                        type="button"> Особисті
                        дані <button>
                </li>
                <li class="cabinet-navigation__item">
                    <button class="cabinet-navigation__button js-cabinet-nav-item" data-target="section2" type="button">
                        Історія замовлень
                    </button>
                </li>
                <li class="cabinet-navigation__item">
                    <button class="cabinet-navigation__button js-cabinet-nav-item" data-target="section3" type="button">
                        Змінити пароль
                    </button>
                </li>
                <li class="cabinet-navigation__item">
                    <a class="cabinet-navigation__button js-cabinet-logout" href="<?php echo wp_logout_url() ?>">
                        <svg width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg>Вийти з акаунту</a>
                </li>
            </ul>
            <div class="cabinet-content__block">
                <div id="section1" class="cabinet-content__personal-data cabinet-section cabinet-section-active">
                    <form class="personal-data__form" action="http://localhost/nadobranich/my-account/edit-account/"
                        method="post" id="edit-form">
                        <label class="personal-data__label" for="account_first_name">Ім'я</label>
                        <input class="personal-data__input" type="text" name="account_first_name"
                            id="account_first_name" placeholder="Ім'я"
                            value="<?php echo esc_attr($user->first_name); ?>">

                        <label class="personal-data__label" for="account_last_name">Прізвище</label>
                        <input class="personal-data__input" type="text" name="account_last_name" id="account_last_name"
                            autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" />

                        <label class="personal-data__label" for="phone">Номер телефону</label>
                        <input class="personal-data__input" type="text" name="phone" placeholder="+38 (___) ___-__-__">

                        <label class="personal-data__label" for="account_email">Електронна адреса</label>
                        <input class="personal-data__input" type="email" name="account_email"
                            placeholder="your@email.com" name="account_email" id="account_email"
                            autocomplete="family-name" value="<?php echo esc_attr($user->user_email); ?>">
                    </form>
                    <div class="personal-data__btn-wrap">
                        <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
                        <input type="hidden" name="action" value="save_account_details" />
                        <button form="edit-form" type="submit" class="personal-data__btn js-edit-user"
                            name="save_account_details">
                            Зберегти зміни </button>
                    </div>
                </div>
                <div id="section2" class="cabinet-content__history cabinet-section">
                    <h2 style="font-weight: 500">Історія замовлень</h2>
                    <?php defined('ABSPATH') || exit;

                    $my_orders_columns = apply_filters(
                        'woocommerce_my_account_my_orders_columns',
                        array(
                            'order-number' => esc_html__('Order', 'woocommerce'),
                            'order-date' => esc_html__('Date', 'woocommerce'),
                            'order-status' => esc_html__('Status', 'woocommerce'),
                            'order-total' => esc_html__('Вартість', 'woocommerce'),
                        )
                    );

                    $customer_orders = get_posts(
                        apply_filters(
                            'woocommerce_my_account_my_orders_query',
                            array(
                                'meta_key' => '_customer_user',
                                'meta_value' => get_current_user_id(),
                                'post_type' => wc_get_order_types('view-orders'),
                                'post_status' => array_keys(wc_get_order_statuses()),
                            )
                        )
                    );

                    if ($customer_orders): ?>

                        <table class="shop_table shop_table_responsive my_account_orders">

                            <thead>
                                <tr>
                                    <?php foreach ($my_orders_columns as $column_id => $column_name): ?>
                                        <th class="<?php echo esc_attr($column_id); ?>"><span class="nobr">
                                                <?php echo esc_html($column_name); ?>
                                            </span></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($customer_orders as $customer_order):
                                    $order = wc_get_order($customer_order); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                    $item_count = $order->get_item_count();
                                    ?>
                                    <tr class="order">
                                        <?php foreach ($my_orders_columns as $column_id => $column_name): ?>
                                            <td class="<?php echo esc_attr($column_id); ?>"
                                                data-title="<?php echo esc_attr($column_name); ?>">
                                                <?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)): ?>
                                                    <?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>

                                                <?php elseif ('order-number' === $column_id): ?>
                                                    № <?php echo $order->get_order_number(); ?>

                                                <?php elseif ('order-date' === $column_id): ?>
                                                    <time
                                                        datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></time>

                                                <?php elseif ('order-status' === $column_id): ?>
                                                    <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>

                                                <?php elseif ('order-total' === $column_id): ?>
                                                    <?php
                                                    /* translators: 1: formatted order total 2: total order items */
                                                    printf($order->get_formatted_order_total()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                    ?>

                                                <?php elseif ('order-actions' === $column_id): ?>
                                                    <?php
                                                    $actions = wc_get_account_orders_actions($order);

                                                    if (!empty($actions)) {
                                                        foreach ($actions as $key => $action) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                                            echo '<a href="' . esc_url($action['url']) . '" class="button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                                        }
                                                    }
                                                    ?>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
                <div id="section3" class="cabinet-content__password cabinet-section">
                    <form class="personal-data__form" action="http://localhost/nadobranich/my-account/edit-account/"
                        method="post" id="change-pass">
                        <label class="personal-data__label" for="password_current">Старий пароль</label>
                        <input class="personal-data__input" type="password" name="password_current"
                            id="password_current" autocomplete="off" placeholder="Введіть свій пароль">

                        <label class="personal-data__label" for="password_1">Новий пароль</label>
                        <input class="personal-data__input" type="password" name="password_1" id="password_1"
                            autocomplete="off" placeholder="Введіть новий пароль">

                        <label class="personal-data__label" for="password_2">Повторіть новий пароль</label>
                        <input class="personal-data__input" type="password" name="password_2" id="password_2"
                            autocomplete="off" placeholder="Повторіть новий пароль">
                    </form>
                    <div class="personal-data__btn-wrap">
                        <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
                        <input type="hidden" name="action" value="save_account_details" />
                        <button form="change-pass" type="submit" class="personal-data__btn js-change-pass"
                            name="save_account_details">Змінити пароль</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="cabinet-contacts">
            <p class="cabinet-contacts__text">Давайте будемо на зв’язку!</p>
            <div class="cabinet-contacts__phone"> <svg class="cabinet-contacts__icon" width="15" heigth="15">
                    <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#phone"></use>
                </svg>
                <ul class="cabinet-contacts__list">
                    <li> <a class="cabinet-contacts__link" href="tel:+380983363028">(098) 33-63-028</a> </li>
                    <li> <a class="cabinet-contacts__link" href="tel:+380983363028">(098) 33-63-028</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>

</main><!-- #main -->

<div class="animate__animated animate__faster modal-backdrop visually-hidden">
    <?php echo do_shortcode('[modalAuth_markup]') ?>
    <?php echo do_shortcode('[modal_markup]') ?>
</div>

<?php echo do_shortcode('[insta_block]') ?>

<?php
get_footer();