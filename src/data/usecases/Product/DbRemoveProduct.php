<?php

class DbRemoveProduct implements RemoveProduct {
  private ProductRepository $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function remove(int $productId) : void {
    if(!$this->productRepository->exists('id', $productId)) {
      throw new DomainError('Invalid Product');
    }
    $this->productRepository->remove($productId);
  }
}