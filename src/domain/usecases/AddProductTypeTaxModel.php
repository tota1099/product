<?php

class AddProductTypeTaxModel {
  public int $productTypeId;
  public int $taxId;

  public function __construct(int $productTypeId, int $taxId)
  {
    $this->productTypeId = $productTypeId;
    $this->taxId = $taxId;
  }
}