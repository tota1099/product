<?php

class DbAddProductType implements AddProductType {
  private AddProductTypeRepository $addProductTypeRepository;

  public function __construct(AddProductTypeRepository $addProductTypeRepository)
  {
    $this->addProductTypeRepository = $addProductTypeRepository;  
  }

  public function add(AddProductTypeModel $addProductModel) : ProductType {
    if($this->addProductTypeRepository->existsByName($addProductModel->name)){
      throw new Exception('Record already exists!');
    }

    return $this->addProductTypeRepository->add($addProductModel);
  }
}