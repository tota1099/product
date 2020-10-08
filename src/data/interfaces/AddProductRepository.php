<?php

interface AddProductRepository {
  public function add(AddProductModel $addProductModel) : Product;
}