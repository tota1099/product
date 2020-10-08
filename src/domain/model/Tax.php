<?php

class Tax {
  public int $id;
  public String $name;
  public float $value;

  public function __construct(int $id, String $name, float $value)
  {
    $this->id = $id;
    $this->name = $name;
    $this->value = $value;
  }
}