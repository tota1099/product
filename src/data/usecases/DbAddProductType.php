<?php

class DbAddProductType implements AddProductType {
  private AddProductTypeRepository $addProductTypeRepositoryMock;

  public function __construct(AddProductTypeRepository $addProductTypeRepositoryMock)
  {
    $this->addProductTypeRepositoryMock = $addProductTypeRepositoryMock;  
  }

  public function add(AddProductTypeModel $addProductTypeModel) : ProductType {
    return $this->addProductTypeRepositoryMock->add($addProductTypeModel);
  }
}