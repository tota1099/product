<?php

class ValidatorAdapter implements Validator {
  public function isValidCurrency(String $value): bool {
    return preg_match("/^[0-9]+(?:\.[0-9]{1,2})?$/", $value);
  }
}