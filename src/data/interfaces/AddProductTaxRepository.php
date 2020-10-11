<?php

interface AddProductTaxRepository {
  public function add(AddProductTypeTaxModel $addProductTypeTaxModel) : ProductTypeTax;
}