<?php

interface ProductRepository {
  public function add(AddProductModel $addProductModel) : Product;
  public function remove(int $productId) : void;
  public function exists(String $field, String $name) : bool;
}