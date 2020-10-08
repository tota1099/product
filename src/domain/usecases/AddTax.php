<?php

interface AddTax {
  public function add(AddTax $addTax) : Tax;
}