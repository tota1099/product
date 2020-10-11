<?php

class ProductTypeTax {
  public int $id;
  public int $productTypeId;
  public int $taxId;

  public function __construct(int $id, int $productTypeId, int $taxId)
  {
    $this->id = $id;
    $this->productTypeId = $productTypeId;
    $this->taxId = $taxId;
  }
}