<?php

class DbAddProduct {
  private AddProductRepository $addProductRepository;

  public function __construct(AddProductRepository $addProductRepository)
  {
    $this->addProductRepository = $addProductRepository;  
  }

  public function add(AddProductModel $addProductModel) {
    return $this->addProductRepository->add($addProductModel);
  }
}