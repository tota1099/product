<?php

class DbAddProduct implements AddProduct {
  private AddProductRepository $addProductRepository;

  public function __construct(AddProductRepository $addProductRepository)
  {
    $this->addProductRepository = $addProductRepository;  
  }

  public function add(AddProductModel $addProductModel) : Product {
    return $this->addProductRepository->add($addProductModel);
  }
}