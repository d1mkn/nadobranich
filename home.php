<?php 
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

	<div class="backdrop visually-hidden"></div>
    <div
      class="animate__animated js-to-cart-modal to-cart__wrap visually-hidden"
    >
      <div class="to-cart__content">
        <button class="js-to-cart-close-btn to-cart__close-btn">
          <svg width="15" height="15">
            <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#close"></use>
          </svg>
        </button>
        <h6 class="to-cart__content-title">Товар додано до кошика!</h6>
        <div class="to-cart__added-goods">
          <img
            class="to-cart__added-goods-img"
            src="https://placehold.co/100x95"
            alt=""
          />
          <div class="to-cart__added-goods-text">
            <p class="to-cart__added-goods-title">Комплект шовкових подушок</p>
            <p>Жовтий / Середній</p>
            <p>Кількість: 5 шт.</p>
          </div>
        </div>
        <div class="to-cart__nav">
          <a class="to-cart__nav-link" href="/bedding/ordering.html">Купити</a>
          <a class="to-cart__nav-link" href="/bedding/cart.html">Кошик</a>
        </div>
      </div>
    </div>
    <main>
      <section class="hero">
        <div class="hero__overlay">
          <div class="hero__content-wrap">
            <h1 class="hero__title">Ласкаво просимо до "На добраніч"</h1>
            <p class="hero__subtitle">Ідеального магазину постільної білизни</p>
            <div class="hero__button-wrap">
              <a class="hero__button" href="#catalog">Каталог</a>
            </div>
          </div>
        </div>
      </section>
      <section class="categories">
        <div class="categories-wrap container swiper-container">
          <h2 id="catalog" class="categories__title">Обирай за категоріями</h2>
          <div class="single-category__navigation" style="display: none">
            <div class="swiper-button-next">
              <svg
                class="single-category__navigation-icon-next"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowR-s"></use>
              </svg>
            </div>
            <div class="swiper-button-prev">
              <svg
                class="single-category__navigation-icon-prev"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowL-s"></use>
              </svg>
            </div>
          </div>
          <ul class="categories__list swiper-wrapper">
            <?php
                $args = array(
                    'taxonomy' => 'product_cat', // вказуємо таксономію товарних категорій
                    'hide_empty' => false, // показуємо всі категорії, включаючи порожні
                );

                $categories = get_terms($args); // список категорій товарів

                foreach ($categories as $category) {
                    $category_id = $category->term_id;
                    $category_name = $category->name;

                    if ($category_name === 'Uncategorized') {
                        continue; // пропускаємо ітерацію циклу та переходимо до наступної категорії
                    }

                    $category_link = get_term_link($category_id, 'product_cat'); // посилання на сторінку категорії товарів
                    $thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true); // ID зображення категорії
                    $category_image = '';

                    if ($thumbnail_id) {
                        $image_data = wp_get_attachment_image_src($thumbnail_id, 'full'); // дані зображення
                        if ($image_data) {
                            $category_image = $image_data[0]; // посилання на зображення
                        }
                    }

                    echo '<li class="category__item swiper-slide">';
                    echo '<a class="category__item-link" href="' . $category_link . '">';
                    echo '<div class="category__item-img-wrap">';
                    echo '<img class="category__item-img" src="' . $category_image . '" alt="' . $category_name . '"/>';
                    echo '</div>';
                    echo '<h3 class="category__item-desc">' . $category_name . '</h3>';
                    echo '</a>';
                    echo '</li>';
                }
            ?>
          </ul>
        </div>
      </section>
      <section class="container single-category swiper-container">
        <div class="single-category__title-wrap">
          <h3 class="single-category__title">Пледи</h3>
          <a href="/bedding/category.html">
            <svg width="20" height="18">
              <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#to-category"></use>
            </svg>
          </a>
          <div class="single-category__navigation">
            <div class="swiper-button-next">
              <svg
                class="single-category__navigation-icon-next"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowR-s"></use>
              </svg>
            </div>
            <div class="swiper-button-prev">
              <svg
                class="single-category__navigation-icon-prev"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowL-s"></use>
              </svg>
            </div>
          </div>
        </div>
        <ul class="single-category__list swiper-wrapper">
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
        </ul>
      </section>
      <section class="container single-category swiper-container">
        <div class="single-category__title-wrap">
          <h3 class="single-category__title">Пледи</h3>
          <a href="/bedding/category.html">
            <svg width="20" height="18">
              <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#to-category"></use>
            </svg>
          </a>
          <div class="single-category__navigation">
            <div class="swiper-button-next">
              <svg
                class="single-category__navigation-icon-next"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowR-s"></use>
              </svg>
            </div>
            <div class="swiper-button-prev">
              <svg
                class="single-category__navigation-icon-prev"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowL-s"></use>
              </svg>
            </div>
          </div>
        </div>
        <ul class="single-category__list swiper-wrapper">
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
        </ul>
      </section>
      <section class="best-seller">
        <div class="best-seller-wrap container">
          <img
            class="best-seller__img"
            src="<?php bloginfo('template_url')?>/assets/images/best-seller-sample.0db1dc5c.png"
            alt="best seller sample"
          />
          <div class="best-seller__about">
            <div class="best-seller-main">
              <h3 class="best-seller-section__title">Бестселлер сезону</h3>
              <h4 class="best-seller__title">Подушка Blue Sky</h4>
              <span class="best-seller__price">Від 440 грн</span>
            </div>
            <div class="best-seller__raiting">
              <div class="best-seller__raiting-stars">
                <svg width="30" height="30">
                  <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                </svg>
                <svg width="30" height="30">
                  <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                </svg>
                <svg width="30" height="30">
                  <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                </svg>
                <svg width="30" height="30">
                  <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                </svg>
                <svg width="30" height="30">
                  <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                </svg>
              </div>
              <a href="#">25</a>
            </div>
            <p class="best-seller__desc">
              Дихаюча подушка забезпечить гарний відпочинок і приємний сон.
              Завдяки властивостям матеріалу чохла повітря добре проникає
              всередину подушки для ефективного повітрообміну. <br />
              Також, матеріали подушки не створюють парникового ефекту, не
              дозволяючи волозі проникати всередину волокна.
            </p>
            <button class="best-seller__btn" type="button">
              Переглянути товар
            </button>
          </div>
        </div>
      </section>
      <section class="container single-category swiper-container">
        <div class="single-category__title-wrap">
          <h3 class="single-category__title">Пледи</h3>
          <a href="/bedding/category.html">
            <svg width="20" height="18">
              <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#to-category"></use>
            </svg>
          </a>
          <div class="single-category__navigation">
            <div class="swiper-button-next">
              <svg
                class="single-category__navigation-icon-next"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowR-s"></use>
              </svg>
            </div>
            <div class="swiper-button-prev">
              <svg
                class="single-category__navigation-icon-prev"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowL-s"></use>
              </svg>
            </div>
          </div>
        </div>
        <ul class="single-category__list swiper-wrapper">
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
        </ul>
      </section>
      <section class="container single-category swiper-container">
        <div class="single-category__title-wrap">
          <h3 class="single-category__title">Пледи</h3>
          <a href="/bedding/category.html">
            <svg width="20" height="18">
              <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#to-category"></use>
            </svg>
          </a>
          <div class="single-category__navigation">
            <div class="swiper-button-next">
              <svg
                class="single-category__navigation-icon-next"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowR-s"></use>
              </svg>
            </div>
            <div class="swiper-button-prev">
              <svg
                class="single-category__navigation-icon-prev"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowL-s"></use>
              </svg>
            </div>
          </div>
        </div>
        <ul class="single-category__list swiper-wrapper">
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
        </ul>
      </section>
      <section class="self-promotion">
        <div class="container">
          <div class="self-promotion__text">
            <p>
              Магазин «На добраніч» представляє сучасну колекцію домашнього
              текстилю. Елегантність та стиль у поєднанні із якістю. У нас ви
              можете придбати фірмову постільну білизну, банні халати і рушники,
              пледи, покривала, ковдри і подушки, кухонні рушники.
            </p>
            <p>
              В "На добраніч" ми віримо, що ваша спальня повинна бути місцем для
              відпочинку та релаксації, тому ми докладаємо зусиль, щоб
              забезпечити вам максимальний комфорт. Купуючи товар у нашому
              інтернет-магазині, можете бути впевнені в бездоганній якості
              продукції.
            </p>
          </div>
          <a class="self-promotion__link" href="#">Обрати категорію</a>
        </div>
      </section>
      <section class="container single-category swiper-container">
        <div class="single-category__title-wrap">
          <h3 class="single-category__title">Пледи</h3>
          <a href="/bedding/category.html">
            <svg width="20" height="18">
              <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#to-category"></use>
            </svg>
          </a>
          <div class="single-category__navigation">
            <div class="swiper-button-next">
              <svg
                class="single-category__navigation-icon-next"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowR-s"></use>
              </svg>
            </div>
            <div class="swiper-button-prev">
              <svg
                class="single-category__navigation-icon-prev"
                width="30"
                height="30"
              >
                <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#arrowL-s"></use>
              </svg>
            </div>
          </div>
        </div>
        <ul class="single-category__list swiper-wrapper">
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__sale-item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="old-price single-category__item-price"
                  >Від <span class="item-price">1600 грн</span
                  ><span class="item-new-price">999 грн</span>
                </span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
          <li class="single-category__item swiper-slide">
            <div class="single-category__item-link">
              <div class="js-quick-view single-category__item-overlay">
                <p class="single-category__item-overlay-text">
                  Швидкий перегляд
                </p>
                <p class="single-category__item-overlay-text-tab">+</p>
              </div>
              <div class="single-category__item-about">
                <a href="/bedding/item.html">
                  <div class="single-category__item-img"><img /></div>
                </a>
                <h4 class="single-category__item-title">Ковдра Soft Grid</h4>
                <p class="single-category__item-desc">
                  Зроблена з преміальної бавовни
                </p>
                <span class="single-category__item-price">Від 1600 грн</span>
              </div>
            </div>
            <div class="modal__body-color-picker">
              <a class="modal__body-color-item" href="#"></a>
              <a class="active modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
              <a class="modal__body-color-item" href="#"></a>
            </div>
          </li>
        </ul>
      </section>
      <section class="insta">
        <div class="container">
          <div class="insta__text">
            <div class="insta__text-wrap">
              <p class="insta__link-text">Долучайтесь до нас у інстаграмі</p>
              <a
                class="insta__link"
                target="_blank"
                href="https://www.instagram.com/na_dobranich_ua"
                >@na_dobranich_ua</a
              >
            </div>
          </div>
          <div class="insta__gallery">
            <ul class="insta__gallery-list">
              <li class="insta__gallery-item"></li>
              <li class="insta__gallery-item"></li>
              <li class="insta__gallery-item"></li>
              <li class="insta__gallery-item"></li>
            </ul>
          </div>
        </div>
      </section>
      <div
        class="animate__animated animate__faster modal-backdrop visually-hidden"
      >
        <div class="modal">
          <div class="modal__dialog">
            <div class="modal__content">
              <button class="modal__dialog-close" type="button">
                <svg class="modal__dialog-close-icon" width="15" height="15">
                  <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#close"></use>
                </svg>
              </button>
              <div class="modal__body">
                <div class="modal__images">
                  <div class="modal__images-main"></div>
                  <ul class="modal__images-list">
                    <li class="modal__images-item"></li>
                    <li class="modal__images-item"></li>
                    <li class="modal__images-item"></li>
                  </ul>
                </div>
                <div class="modal__body-desc">
                  <div class="modal__body-header">
                    <h5 class="modal__body-title">Комплект шовкових подушок</h5>
                    <p class="modal__body-composition">
                      2 подушки + 2 наволочки
                    </p>
                  </div>
                  <div>
                    <div class="modal__body-price-wrap">
                      <p class="modal__body-price">650 грн</p>
                    </div>
                    <div class="modal__body-raiting">
                      <div class="modal__body-raiting-stars">
                        <svg width="30" height="30">
                          <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                        </svg>
                        <svg width="30" height="30">
                          <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                        </svg>
                        <svg width="30" height="30">
                          <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                        </svg>
                        <svg width="30" height="30">
                          <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                        </svg>
                        <svg width="30" height="30">
                          <use href="<?php bloginfo('template_url')?>/assets/images/icons.svg#star"></use>
                        </svg>
                      </div>
                      <a href="#">25</a>
                    </div>
                  </div>
                  <div class="modal__body-color-wrap">
                    <p class="modal__body-color">
                      Колір: <span class="modal__body-item-color">###</span>
                    </p>
                    <div class="modal__body-color-picker">
                      <a class="modal__body-color-item" href="#"></a>
                      <a class="active modal__body-color-item" href="#"></a>
                      <a class="modal__body-color-item" href="#"></a>
                      <a class="modal__body-color-item" href="#"></a>
                    </div>
                  </div>
                  <div class="modal__body-size-wrap">
                    <div>
                      <p class="modal__body-size">
                        Розмір: <span class="modal__body-item-size">###</span>
                      </p>
                      <div class="modal__body-size-picker">
                        <button class="modal__body-size-btn" type="button">
                          Євро
                        </button>
                        <button class="modal__body-size-btn" type="button">
                          Двоспальний
                        </button>
                        <button class="modal__body-size-btn" type="button">
                          Полуторний
                        </button>
                      </div>
                      <button class="modal__body-size-info">
                        Розмірна сітка
                      </button>
                      <div class="modal__body-size-info-wrap">
                        <p class="modal__body-size-text">
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Neque, facere magni sed eius repudiandae ipsa
                          quasi nemo pariatur hic harum aperiam laboriosam
                          voluptas rem beatae doloremque perferendis
                          necessitatibus itaque aliquid. Lorem, ipsum dolor sit
                          amet consectetur adipisicing elit. Officia voluptatum
                          quam ipsa, dolor soluta suscipit dolorum eligendi
                          repudiandae voluptate voluptatem ipsum perferendis
                          quibusdam error quisquam! Optio asperiores possimus
                          voluptas consequuntur.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="modal__body-actions-wrap">
                    <button
                      class="js-add-to-cart modal__body-actions-add"
                      type="button"
                    >
                      Додати до кошика
                    </button>
                    <a
                      class="modal__body-actions-item-page"
                      href="/bedding/item.html"
                      >На сторінку товару</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php
get_footer();
