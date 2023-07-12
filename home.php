<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>



<div class="animate__animated js-to-cart-modal to-cart__wrap visually-hidden">
  <div class="to-cart__content">
    <button class="js-to-cart-close-btn to-cart__close-btn">
      <svg width="15" height="15">
        <use href="<?php bloginfo(
          "template_url",
        ); ?>/assets/images/icons.svg#close"></use>
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
      <a class="to-cart__nav-link" href="<?php echo wc_get_checkout_url() ?>">Купити</a>
      <a class="to-cart__nav-link" href="<?php echo wc_get_cart_url() ?>">Кошик</a>
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
          <svg class="single-category__navigation-icon-next" width="30" height="30">
            <use href="<?php bloginfo(
              "template_url",
            ); ?>/assets/images/icons.svg#arrowR-s"></use>
          </svg>
        </div>
        <div class="swiper-button-prev">
          <svg class="single-category__navigation-icon-prev" width="30" height="30">
            <use href="<?php bloginfo(
              "template_url",
            ); ?>/assets/images/icons.svg#arrowL-s"></use>
          </svg>
        </div>
      </div>
      <ul class="categories__list swiper-wrapper">
        <?php
        $args = [
          "taxonomy" => "product_cat",
          // вказуємо таксономію товарних категорій
          "hide_empty" => false, // показуємо всі категорії, включаючи порожні
        ];

        $categories = get_terms($args); // список категорій товарів
        
        foreach ($categories as $category) {
          $category_id = $category->term_id;
          $category_name = $category->name;

          if ($category_name === "Uncategorized") {
            continue; // пропускаємо ітерацію циклу та переходимо до наступної категорії
          }

          $category_link = get_term_link($category_id, "product_cat"); // посилання на сторінку категорії товарів
          $thumbnail_id = get_term_meta(
            $category_id,
            "thumbnail_id",
            true,
          ); // ID зображення категорії
          $category_image = "";

          if ($thumbnail_id) {
            $image_data = wp_get_attachment_image_src(
              $thumbnail_id,
              "full",
            ); // дані зображення
            if ($image_data) {
              $category_image = $image_data[0]; // посилання на зображення
            }
          }

          echo '<li class="category__item swiper-slide">';
          echo '<a class="category__item-link" href="' .
            $category_link .
            '">';
          echo '<div class="category__item-img-wrap">';
          echo '<img class="category__item-img" src="' .
            $category_image .
            '" alt="' .
            $category_name .
            '"/>';
          echo "</div>";
          echo '<h3 class="category__item-desc">' .
            $category_name .
            "</h3>";
          echo "</a>";
          echo "</li>";
        }
        ?>
      </ul>
    </div>
  </section>

  <?php

  $args = [
    "taxonomy" => "product_cat",
    "hide_empty" => true,
  ];
  $i = 0;

  $categories = get_terms($args);

  foreach ($categories as $category) {
    $category_name = $category->name;
    $category_link = get_category_link($category->term_id);

    $args = [
      "post_type" => "product",
      "posts_per_page" => -1,
      "tax_query" => [
        [
          "taxonomy" => "product_cat",
          "field" => "term_id",
          "terms" => $category->term_id,
        ],
      ],
      'meta_query' => [
        [
          'key' => '_stock_status',
          'value' => 'instock',
          // Only include products in stock
        ],
        [
          'key' => '_price',
          'value' => '',
          'compare' => '!=' // Exclude products without a price
        ],
      ],
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
      ?>
      <section class="container single-category swiper-container">
        <div class="single-category__title-wrap">
          <h3 class="single-category__title">
            <?php echo $category_name ?>
          </h3>
          <a href="<?php echo $category_link ?>">
            <svg width="20" height="18">
              <use href="<?php bloginfo("template_url") ?>/assets/images/icons.svg#to-category"></use>
            </svg>
          </a>
          <div class="single-category__navigation">
            <div class="swiper-button-next">
              <svg class="single-category__navigation-icon-next" width="30" height="30">
                <use href="<?php bloginfo("template_url") ?>/assets/images/icons.svg#arrowR-s"></use>
              </svg>
            </div>
            <div class="swiper-button-prev">
              <svg class="single-category__navigation-icon-prev" width="30" height="30">
                <use href="<?php bloginfo("template_url") ?>/assets/images/icons.svg#arrowL-s"></use>
              </svg>
            </div>
          </div>
        </div>
        <ul class="single-category__list swiper-wrapper">
          <?php while ($query->have_posts()) {
            $query->the_post();
            global $product;

            // Дані для ренедру та мобального вікна
            $is_on_sale = $product->is_on_sale();
            $attributes = $product->get_attributes();
            $productId = $product->get_id();
            $productTitle = get_the_title();
            $productPrice = $product->price;
            $productBeforeSalePrice = $product->regular_price;
            $productDesc = $product->description;
            $productShortDesc = $product->get_short_description();
            $productImagesIds = $product->get_gallery_image_ids();
            $mainImageId = get_post_thumbnail_id($productId);
            $mainImageAlt = get_post_meta($mainImageId, '_wp_attachment_image_alt', true);
            $productImages = array(
              'mainImg' => array(
                'url' => wp_get_attachment_url(get_post_thumbnail_id($productId)),
                'alt' => $mainImageAlt
              ),
              'gallery' => [],
            );
            $productAttributes = array();
            $productRating = array(
              'average' => $product->average_rating,
              'reviewCount' => $product->review_count
            );

            //Атрибути
            foreach ($attributes as $attribute) {
              $attributeName = $attribute->get_name();
              $options = $attribute->get_options();

              if ($attributeName === 'pa_color') {
                $options = get_the_terms($product->id, 'pa_color');
              }

              if ($attributeName === 'pa_size') {
                $options = get_the_terms($product->id, 'pa_size');
              }

              $productAttributes[] = array(
                $attributeName => $options
              );
            }

            // Варіації Колір/Розмір + ціна
            $productVariations = get_children(
              array(
                'post_parent' => $productId,
                'post_type' => 'product_variation',
              )
            );

            $variations = array();

            foreach ($productVariations as $variation) {
              $variationDesc = $variation->post_excerpt;
              $variationId = $variation->ID;
              $variation = wc_get_product($variationId);
              $variationPrice = $variation->get_price();

              $variations[] = array(
                'variationId' => $variationId,
                'variationDesc' => $variationDesc,
                'variationPrice' => $variationPrice,
              );
            }

            // Посилання на зображення
            foreach ($productImagesIds as $image_id) {
              $image_url = wp_get_attachment_url($image_id);
              $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

              $productImages['gallery'][] = array(
                'url' => $image_url,
                'alt' => $image_alt
              );
            }

            $_SESSION['aboutProducts'][] = array(
              'id' => $productId,
              'category' => $category_name,
              'productTitle' => $productTitle,
              'productDesc' => $productShortDesc,
              'productLink' => get_permalink(),
              'productImages' => $productImages,
              'price' => $productPrice,
              'beforeSalePrice' => $productBeforeSalePrice,
              'attributes' => $productAttributes,
              'variations' => $variations,
              'rating' => $productRating
            );
            ?>
            <li class="single-category__item swiper-slide" productid=<?php echo $productId ?>>
              <?php
              // Якщо товар акціний, то буде плашка
              if ($is_on_sale): ?>
                <div class="single-category__sale-item">
                  <p>Aкція</p>
                </div>
                <div class="single-category__item-link">
                  <?php
                // Якщо не акціний, то буде звичайна картка
              else: ?>
                  <div class="single-category__item-link">
                  <?php endif; ?>
                  <div class="js-quick-view single-category__item-overlay">
                    <p class="single-category__item-overlay-text">Швидкий перегляд</p>
                    <p class="single-category__item-overlay-text-tab">+</p>
                  </div>
                  <div class="single-category__item-about">
                    <a href="<?php echo get_permalink() ?>">
                      <div class="single-category__item-img">
                        <?php echo get_the_post_thumbnail() ?>
                      </div>
                    </a>
                    <h4 class="single-category__item-title">
                      <?php echo $productTitle ?>
                    </h4>
                    <p class="single-category__item-desc">
                      <?php echo $productShortDesc ?>
                    </p>

                    <?php
                    // Якщо товар акціний, то буде стара та нова ціна
                    if ($is_on_sale): ?>
                      <span class="old-price single-category__item-price">Від <span class="item-price">
                          <?php echo $productBeforeSalePrice ?> грн
                        </span><span class="item-new-price">
                          <?php echo $productPrice ?> грн
                        </span></span>

                      <?php
                      // Якщо товар не акціний, то буде звичайна мінімальна ціна
                    else: ?>
                      <span class="single-category__item-price">Від
                        <?php echo $productPrice ?> грн
                      </span>
                    <?php endif; ?>
                    <?php
                    // Якщо атрибути є, шукаємо атрибут "Color"
                    if ($productAttributes) {
                      foreach ($attributes as $attribute) {
                        $attributeName = $attribute->get_name();
                        if ($attributeName === 'pa_color') {
                          $terms = get_the_terms($product->id, 'pa_color');
                          ?>
                          <div class="modal__body-color-picker">
                            <?php
                            // Підставляємо значення кольору як bg для кружечків
                            foreach ($terms as $term) {
                              $color = $term->slug; ?>
                              <a class="modal__body-color-item" href="<?php echo get_permalink() ?>"
                                style="background-color: <?php echo $color ?>;">
                              </a>
                            <?php } ?>
                          </div>
                        <?php }
                      }
                    } ?>
                  </div>
                </div>
            </li>
          <?php } ?>
        </ul>
      </section>

      <?php
      //Рекламна секція після 2 сладера
      $i += 1;
      if ($i === 2) { ?>
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
            <a class="self-promotion__link" href="#catalog">Обрати категорію</a>
          </div>
        </section>
      <?php } ?>

      <?php wp_reset_postdata();
    }
  }
  ?>

  <script>
    const aboutProducts = <?php echo json_encode($_SESSION['aboutProducts']); ?>;
    localStorage.setItem('aboutProducts', JSON.stringify(aboutProducts));
  </script>

  <div class="animate__animated animate__faster modal-backdrop visually-hidden">
    <div class="modal">
      <div class="modal__dialog">
        <div class="modal__content">
          <button class="modal__dialog-close" type="button">
            <svg class="modal__dialog-close-icon" width="15" height="15">
              <use href="<?php bloginfo(
                "template_url",
              ); ?>/assets/images/icons.svg#close"></use>
            </svg>
          </button>
          <div class="modal__body">
            <div class="modal__images">
              <div class="modal__images-main-wrap">
              </div>
              <div class="modal__images-list-wrap">
                <ul class="modal__images-list js-modal-gallery">
                  <li class="modal__images-item"><a href="#"><img src="#" alt="#"></a></li>
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
                    <img src="<?php bloginfo(
                      "template_url",
                    ); ?>/assets/images/rating-stars-nbg" alt="rating">
                    <div class='js-modal-rating'>
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
    </div>
  </div>
</main>

<?php echo do_shortcode('[insta_block]') ?>

<?php get_footer();