<?php

class Product {
  public int $id;
  public String $name;
  public float $value;
  public int $type;

  public function __construct(int $id, String $name, float $value, int $type)
  {
    $this->id = $id;
    $this->name = $name;
    $this->value = $value;
    $this->type = $type;
  }
}