<?php

class ValidatorAdapter implements Validator {
  public function isValidCurrency(String $value): bool {
    return preg_match("/^[0-9]+(?:\.[0-9]{1,2})?$/", $value);
  }

  public function isValidaPercentage(string $value): bool
  {
    return preg_match("/^\d+(?:\.\d+)?$/", $value);
  }
}