<?php

class AddProductTaxFactory {
  public static function build() : Controller {
    $productTypeTaxRepository = new ProductTypeTaxRepository();
    $productTypeRepository = new ProductTypeRepository();
    $taxRepository = new TaxRepository();
    $addProductTypeTax = new DbAddProductTypeTax($productTypeTaxRepository, $productTypeRepository, $taxRepository);
    return new AddProductTaxController($addProductTypeTax);
  }
}