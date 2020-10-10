<?php

require_once(__DIR__ . '/../../config.php');

$body = json_decode(file_get_contents('php://input'), true);

$taxRepository = new TaxRepository();
$addTax = new DbAddTax($taxRepository);
$addTaxController = new AddTaxController($addTax);

$response = $addTaxController->handle(new HttpRequest($body));

http_response_code($response->statusCode);
echo json_encode($response->body);