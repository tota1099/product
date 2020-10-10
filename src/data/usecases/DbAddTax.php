<?php

class DbAddTax implements AddTax {
  private AddTaxRepository $addTaxRepository;

  public function __construct(AddTaxRepository $addTaxRepository)
  {
    $this->addTaxRepository = $addTaxRepository;  
  }

  public function add(AddTaxModel $addTaxModel) : Tax {
    return $this->addTaxRepository->add($addTaxModel);
  }
}