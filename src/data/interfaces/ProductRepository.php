<?php

interface ProductRepository {
  public function add(AddProductModel $addProductModel) : Product;
  public function update(Product $product) : void;
  public function remove(int $productId) : void;
  public function exists(String $field, String $name) : bool;
  public function existsAndNotId(String $field, String $name, String $id) : bool;
}