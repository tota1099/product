<?php

interface AddProductType {
  public function add(AddProductTypeModel $addProductTypeModel) : ProductType;
}