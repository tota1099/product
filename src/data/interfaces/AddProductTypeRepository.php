<?php

interface AddProductTypeRepository {
  public function add(AddProductTypeModel $addProductTypeModel) : ProductType;
  public function existsByName(String $name) : bool;
}