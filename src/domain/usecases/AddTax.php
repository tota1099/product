<?php

interface AddTax {
  public function add(AddTaxModel $addTaxModel) : Tax;
}