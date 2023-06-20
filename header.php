<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
  <div class="container header__container">
    <button class="mobile-menu-btn" type="button">
      <svg class="mobile-menu-icon" width="25" height="20">
        <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#mobile-menu"></use>
      </svg>
    </button>
    <nav>
      <ul class="navigation__list">
        <li class="navigation__item">
          <button class="navigation__item-button">Каталог</button>
          <div class="navigation__dropdown-wrap">
            <ul class="navigation__dropdown">
              <li class="navigation__dropdown-item">
                <a href="#">Постільна білизна</a>
              </li>
              <li class="navigation__dropdown-item"><a href="#">Пледи</a></li>
              <li class="navigation__dropdown-item"><a href="#">Рушники</a></li>
              <li class="navigation__dropdown-item">
                <a href="#">Покривала</a>
              </li>
              <li class="navigation__dropdown-item">
                <a href="#">Акційні товари</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="navigation__item">
          <button class="navigation__item-button">Інформація</button>
          <div class="navigation__dropdown-wrap">
            <ul class="navigation__dropdown">
              <li class="navigation__dropdown-item">
                <a href="./faq.html">Популярні питання</a>
              </li>
              <li class="navigation__dropdown-item">
                <a href="#">Контакти</a>
              </li>
              <li class="navigation__dropdown-item"><a href="#">Про нас</a></li>
              <li class="navigation__dropdown-item">
                <a href="./fabrics.html">Тканини</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
    <div class="logo-wrap">
      <a href=".">
        <svg class="header__logo" width="188" height="50">
          <use href='<?php bloginfo('template_url')?>/assets/images/icons.svg#logo' ></use>
        </svg>
      </a>
    </div>

    <div class="header__controls">
      <ul class="header__controls-list">
        <li class="header__controls-item search">
          <button class="js-search-btn">
            <svg class="header__controls-item-icon" width="24" height="24">
              <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#search"></use>
            </svg>
          </button>
          <form
            class="search__form js-search-form animate__animated animate__faster visually-hidden"
          >
            <button class="search__submit-btn" type="submit">
              <svg width="24" height="24">
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#search"></use>
              </svg>
            </button>
            <input
              class="search__form-input"
              type="search"
              placeholder="Пошук по сайту"
              aria-label="Пошук по сайту"
            />
          </form>
        </li>
        <li class="header__controls-item cart">
          <a class="cart-link" href="./cart.html">
            <svg class="header__controls-item-icon" width="24" height="70">
              <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#cart"></use>
            </svg>
          </a>
        </li>
        <li class="header__controls-item user">
          <button>
            <svg class="header__controls-item-icon" width="24" height="24">
              <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#user"></use>
            </svg>
          </button>
          <div class="user-menu navigation__dropdown-wrap">
            <ul class="navigation__dropdown">
              <li class="navigation__dropdown-item">
                <a href="#">Вхід</a>
              </li>
              <li class="navigation__dropdown-item">
                <a href="#">Реєстрація</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <div class="mobile-menu__container">
    <div class="mobile-menu__content">
      <div class="mobile-menu__content-wrap">
        <div class="container">
          <button class="mobile-menu__close-btn">
            <svg width="24" height="70">
              <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#close"></use>
            </svg>
          </button>
          <nav class="mobile-menu__nav">
            <ul class="mobile-menu__list">
              <li>
                <p class="mobile-menu__title">Каталог</p>
                <div class="mobile-menu__items-wrap">
                  <ul>
                    <li>
                      <a class="mobile-menu__item" href="#">Постільна білизна</a>
                    </li>
                    <li>
                      <a class="mobile-menu__item" href="#">Пледи</a>
                    </li>
                    <li>
                      <a class="mobile-menu__item" href="#">Рушники</a>
                    </li>
                    <li>
                      <a class="mobile-menu__item" href="#">Покривала</a>
                    </li>
                    <li>
                      <a class="mobile-menu__item" href="#">Акційні товари</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <p class="mobile-menu__title">Інформація</p>
                <div class="mobile-menu__items-wrap">
                  <ul>
                    <li>
                      <a class="mobile-menu__item" href="#"
                        >Популярні питання</a
                      >
                    </li>
                    <li>
                      <a class="mobile-menu__item" href="#">Контакти</a>
                    </li>
                    <li>
                      <a class="mobile-menu__item" href="#">Про нас</a>
                    </li>
                    <li>
                      <a class="mobile-menu__item" href="#"
                        >Тканини</a
                      >
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
</header>


