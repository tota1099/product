<?php

class DbAddProductType implements AddProductType {
  private AddProductTypeRepository $addProductTypeRepository;

  public function __construct(AddProductTypeRepository $addProductTypeRepository)
  {
    $this->addProductTypeRepository = $addProductTypeRepository;  
  }

  public function add(AddProductTypeModel $addProductModel) : ProductType {
    try {
      return $this->addProductTypeRepository->add($addProductModel);
    } catch (Exception $e) {
      throw $e;
    }
  }
}