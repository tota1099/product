<?php

class AddProductModel {
  public String $name;
  public float $value;
  public int $type;

  public function __construct(String $name, float $value, int $type)
  {
    $this->name = $name;
    $this->value = $value;
    $this->type = $type;
  }
}