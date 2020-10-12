<?php

class LoadProductFactory {
  public static function build() : Controller {
    $productRepository = new ProductRepositoryAdapter();
    $loadProduct = new DbLoadProduct($productRepository);
    return new LoadProductController($loadProduct);
  }
}