<?php

class DbUpdateProduct implements UpdateProduct {
  private ProductRepository $productRepository;
  private ExistsProductTypeRepository $productTypeRepository;

  public function __construct(ProductRepository $productRepository, ExistsProductTypeRepository $productTypeRepository)
  {
    $this->productRepository = $productRepository;
    $this->productTypeRepository = $productTypeRepository;
  }

  public function update(Product $product) : void {
    if(!$this->productRepository->exists('id', $product->id)) {
      throw new DomainError('Invalid Product');
    }

    if(!$this->productTypeRepository->exists('id', $product->type)) {
      throw new DomainError('Invalid Type');
    }

    $this->productRepository->update($product);
  }
}