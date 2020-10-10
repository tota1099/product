<?php

interface ExistsProductTypeRepository {
  public function exists(String $field, String $name) : bool;
}