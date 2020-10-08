<?php

class DbAddTax {
  private AddTaxRepository $addTaxRepository;

  public function __construct(AddTaxRepository $addTaxRepository)
  {
    $this->addTaxRepository = $addTaxRepository;  
  }

  public function add(AddTaxModel $addProductModel) {
    return $this->addTaxRepository->add($addProductModel);
  }
}