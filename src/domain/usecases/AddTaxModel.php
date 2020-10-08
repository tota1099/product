<?php

class AddTaxModel {
  public String $name;
  public float $value;

  public function __construct(String $name, float $value)
  {
    $this->name = $name;
    $this->value = $value;
  }
}