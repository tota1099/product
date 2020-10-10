<?php

class DuplicateEntryError extends Exception {
  public function __construct() {
    parent::__construct('Duplicate Entry');
  }
}