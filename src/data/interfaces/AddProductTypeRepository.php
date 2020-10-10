<?php

interface AddProductTypeRepository {
  public function add(AddProductTypeModel $addProductTypeModel) : ProductType;
}