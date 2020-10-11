<?php

class RemoveProductFactory {
  public static function build() : Controller {
    $productRepository = new ProductRepositoryAdapter();
    $removeProduct = new DbRemoveProduct($productRepository);
    return new DeleteProductController($removeProduct);
  }
}