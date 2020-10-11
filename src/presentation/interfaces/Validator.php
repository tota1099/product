<?php

interface Validator {
  public function isValidCurrency(String $value): bool;
}