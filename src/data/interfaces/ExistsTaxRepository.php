<?php

interface ExistsTaxRepository {
  public function exists(String $field, String $name) : bool;
}