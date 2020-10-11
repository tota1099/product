<?php
class TaxRepository implements AddTaxRepository, ExistsTaxRepository {

  public function add(AddTaxModel $addTaxModel) : Tax {
    $mysqlHelper = new MysqlHelper();

    if($this->exists('name', $addTaxModel->name)) {
      throw new DomainError('Duplicate entry');
    }

    $sql = "INSERT INTO tax (name, value) VALUES (?,?)";
    $taxId = $mysqlHelper->insert($sql, [$addTaxModel->name, $addTaxModel->value ]);

    return new Tax(
      $taxId,
      $addTaxModel->name,
      $addTaxModel->value,
    );
  }

  public function exists(String $field, String $value) : bool {
    $sql = "SELECT COUNT(*) FROM tax WHERE {$field} = ? ";
    $mysqlHelper = new MysqlHelper();
    return $mysqlHelper->exists($sql, [ $value ]);
  }
}