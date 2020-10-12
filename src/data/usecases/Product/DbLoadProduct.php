<?php

class DbLoadProduct implements LoadProduct {
  private ProductRepository $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function show(int $productId) : Array {
    if(!$this->productRepository->exists('id', $productId)) {
      throw new DomainError('Invalid Product');
    }
    return $this->productRepository->show($productId);
  }

  public function index() : Array {
    return $this->productRepository->index();
  }
}