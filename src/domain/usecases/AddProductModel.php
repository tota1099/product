<?php

class AddProductModel {
  public String $name;
  public float $value;
  public ProductType $type;

  public function __construct(String $name, float $value, ProductType $type)
  {
    $this->name = $name;
    $this->value = $value;
    $this->type = $type;
  }
}