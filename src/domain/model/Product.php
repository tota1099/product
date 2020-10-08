<?php

class Product {
  public int $id;
  public String $name;
  public float $value;
  public ProductType $type;

  public function __construct(int $id, String $name, float $value, ProductType $type)
  {
    $this->id = $id;
    $this->name = $name;
    $this->value = $value;
    $this->type = $type;
  }
}