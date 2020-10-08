<?php

class ProductType {
  public int $id;
  public String $name;

  public function __construct(int $id, String $name)
  {
    $this->id = $id;
    $this->name = $name;
  }
}