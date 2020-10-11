<?php

require_once(__DIR__ . '/interfaces/Controller.php');
require_once(__DIR__ . '/interfaces/HttpResponse.php');
require_once(__DIR__ . '/interfaces/HttpRequest.php');
require_once(__DIR__ . '/interfaces/Validator.php');
require_once(__DIR__ . '/errors/MissingParamError.php');
require_once(__DIR__ . '/errors/InvalidParamError.php');
require_once(__DIR__ . '/helpers/BadRequest.php');
require_once(__DIR__ . '/helpers/Ok.php');
require_once(__DIR__ . '/helpers/Conflict.php');
require_once(__DIR__ . '/helpers/ServerError.php');
require_once(__DIR__ . '/controller/Product/AddProductController.php');
require_once(__DIR__ . '/controller/Product/UpdateProductController.php');
require_once(__DIR__ . '/controller/Product/DeleteProductController.php');
require_once(__DIR__ . '/controller/AddProductTypeController.php');
require_once(__DIR__ . '/controller/AddTaxController.php');
require_once(__DIR__ . '/controller/AddProductTaxController.php');