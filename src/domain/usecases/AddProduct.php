<?php

interface AddProduct {
  public function add(AddProductModel $addProductModel) : Product;
}