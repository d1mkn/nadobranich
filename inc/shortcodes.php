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