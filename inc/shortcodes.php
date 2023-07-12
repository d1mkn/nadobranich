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
      <h3 class="single-category__title">Переглянуті товар</h3>
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