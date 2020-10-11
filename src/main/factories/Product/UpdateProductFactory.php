<?php

class UpdateProductFactory {
  public static function build() : Controller {
    $productTypeRepository = new ProductTypeRepository();
    $productRepository = new ProductRepositoryAdapter();
    $validator = new ValidatorAdapter();
    $updateProduct = new DbUpdateProduct($productRepository, $productTypeRepository);
    return new UpdateProductController($updateProduct, $validator);
  }
}