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

  public function update(Product $product) : void {
    $mysqlHelper = new MysqlHelper();

    if($this->existsAndNotId('name', $product->name, $product->id)) {
      throw new DomainError('Duplicate entry');
    }

    $sql = "UPDATE product SET (name, value, type) VALUES (?,?,?) WHERE id = ?";
    $mysqlHelper->update($sql, [$product->name, $product->value, $product->type, $product->id ]);
  }

  public function exists(String $field, String $value) : bool {
    $sql = "SELECT COUNT(*) FROM product WHERE {$field}= ? ";
    $mysqlHelper = new MysqlHelper();
    return $mysqlHelper->exists($sql, [ $value ]);
  }
  
  public function existsAndNotId(String $field, String $value, String $id) : bool {
    $sql = "SELECT COUNT(*) FROM product WHERE {$field}= ? AND id != ?";
    $mysqlHelper = new MysqlHelper();
    return $mysqlHelper->exists($sql, [ $value, $id ]);
  }

  public function remove(int $id ) : void {
    $mysqlHelper = new MysqlHelper();
    $sql = "DELETE FROM product WHERE id = ?";
    $mysqlHelper->remove($sql, [ $id ]);
  }
}