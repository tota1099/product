<?php

interface ExistsProductRepository {
  public function exists(String $name) : bool;
}