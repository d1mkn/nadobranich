export const refs = {
  // header
  searchBtn: document.querySelector(".js-search-btn"),
  searchForm: document.querySelector(".js-search-form"),
  cartCounter: document.querySelector(".js-cart-counter"),
  logoutLink: document.querySelector(".js-logout"),

  // backdrop
  backdrop: document.querySelector(".backdrop"),

  // auth
  openLogin: document.querySelectorAll("[data-type=login]"),
  authContainer: document.querySelector(".auth-modal__container"),
  authCloseBtn: document.querySelector(".js-auth-close-btn"),
  authSubmits: document.querySelectorAll(".auth-modal__form-submit"),
  loginForm: document.querySelector(".auth-modal__login"),
  emailLoginField: document.querySelector('[name="log"]'),
  emailLoginValidation: document.querySelector(".invalid-input-message.email"),
  passwordLoginField: document.querySelector('[name="pwd"]'),
  passwordLoginValidation: document.querySelector(".invalid-input-message.password"),
  loginRequestAnswer: document.querySelector(".invalid-input-message.req-error"),
  openRegister: document.querySelectorAll('[data-type="register"]'),
  registerForm: document.querySelector(".auth-modal__register"),
  registerUserName: document.getElementById("user_name"),
  registerUserLastName: document.getElementById("user_last_name"),
  registerUserLogin: document.getElementById("user_login_reg"),
  registerUserEmail: document.getElementById("user_email"),
  registerUserPassword: document.getElementById("user_password"),
  registerUserNameValidation: document.querySelector(".reg-first-name"),
  registerUserLastNameValidation: document.querySelector(".reg-last-name"),
  registerUserEmailValidation: document.querySelector(".reg-email"),
  registerUserPasswordValidation: document.querySelector(".reg-password"),
  openRecoverPassword: document.querySelector('[data-type="recover-password"]'),
  recoverPasswordForm: document.querySelector(".auth-modal__recover-password"),
  recoverPasswordField: document.getElementById("recover_password"),
  recoverPasswordMessage: document.querySelector(".js-password-recover-message"),

  // mobile menu
  menuBtn: document.querySelector(".mobile-menu-btn"),
  menuContainer: document.querySelector(".mobile-menu__container"),

  // modal
  modalTriggerList: document.querySelectorAll(".js-quick-view"),
  modal: document.querySelector(".modal"),
  modalDialog: document.querySelector(".modal__dialog"),
  modalBackdrop: document.querySelector(".modal-backdrop"),
  closeButton: document.querySelector(".modal__dialog-close"),
  addToCartButton: document.querySelector(".js-add-to-cart"),
  mainImgWrap: document.querySelector(".modal__images-main-wrap .swiper-wrapper"),
  modalGallery: document.querySelector(".modal__images-list"),
  productTitle: document.querySelector(".modal__body-title"),
  productDesc: document.querySelector(".modal__body-composition"),
  ratingStars: document.querySelector(".js-modal-rating"),
  ratingLink: document.querySelector(".modal__body-rating-link"),
  productPrice: document.querySelector(".js-modal-price"),
  productColor: document.querySelector(".js-modal-color"),
  colorList: document.querySelector(".js-modal-color-list"),
  productSize: document.querySelector(".js-modal-size"),
  sizeList: document.querySelector(".js-modal-size-list"),
  toItemBtn: document.querySelector(".js-to-item-page"),
  modalLoader: document.querySelector(".js-modal-loader"),

  // added to cart modal
  toCartWrap: document.querySelector(".js-to-cart-modal"),
  toCartClsBtn: document.querySelector(".js-to-cart-close-btn"),
  toCartImg: document.querySelector(".js-to-cart-modal-img"),
  toCartTitle: document.querySelector(".js-to-cart-modal-title"),
  toCartVar: document.querySelector(".js-to-cart-modal-variation"),
  toCartQty: document.querySelector(".js-to-cart-modal-qty"),

  // faq
  faqItems: document.querySelectorAll(".faq__item"),

  // fabrics
  fabricsItems: document.querySelectorAll(".fabrics__item"),

  // category
  categoryItems: document.querySelectorAll(".category-page__filter-item"),
  categoryDrop: document.querySelectorAll(".category-page__filter-drop"),

  // ordering
  orderingCheckbox1: document.querySelector(".js-checkbox1"),
  orderingCheckbox2: document.querySelector(".js-checkbox2"),
  orderingSummary: document.querySelector(".ordering-details-js"),
  orderingDetails: document.querySelector(".ordering-items-js"),

  // item
  formShowBtn: document.querySelector(".js-form-open-btn"),
  reviewForm: document.querySelector(".js-review-form"),

  // footer
  footerSections: document.querySelectorAll(".js-footer-section"),
  catalogTitle: document.querySelector(".footer__catalog"),
  catalogList: document.querySelector(".footer__catalog-list"),
  infoTitle: document.querySelector(".footer__info"),
  infoList: document.querySelector(".footer__info-list"),
  contactsTitle: document.querySelector(".footer__contacts"),
  contactsList: document.querySelector(".footer__contacts-wrap"),

  // single page
  singleProductPrice: document.querySelector(".js-variation-price"),
  wooVatiationPriceWrap: document.querySelector(".woocommerce-variation.single_variation"),
  wooVatiationPrice: document.querySelector(".woocommerce-Price-amount.amount bdi"),

  // user page
  submitInfoEdit: document.querySelector(".js-edit-user"),
  submitChangePass: document.querySelector(".js-change-pass"),
  userLogout: document.querySelector(".js-cabinet-logout"),

  // user edit
  userNameField: document.getElementById("account_first_name"),
  userLastNameField: document.getElementById("account_last_name"),
  userPhoneField: document.getElementById("account_phone"),
  userEmailField: document.getElementById("account_email"),
  userOldPasswordField: document.getElementById("password_current"),
  userNewPasswordFirstField: document.getElementById("password_1"),
  userNewPasswordSecondField: document.getElementById("password_2"),
  userOldPasswordValidation: document.querySelector(".js-old-password"),
  userNewPasswordValidation: document.querySelector(".js-new-password"),
};
