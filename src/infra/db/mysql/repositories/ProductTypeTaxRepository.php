<?php
class ProductTypeTaxRepository implements AddProductTaxRepository, ExistsProductTypeTaxRepository {

  public function add(AddProductTypeTaxModel $addProductTaxModel) : ProductTypeTax {
    $mysqlHelper = new MysqlHelper();

    if($this->exists($addProductTaxModel->productTypeId, $addProductTaxModel->taxId)) {
      throw new DomainError('Duplicate entry');
    }

    $sql = "INSERT INTO product_type_tax (product_type_id, tax_id) VALUES (?,?)";
    $taxId = $mysqlHelper->insert($sql, [$addProductTaxModel->productTypeId, $addProductTaxModel->taxId ]);

    return new ProductTypeTax(
      $taxId,
      $addProductTaxModel->productTypeId,
      $addProductTaxModel->taxId,
    );
  }

  public function exists(int $productTypeId, int $taxId) : bool {
    $sql = "SELECT COUNT(*) FROM product_type_tax WHERE product_type_id = ? AND tax_id = ? ";
    $mysqlHelper = new MysqlHelper();
    return $mysqlHelper->exists($sql, [ $productTypeId, $taxId ]);
  }
}