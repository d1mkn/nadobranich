<?php

add_shortcode('insta_block', 'insta_block_shortcode');
function insta_block_shortcode()
{
  $output = "<section class='insta'>
    <div class='container'>
      <div class='insta__text'>
        <div class='insta__text-wrap'>
          <p class='insta__link-text'>Долучайтесь до нас у інстаграмі</p>
          <a class='insta__link' target='_blank' href='https://www.instagram.com/na_dobranich_ua'>@na_dobranich_ua</a>
        </div>
      </div>
      <div class='insta__gallery'>
        <div class='insta__gallery-list'>";

  $output .= do_shortcode("[instagram-feed feed=1]");

  $output .= "</div>
      </div>
    </div>
  </section>";

  return $output;
}

add_shortcode('recently_viewed_products', 'nadobranich_recently_viewed_products');
function nadobranich_recently_viewed_products()
{

  if (empty($_COOKIE['woocommerce_recently_viewed_2'])) {
    $viewed_products = array();
  } else {
    $viewed_products = (array) explode('|', $_COOKIE['woocommerce_recently_viewed_2']);
  }

  if (empty($viewed_products)) {
    return;
  }

  $viewed_products = array_reverse(array_map('absint', $viewed_products));

  ?>
  <section class="related products container single-category swiper-container">
    <div class="single-category__title-wrap">
      <h3 class="single-category__title">Переглянуті товари</h3>
      <div class="single-category__navigation">
        <div class="swiper-button-next"> <svg class="single-category__navigation-icon-next" width="30" height="30">
            <use href="<?php bloginfo(
              "template_url",
            ); ?>/assets/images/icons.svg#arrowR-s"></use>
          </svg> </div>
        <div class="swiper-button-prev" style="opacity: 0.5;"> <svg class="single-category__navigation-icon-prev"
            width="30" height="30">
            <use href="<?php bloginfo(
              "template_url",
            ); ?>/assets/images/icons.svg#arrowL-s"></use>
          </svg> </div>
      </div>
    </div>
    <ul class="single-category__list swiper-wrapper">
      <?php
      foreach ($viewed_products as $viewed_product) {
        setup_postdata($GLOBALS['post'] =& $viewed_product); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
    
        wc_get_template_part('content', 'product');
      }
      ?>
    </ul>
  </section>
  <?php
}

add_shortcode('modal_markup', 'modal_markup');
function modal_markup()
{
  $template_url = get_template_directory_uri();
  $markup = '
  <div class="modal">
    <div class="modal__dialog">
      <div class="modal__content">
        <button class="modal__dialog-close" type="button">
          <svg class="modal__dialog-close-icon" width="15" height="15">
            <use href="' . $template_url . '/assets/images/icons.svg#close"></use>
          </svg>
        </button>
        <div class="modal__body">
          <div class="modal__images">
            <div class="modal__images-main-wrap swiper-container gallery-top js-modal-main-img">
              <div class="modal-gallery-nav swiper-button-next">
                <svg width="15" height="30">
                  <use href="' . $template_url . '/assets/images/icons.svg#gallery-arrow-next"></use>
                </svg>
              </div>
              <div class="modal-gallery-nav swiper-button-prev">
                <svg width="15" height="30">
                  <use href="' . $template_url . '/assets/images/icons.svg#gallery-arrow-prev"></use>
                </svg>
              </div>
              <div class="swiper-wrapper">
                <div class="modal__images-main swiper-slide">
                  <a href="#"><img src="#" alt="#"></a>
                </div>
              </div>
            </div>
            <div class="modal__images-list-wrap swiper-container gallery-thumbs">
              <ul class="modal__images-list js-modal-gallery swiper-wrapper">
                <li class="modal__images-item swiper-slide"><a href="#"><img src="#" alt="#"></a></li>
              </ul>
            </div>
          </div>
          <div class="modal__body-desc">
            <div class="modal__body-header">
              <h5 class="modal__body-title"> </h5>
              <p class="modal__body-composition"> </p>
            </div>
            <div>
              <div class="body-price-wrap">
                <p class="body-price js-modal-price">###</p>
              </div>
              <div class="modal__body-rating">
                <div class="rating-pack">
                  <img src="' . $template_url . '/assets/images/rating-stars-nbg" alt="rating">
                  <div class="js-modal-rating">
                  </div>
                </div>
                <a class="modal__body-rating-link" href="#">25</a>
              </div>
            </div>
            <div class="modal__body-color-wrap">
              <p class="modal__body-color">
                Колір:<span class="modal__body-item-color js-modal-color">###</span>
              </p>
              <div class="modal__body-color-picker js-modal-color-list">
                <a class="modal__body-color-item active" href="#"></a>
              </div>
            </div>
            <div class="modal__body-size-wrap">
              <div>
                <p class="modal__body-size">
                  Розмір:<span class="modal__body-item-size js-modal-size">###</span>
                </p>
                <div class="modal__body-size-picker js-modal-size-list">
                  <button class="modal__body-size-btn active" type="button"> </button>
                </div>
              </div>
            </div>
            <div class="modal__body-actions-wrap">
              <button class="js-add-to-cart modal__body-actions-add" type="button">
                Додати до кошика<span class="loader visually-hidden js-modal-loader"></span>
              </button>
              <a class="modal__body-actions-item-page js-to-item-page" href="/bedding/item.html">На сторінку
                товару</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>';

  return $markup;
}

