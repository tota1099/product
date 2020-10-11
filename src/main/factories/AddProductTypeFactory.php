<?php

class AddProductTypeFactory {
  public static function build() : Controller {
    $productRepository = new ProductTypeRepository();
    $addProductType = new DbAddProductType($productRepository);
    return new AddProductTypeController($addProductType);
  }
}