<?php

class ProductTypeRepository implements AddProductTypeRepository {
  public function add(AddProductTypeModel $addProductTypeModel) : ProductType {
    $mysqlHelper = new MysqlHelper();
    $sql = "INSERT INTO product_type (name) VALUES (?)";
    $productId = $mysqlHelper->insert($sql, [$addProductTypeModel->name]);

    return new ProductType(
      $productId,
      $addProductTypeModel->name
    );
  }

  public function existsByName(String $name) : bool {
    $sql = "SELECT COUNT(*) FROM product_type WHERE name = ? ";
    $mysqlHelper = new MysqlHelper();
    return $mysqlHelper->exists($sql, [ $name ]);
  }
}