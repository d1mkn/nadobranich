<?php
session_start();
session_unset();
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header>
    <div class="container header__container">
      <button class="mobile-menu-btn" type="button" aria-label="Кнопка мобільного меню">
        <svg class="mobile-menu-icon" width="25" height="20">
          <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#mobile-menu"></use>
        </svg>
      </button>
      <nav>
        <ul class="navigation__list">
          <li class="navigation__item">
            <button class="navigation__item-button" aria-label="Кнопка каталогу">Каталог</button>
            <div class="navigation__dropdown-wrap">
              <ul class="navigation__dropdown">
                <?php
                $args = array(
                  'taxonomy' => 'product_cat',
                  'hide_empty' => false,
                );

                $categories = get_terms($args);

                foreach ($categories as $category) {
                  $category_id = $category->term_id;
                  $category_name = $category->name;

                  if ($category_name === 'Uncategorized') {
                    continue;
                  }

                  $category_link = get_term_link($category_id, 'product_cat');

                  ?>
                  <li class="navigation__dropdown-item">
                    <a href=<?php echo $category_link ?>><?php echo $category_name ?></a>
                  </li>
                  <?php
                }
                ?>
              </ul>
            </div>
          <li class="navigation__item">
            <button class="navigation__item-button" aria-label="Кнопка інформації">Інформація</button>
            <div class="navigation__dropdown-wrap">
              <ul class="navigation__dropdown">
                <li class="navigation__dropdown-item">
                  <a href="<?php echo site_url('') ?>/faq">Популярні питання</a>
                </li>
                <li class="navigation__dropdown-item">
                  <a href="<?php echo site_url('') ?>/about-fabrics">Тканини</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <div class="logo-wrap">
        <a href="<?php echo site_url('') ?>" aria-label="Посилання на головну сторінку">
          <svg class="header__logo" width="188" height="50">
            <use href='<?php bloginfo('template_url') ?>/assets/images/icons.svg#logo'></use>
          </svg>
        </a>
      </div>

      <div class="header__controls">
        <ul class="header__controls-list">
          <li class="header__controls-item search">
            <button class="js-search-btn" aria-label="Кнопка пошуку на сайті">
              <svg class="header__controls-item-icon" width="24" height="24">
                <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#search"></use>
              </svg>
            </button>
          </li>
          <li class="header__controls-item cart">
            <a class="cart-link" href="<?php echo wc_get_cart_url() ?>" aria-label="Посилання на кошик">
              <svg class="header__controls-item-icon" width="24" height="70">
                <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#cart"></use>
              </svg>
              <?php if (WC()->cart->get_cart_contents_count() > 0): ?>
                <span class="cart-counter js-cart-counter">
                  <?php echo WC()->cart->get_cart_contents_count(); ?>
                </span>
              <?php else: ?>
                <span class="js-cart-counter"></span>
              <?php endif ?>
            </a>
          </li>
          <li class="header__controls-item user">
            <button aria-label="Кнопка особистого кабінету">
              <svg class="header__controls-item-icon" width="24" height="24">
                <use href="<?php bloginfo('template_url') ?>/assets/images/icons.svg#user"></use>
              </svg>
            </button>
            <div class="user-menu navigation__dropdown-wrap">
              <ul class="navigation__dropdown">
                <?php
                if (is_user_logged_in()) { ?>
                  <li class="navigation__dropdown-item">
                    <a href="<?php echo wc_get_account_endpoint_url('dashboard') ?>">Особистий кабінет</a>
                  </li>
                  <li class="navigation__dropdown-item">
                    <a class="js-logout" href="<?php echo wp_logout_url() ?>">Вихід</a>
                  </li>
                <?php } else { ?>
                  <li class="navigation__dropdown-item">
                    <a href="#" data-type="login">Вхід</a>
                  </li>
                  <li class="navigation__dropdown-item">
                    <a href="#" data-type="register">Реєстрація</a>
                  </li>
                <?php }
                ?>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <div class="search__form js-search-form animate__animated animate__faster visually-hidden">
        <?php echo do_shortcode('[fibosearch]'); ?>
      </div>
    </div>
  </header>

  <div class="backdrop visually-hidden"></div>

  <div class="mobile-menu__container">
    <div class="mobile-menu__content">
      <div class="mobile-menu__content-wrap">
        <div class="container">
          <div class="mobile-search">
            <?php echo do_shortcode('[fibosearch]'); ?>
          </div>
          <nav class="mobile-menu__nav">
            <ul class="mobile-menu__list">
              <li>
                <p class="mobile-menu__title">Каталог</p>
                <div class="mobile-menu__items-wrap">
                  <ul class="mobile-menu__items">
                    <?php
                    $args = array(
                      'taxonomy' => 'product_cat',
                      'hide_empty' => false,
                    );

                    $categories = get_terms($args);

                    foreach ($categories as $category) {
                      $category_id = $category->term_id;
                      $category_name = $category->name;

                      if ($category_name === 'Uncategorized') {
                        continue;
                      }
                      $category_link = get_term_link($category_id, 'product_cat');
                      ?>
                      <li>
                        <a class="mobile-menu__item" href=<?php echo $category_link ?>><?php echo $category_name ?></a>
                      </li>
                      <?php
                    }
                    ?>
                  </ul>
                </div>
              </li>
              <li>
                <p class="mobile-menu__title">Інформація</p>
                <div class="mobile-menu__items-wrap">
                  <ul class="mobile-menu__items">
                    <li>
                      <a class="mobile-menu__item" href="<?php echo site_url('') ?>/faq">Популярні питання</a>
                    </li>
                    <li>
                      <a class="mobile-menu__item" href="<?php echo site_url('') ?>/about-fabrics">Тканини</a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </nav>
          <div class="mobile-menu__contacts">
            <p class="mobile-menu__title">Контакти</p>
            <ul class="mobile-menu__items-wrap">
              <li><a class="mobile-menu__item" href="tel:+380983363028">(098) 33-63-028</a></li>
              <li><a class="mobile-menu__item" href="mailto:rendez-vous-elite@ukr.net">rendez-vous-elite@ukr.net
                </a></li>
            </ul>
          </div>
          <div class="mobile-menu__login">
            <?php
            if (is_user_logged_in()) { ?>
              <a href="<?php echo wc_get_account_endpoint_url('dashboard') ?>">Особистий кабінет</a>
            <?php } else { ?>
              <a href="#" data-type="login">Вхід / Реєстрація</a>
            <?php }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>