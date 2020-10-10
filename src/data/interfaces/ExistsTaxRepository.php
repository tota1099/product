<?php

interface ExistsTaxRepository {
  public function exists(String $name) : bool;
}