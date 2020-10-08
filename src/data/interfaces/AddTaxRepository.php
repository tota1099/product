<?php

interface AddTaxRepository {
  public function add(AddTaxModel $addTaxModel) : Tax;
}