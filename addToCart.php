<?php
/*
Template Name: Add to cart
*/
global $wpdb;

// Получение данных из запроса
$_SERVER['REQUEST_METHOD'] = "POST";
var_dump($_SERVER);
// $product_id = $_POST['productId'];
// $quantity = $_POST['qty'];
// $variation_id = $_POST['variationId'];

// Добавление товара в корзину
WC()->cart->add_to_cart($product_id, $quantity, $variation_id);

// Возвращение ответа
$response = array(
    'success' => true,
    'message' => 'Товар успешно добавлен в корзину!'
);
echo json_encode($response);