<?php

interface ExistsProductTypeTaxRepository {
  public function exists(int $productTypeId, int $taxId) : bool;
}