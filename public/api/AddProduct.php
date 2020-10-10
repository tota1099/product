<?php

require_once(__DIR__ . '/../../config.php');

$body = json_decode(file_get_contents('php://input'), true);

$productTypeRepository = new ProductTypeRepository();
$productRepository = new ProductRepository();
$addProduct = new DbAddProduct($productRepository, $productTypeRepository);
$addProductController = new AddProductController($addProduct);

$response = $addProductController->handle(new HttpRequest($body));

http_response_code($response->statusCode);
echo json_encode($response->body);