<?php

class DbAddProductTypeTax implements AddProductTypeTax {
  private AddProductTaxRepository $addProductTaxRepository;
  private ExistsProductTypeRepository $existsProductTypeRepository;
  private ExistsTaxRepository $existsTaxRepository;

  public function __construct(AddProductTaxRepository $addProductTaxRepository, ExistsProductTypeRepository $existsProductTypeRepository, ExistsTaxRepository $existsTaxRepository)
  {
    $this->addProductTaxRepository = $addProductTaxRepository;
    $this->existsProductTypeRepository = $existsProductTypeRepository;
    $this->existsTaxRepository = $existsTaxRepository;
  }

  public function add(AddProductTypeTaxModel $addProductTypeTaxModel) : ProductTypeTax {
    if(!$this->existsProductTypeRepository->exists('id', $addProductTypeTaxModel->productTypeId)) {
      throw new DomainError('Invalid Product Type');
    }

    if(!$this->existsTaxRepository->exists('id', $addProductTypeTaxModel->taxId)) {
      throw new DomainError('Invalid Tax');
    }

    return $this->addProductTaxRepository->add($addProductTypeTaxModel);
  }
}