<footer>
      <div class="footer-wrap">
        <div class="container">
          <div class="footer__socials">
            <div class="footer__logo-wrap">
              <a href=".">
                <svg class="footer__logo" width="188" height="50">
                  <use href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#logo-footer"></use>
                </svg>
              </a>
              <div class="footer__socials_links">
                <a class="footer__socials_link" href="#"
                  ><svg class="footer__socials_icon" width="22" height="23">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#insta"></use></svg
                ></a>
                <a class="footer__socials_link" href="#"
                  ><svg class="footer__socials_icon" width="22" height="21">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#tg"></use></svg
                ></a>
                <a class="footer__socials_link" href="#"
                  ><svg class="footer__socials_icon" width="23" height="23">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#viber"></use></svg
                ></a>
              </div>
            </div>
          </div>
          <div class="footer__sections">
            <div class="footer__catalog js-footer-section">
              <h3 class="footer__catalog-title">
                Каталог<span class="footer__section-arrow">
                  <svg width="13" height="8">
                    <use
                      href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#faq-arrow"
                    ></use></svg
                ></span>
              </h3>
              <ul
                class="footer__catalog-list js-footer-section-info"
              >
                <li>
                  <a class="footer__catalog-link" href="#">Постільна білизна</a>
                </li>
                <li><a class="footer__catalog-link" href="#">Пледи</a></li>
                <li><a class="footer__catalog-link" href="#">Рушники</a></li>
                <li><a class="footer__catalog-link" href="#">Покривала</a></li>
                <li>
                  <a class="footer__catalog-link" href="#">Акційні товари</a>
                </li>
              </ul>
            </div>
            <div class="footer__info js-footer-section">
              <h3 class="footer__info-title">
                Інформація<span class="footer__section-arrow">
                  <svg width="13" height="8">
                    <use
                      href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#faq-arrow"
                    ></use></svg
                ></span>
              </h3>
              <ul
                class="footer__info-list js-footer-section-info"
              >
                <li><a class="footer__info-link" href="#">Про нас</a></li>
                <li>
                  <a class="footer__info-link" href="<?php echo get_template_directory_uri()?>/assets/images/faq.html"
                    >Популярні питання</a
                  >
                </li>
                <li>
                  <a class="footer__info-link" href="#">Доставка та оплата</a>
                </li>
                <li>
                  <a class="footer__info-link" href="#">Обмін та поверення</a>
                </li>
                <li>
                  <a class="footer__info-link" href="<?php echo get_template_directory_uri()?>/assets/images/fabrics.html"
                    >Тканини</a
                  >
                </li>
              </ul>
            </div>
            <div class="footer__contacts js-footer-section">
              <h3 class="footer__contacts-title">
                Контакти<span class="footer__section-arrow">
                  <svg width="13" height="8">
                    <use
                      href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#faq-arrow"
                    ></use></svg
                ></span>
              </h3>
              <div
                class="footer__contacts-wrap js-footer-section-info"
              >
                <div class="footer__contacts-phone">
                  <svg class="footer__contacts-icon" width="15" heigth="15">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#phone"></use>
                  </svg>
                  <ul class="footer__contacts-list">
                    <li>
                      <a class="footer__contacts-link" href="tel:+380983363028"
                        >(098) 33-63-028</a
                      >
                    </li>
                    <li>
                      <a class="footer__contacts-link" href="tel:+380983363028"
                        >(098) 33-63-028</a
                      >
                    </li>
                  </ul>
                </div>
                <div class="footer__contacts-mail">
                  <svg class="footer__contacts-icon" width="15" heigth="10">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#mail"></use>
                  </svg>
                  <a
                    class="footer__contacts-link"
                    href="mailto:rendez-vous-elite@ukr.net"
                    >rendez-vous-elite@ukr.net
                  </a>
                </div>
                <div class="footer__contacts-location">
                  <svg class="footer__contacts-icon" width="15" heigth="10">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/icons.svg#location"></use>
                  </svg>
                  <div class="footer__contacts-location-text">
                    <p>м. Умань, Черкаська обл.</p>
                    <p>пн.-нд. 9.00-19.00</p>
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
      <?php wp_footer(); ?>
    </footer>
</body>
</html>
