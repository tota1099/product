<?php
class ProductRepositoryAdapter implements ProductRepository {

  public function add(AddProductModel $addProductModel) : Product {
    $mysqlHelper = new MysqlHelper();

    if($this->exists('name', $addProductModel->name)) {
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

  public function exists(String $field, String $value) : bool {
    $sql = "SELECT COUNT(*) FROM product WHERE {$field}= ? ";
    $mysqlHelper = new MysqlHelper();
    return $mysqlHelper->exists($sql, [ $value ]);
  }

  public function remove(int $id ) : void {
    $mysqlHelper = new MysqlHelper();
    $sql = "DELETE FROM product WHERE id = ?";
    $mysqlHelper->remove($sql, [ $id ]);
  }
}