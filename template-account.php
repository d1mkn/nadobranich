<?php
/*
Template name: Account Template
*/
get_header();
?>

<?php
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
                <li class="cabinet-navigation__item"> <button class="active cabinet-navigation__button"
                        data-target="section1" type="button"> Особисті дані </button> </li>
                <li class="cabinet-navigation__item"> <button class="cabinet-navigation__button" data-target="section2"
                        type="button"> Історія замовлень </button> </li>
                <li class="cabinet-navigation__item"> <button class="cabinet-navigation__button" data-target="section3"
                        type="button"> Змінити пароль </button> </li>
                <li class="cabinet-navigation__item"> <button class="cabinet-navigation__button" type="button"> <svg
                            width="13" height="8">
                            <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#faq-arrow"></use>
                        </svg> Вийти з акаунту </button> </li>
            </ul>
            <div class="cabinet-content__block">
                <div id="section1" class="cabinet-content__personal-data cabinet-section cabinet-section-active">
                    <form class="personal-data__form" method="post" action="http://localhost/nadobranich/my-account/edit-account/"> <label class="personal-data__label"
                            for="name">Ім'я</label> <input class="personal-data__input" type="text" name="name"
                            placeholder="Ім'я"> <label class="personal-data__label" for="phone">Номер
                            телефону</label> <input class="personal-data__input" type="text" name="phone"
                            placeholder="+38 (___) ___-__-__"> <label class="personal-data__label" for="email">Електрона
                            адреса</label> <input class="personal-data__input" type="email" name="email"
                            placeholder="your@email.com"> </form>
                    <div class="personal-data__btn-wrap"> <button type="button" class="personal-data__btn"> Зберегти
                            зміни </button> </div>
                </div>
                <div id="section2" class="cabinet-content__history cabinet-section">
                    <p>Історія замовлень</p>
                </div>
                <div id="section3" class="cabinet-content__password cabinet-section">
                    <form class="personal-data__form" action="submit"> <label class="personal-data__label"
                            for="old-password">Старий пароль</label> <input class="personal-data__input" type="text"
                            name="old-password" placeholder="Введіть свій пароль"> <label class="personal-data__label"
                            for="new-password">Новий пароль</label> <input class="personal-data__input" type="text"
                            name="new-password" placeholder="Введіть новий пароль"> </form>
                    <div class="personal-data__btn-wrap"> <button type="button" class="personal-data__btn"> Змінити
                            пароль </button> </div>
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

<?php echo do_shortcode('[modalToCart_markup]') ?>
<?php echo do_shortcode('[insta_block]') ?>

<?php
get_footer();