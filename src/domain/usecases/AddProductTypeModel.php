<?php

class AddProductTypeModel {
  public String $name;

  public function __construct(String $name)
  {
    $this->name = $name;
  }
}