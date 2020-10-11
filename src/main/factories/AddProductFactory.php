<?php

class AddProductFactory {
  public static function build() : Controller {
    $productTypeRepository = new ProductTypeRepository();
    $productRepository = new ProductRepository();
    $validator = new ValidatorAdapter();
    $addProduct = new DbAddProduct($productRepository, $productTypeRepository);
    return new AddProductController($addProduct, $validator);
  }
}