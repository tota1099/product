<?php

require_once(__DIR__ . '/../../config.php');

$body = json_decode(file_get_contents('php://input'), true);

$addProductRepository = new ProductTypeRepository();
$addProductType = new DbAddProductType($addProductRepository);
$addProductTypeController = new AddProductTypeController($addProductType);

$response = $addProductTypeController->handle(new HttpRequest($body));

http_response_code($response->statusCode);
echo json_encode($response->body);