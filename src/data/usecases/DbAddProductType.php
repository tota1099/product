<?php

class DbAddProductType {
  private AddProductTypeRepository $addProductTypeRepository;

  public function __construct(AddProductTypeRepository $addProductTypeRepository)
  {
    $this->addProductTypeRepository = $addProductTypeRepository;  
  }

  public function add(AddProductTypeModel $addProductModel) {
    return $this->addProductTypeRepository->add($addProductModel);
  }
}