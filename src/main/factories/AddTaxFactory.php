<?php

class AddTaxFactory {
  public static function build() : Controller {
    $validatorAdapter = new ValidatorAdapter();
    $taxRepository = new TaxRepository();
    $addTax = new DbAddTax($taxRepository);
    return new AddTaxController($addTax, $validatorAdapter);
  }
}