<footer>
  <div class="footer-wrap">
    <div class="container">
      <div class="footer__socials">
        <div class="footer__logo-wrap">
          <a href="<?php echo site_url('') ?>" aria-label="Посилання на головну сторінку">
            <svg class="footer__logo" width="188" height="50">
              <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#logo-footer"></use>
            </svg>
          </a>
          <div class="footer__socials_links">
            <a class="footer__socials_link" href="<?php the_field('instagram_link', '131') ?>"
              aria-label="Посилання на Інстаграм"><svg class="footer__socials_icon" width="22" height="23">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#insta"></use>
              </svg></a>
            <a class="footer__socials_link" href="<?php the_field('telegram_link', '131') ?>"
              aria-label="Посилання на Телеграм"><svg class="footer__socials_icon" width="22" height="21">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#tg"></use>
              </svg></a>
            <a class="footer__socials_link" href="<?php the_field('viber_link', '131') ?>"
              aria-label="Посилання на Вайбер"><svg class="footer__socials_icon" width="23" height="23">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#viber"></use>
              </svg></a>
          </div>
        </div>
      </div>
      <div class="footer__sections">
        <div class="footer__catalog js-footer-section-parent">
          <h3 class="footer__catalog-title js-footer-section">
            Каталог<span class="footer__section-arrow">
              <svg width="13" height="8">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#faq-arrow"></use>
              </svg></span>
          </h3>
          <ul class="footer__catalog-list js-footer-section-info">
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
                continue; //
              }
              $category_link = get_term_link($category_id, 'product_cat'); // посилання на сторінку категорії товарів
              ?>
              <li>
                <a class="footer__catalog-link" href=<?php echo $category_link ?>
                  aria-label="Посилання на сторінку категорії"><?php echo $category_name ?></a>
              </li>
              <?php
            }
            ?>
          </ul>
        </div>
        <div class="footer__info js-footer-section-parent">
          <h3 class="footer__info-title js-footer-section">
            Інформація<span class="footer__section-arrow">
              <svg width="13" height="8">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#faq-arrow"></use>
              </svg></span>
          </h3>
          <ul class="footer__info-list js-footer-section-info">
            <li>
              <a class="footer__info-link" href="<?php echo site_url('') ?>/faq"
                aria-label="Посилання сторінку популярних питань">Популярні питання</a>
            </li>
            <li>
              <a class="footer__info-link" href="<?php echo site_url('') ?>/about-fabrics"
                aria-label="Посилання сторінку з інформацією про тканини">Тканини</a>
            </li>
          </ul>
        </div>
        <div class="footer__contacts js-footer-section-parent">
          <h3 class="footer__contacts-title js-footer-section">
            Контакти<span class="footer__section-arrow">
              <svg width="13" height="8">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#faq-arrow"></use>
              </svg></span>
          </h3>
          <div class="footer__contacts-wrap js-footer-section-info">
            <div class="footer__contacts-phone">
              <svg class="footer__contacts-icon" width="15" heigth="15">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#phone"></use>
              </svg>
              <ul class="footer__contacts-list">
                <li>
                  <a class="footer__contacts-link" href="tel:+38<?php
                  $number = get_field('first_phone', 131);
                  $cleaned_number = preg_replace('/\D/', '', $number);
                  echo $cleaned_number;
                  ?>" aria-label="Посилання на телефон"><?php the_field('first_phone', '131') ?></a>
                </li>
                <li>
                  <a class="footer__contacts-link" href="tel:+38<?php
                  $number = get_field('second_phone', 131);
                  $cleaned_number = preg_replace('/\D/', '', $number);
                  echo $cleaned_number;
                  ?>" aria-label="Посилання на телефон"><?php the_field('second_phone', '131') ?></a>
                </li>
              </ul>
            </div>
            <div class="footer__contacts-mail">
              <svg class="footer__contacts-icon" width="15" heigth="10">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#mail"></use>
              </svg>
              <a class="footer__contacts-link" href="mailto:rendez-vous-elite@ukr.net" aria-label="Посилання на пошту">
                <?php the_field('footer_email', '131') ?>
              </a>
            </div>
            <div class="footer__contacts-location">
              <svg class="footer__contacts-icon" width="15" heigth="10">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/icons.svg#location"></use>
              </svg>
              <div class="footer__contacts-location-text">
                <p>
                  <?php the_field('footer_address', '131') ?>
                </p>
                <p>
                  <?php the_field('footer_work_schedule', '131') ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer__copyright">
        <div class="footer__copyright-wrap">
          <span>©2023</span>
          <p>Усі права захищено</p>
        </div>
      </div>
    </div>
  </div>
  <?php
  if (!empty($_SESSION['aboutProducts'])) { ?>
    <script>
      let aboutProducts = <?php echo json_encode($_SESSION['aboutProducts']); ?>;
      localStorage.setItem('aboutProducts', JSON.stringify(aboutProducts));
    </script>
  <?php }

  $logout_url = wp_logout_url();
  $_SESSION['logoutUrl'] = $logout_url;
  if (!empty($_SESSION['logoutUrl'])) { ?>
    <script>
      let logoutUrl = <?php echo json_encode($_SESSION['logoutUrl']); ?>;
      localStorage.setItem('logoutUrl', JSON.stringify(logoutUrl));
    </script>
  <?php } ?>
  <?php wp_footer(); ?>
</footer>
</body>

</html>