add_shortcode('modalToCart_markup', 'modalToCart_markup');
function modalToCart_markup()
{
  $checkout = wc_get_checkout_url();
  $cart = wc_get_cart_url();
  $template_url = get_template_directory_uri();
  $markup = '
    <div class="animate__animated js-to-cart-modal to-cart__wrap visually-hidden">
    <div class="to-cart__content">
      <button class="js-to-cart-close-btn to-cart__close-btn">
        <svg width="15" height="15">
          <use href="' . $template_url . '/assets/images/icons.svg#close"></use>
        </svg>
      </button>
      <h6 class="to-cart__content-title">Товар додано до кошика!</h6>
      <div class="to-cart__added-goods">
        <img class="to-cart__added-goods-img js-to-cart-modal-img" width="100" height="95" src="#" alt="" />
        <div class="to-cart__added-goods-text">
          <p class="to-cart__added-goods-title js-to-cart-modal-title">*</p>
          <p class="js-to-cart-modal-variation">* / *</p>
          <p class="js-to-cart-modal-qty">Кількість: * шт.</p>
        </div>
      </div>
      <div class="to-cart__nav">
        <a class="to-cart__nav-link" href="' . $checkout . '">Купити</a>
        <a class="to-cart__nav-link" href="' . $cart . '">Кошик</a>
      </div>
    </div>
  </div>';
  return $markup;
}
add_shortcode('modalAuth_markup', 'modalAuth_markup');
function modalAuth_markup()
{
  $template_url = get_template_directory_uri();
  $markup = '
    <div class="auth-modal__container visually-hidden">
    <div class="auth-modal__content">
      <button class="auth-modal__close-btn js-auth-close-btn">
        <svg width="15" height="15">
          <use href="' . $template_url . '/assets/images/icons.svg#close"></use>
        </svg>
      </button>
      <div class="auth-modal__content-left">
        <img class="auth-modal__img" src="' . $template_url . '/assets/images/auth-img.jpg"
              alt="Google Auth Icon">
      </div>
      <div class="auth-modal__content-right">
        <div class="auth-modal__login visually-hidden">
          <div class="auth-modal__top-wrap">
            <div class="auth-modal__top">
              <svg class="auth-modal__icon" width="26" height="26">
                <use href="' . $template_url . '/assets/images/icons.svg#user"></use>
              </svg>
            </div>
            <p class="auth-modal__title">Вхід до акаунту</p>
          </div>
          <a class="auth-modal__social-auth-link" href="' . site_url('') . '/wp-login.php?loginSocial=google" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600">
            <img class="auth-modal__social-auth-icon" src="' . $template_url . '/assets/images/gicon.png"
              alt="Google Auth Icon">
            <div class="auth-modal__social-auth">
            Google
            </div>
          </a>
          <span class="auth-modal__span-text">Або:</span>
          <form method="post" action="' . site_url('') . '/wp-login.php">
            <div class="auth-modal__form-input-wrap">
              <input class="auth-modal__form-input" type="text" name="log" id="user_login" placeholder="&#32;" required>
              <label class="auth-modal__form-label" for="log">Електронна пошта</label>
            </div>
            <p class="invalid-input-message visually-hidden email">Це поле є обов’язковим</p>
            <div class="auth-modal__form-input-wrap">
              <input class="auth-modal__form-input" type="password" name="pwd" id="user_pass" placeholder="&#32;"
                required>
              <label class="auth-modal__form-label" for="pwd">Пароль</label>
            </div>
            <p class="invalid-input-message visually-hidden password">Це поле є обов’язковим</p>
            <div class="auth-modal__form-link">
              <a href="#">Забули пароль?</a>
            </div>
            <div class="auth-modal__form-input-wrap">
              <input class="auth-modal__form-submit" type="submit" value="Увійти">
              <p class="invalid-input-message visually-hidden req-error">Користувач з такою електронною поштою не існує або пароль вказано невірно</p>
            </div>
          </form>
          <div class="auth-modal__bottom">
            <div class="auth-modal__bottom-item-wrap">
              <p class="auth-modal__bottom-item-text">Немає акаунту?</p>
              <a class="auth-modal__bottom-item-link" data-type="register" href="#">Зареєструватися</a>
            </div>
          </div>
        </div>

        <div class="auth-modal__register visually-hidden">
          <div class="auth-modal__top-wrap">
            <div class="auth-modal__top">
              <svg class="auth-modal__icon" width="36" height="26">
                <use href="' . $template_url . '/assets/images/icons.svg#user-reg"></use>
              </svg>
            </div>
            <p class="auth-modal__title">Реєстрація</p>
          </div>
          <a class="auth-modal__social-auth-link" href="' . site_url('') . '/wp-login.php?loginSocial=google" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600">
            <img class="auth-modal__social-auth-icon" src="' . $template_url . '/assets/images/gicon.png"
              alt="Google Auth Icon">
            <div class="auth-modal__social-auth">
            Google
            </div>
          </a>
          <span class="auth-modal__span-text">Або:</span>
          <form method="post" action="' . site_url('') . '/wp-login.php?action=register">
            <div class="auth-modal__form-input-wrap">
              <input class="auth-modal__form-input" type="text" name="billing_first_name" id="user_name" placeholder="&#32;" required>
              <label class="auth-modal__form-label" for="billing_first_name">Ім\'я</label>
            </div>
            <p class="invalid-input-message visually-hidden reg-first-name">Це поле є обов’язковим</p>
            <div class="auth-modal__form-input-wrap">
              <input class="auth-modal__form-input" type="text" name="billing_last_name" id="user_last_name" placeholder="&#32;" required>
              <label class="auth-modal__form-label" for="billing_last_name">Прізвище</label>
            </div>
            <p class="invalid-input-message visually-hidden reg-last-name">Це поле є обов’язковим</p>
            <div class="auth-modal__form-input-wrap">
              <input class="auth-modal__form-input" type="text" name="user_email" id="user_email" placeholder="&#32;" required>
              <label class="auth-modal__form-label" for="user_email">Електронна пошта</label>
            </div>
            <p class="invalid-input-message visually-hidden reg-email">Це поле є обов’язковим</p>
            <div class="auth-modal__form-input-wrap">
              <input class="auth-modal__form-input" type="password" name="billing_user_password" id="user_password" placeholder="&#32;"
                required>
              <label class="auth-modal__form-label" for="billing_user_password">Пароль</label>
            </div>
            <p class="invalid-input-message visually-hidden reg-password">Це поле є обов’язковим</p>
            <div class="auth-modal__form-input-wrap">
              <input class="auth-modal__form-submit" type="submit" value="Зареєструватися">
              <input type="hidden" name="user_login" id="user_login_reg">
              <input type="hidden" name="redirect_to" value="">
              <p class="invalid-input-message visually-hidden reg-req-error">Дякуємо за реєстрацію!</p>
            </div>
          </form>
          <div class="auth-modal__bottom">
            <div class="auth-modal__bottom-item-wrap">
              <p class="auth-modal__bottom-item-text">Маєте акаунт?</p>
              <a class="auth-modal__bottom-item-link" href="#" data-type="login">Увійти</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>';
  return $markup;
}