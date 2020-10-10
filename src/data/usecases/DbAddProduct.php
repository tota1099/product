<?php

class DbAddProduct implements AddProduct {
  private AddProductRepository $addProductRepository;
  private ExistsProductTypeRepository $addProductTypeRepository;

  public function __construct(AddProductRepository $addProductRepository, ExistsProductTypeRepository $addProductTypeRepository)
  {
    $this->addProductRepository = $addProductRepository;
    $this->addProductTypeRepository = $addProductTypeRepository;
  }

  public function add(AddProductModel $addProductModel) : Product {
    if(!$this->addProductTypeRepository->exists('id', $addProductModel->type)) {
      throw new DomainError('Invalid Type');
    }
    return $this->addProductRepository->add($addProductModel);
  }
}