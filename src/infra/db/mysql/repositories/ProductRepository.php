<?php
class ProductRepository implements AddProductRepository, ExistsProductRepository {

  public function add(AddProductModel $addProductModel) : Product {
    $mysqlHelper = new MysqlHelper();

    if($this->exists($addProductModel->name)) {
      throw new DomainError('Duplicate entry');
    }

    $sql = "INSERT INTO product (name, value, type) VALUES (?,?,?)";
    $productId = $mysqlHelper->insert($sql, [$addProductModel->name, $addProductModel->value, $addProductModel->type]);

    return new Product(
      $productId,
      $addProductModel->name,
      $addProductModel->value,
      $addProductModel->type
    );
  }

  public function exists(String $name) : bool {
    $sql = "SELECT COUNT(*) FROM product WHERE name= ? ";
    $mysqlHelper = new MysqlHelper();
    return $mysqlHelper->exists($sql, [ $name ]);
  }
}