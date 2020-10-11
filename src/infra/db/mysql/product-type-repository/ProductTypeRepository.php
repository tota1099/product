<?php

class ProductTypeRepository implements AddProductTypeRepository, ExistsProductTypeRepository {
  public function add(AddProductTypeModel $addProductTypeModel) : ProductType {
    $mysqlHelper = new MysqlHelper();

    if($this->exists('name', $addProductTypeModel->name)) {
      throw new DomainError('Duplicate entry');
    }

    $sql = "INSERT INTO product_type (name) VALUES (?)";
    $productTypeId = $mysqlHelper->insert($sql, [$addProductTypeModel->name]);

    return new ProductType(
      $productTypeId,
      $addProductTypeModel->name
    );
  }

  public function exists(String $field, String $value) : bool {
    $sql = "SELECT COUNT(*) FROM product_type WHERE {$field} = ? ";
    $mysqlHelper = new MysqlHelper();
    return $mysqlHelper->exists($sql, [ $value ]);
  }
}