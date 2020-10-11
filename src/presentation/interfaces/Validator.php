<?php

interface Validator {
  public function isValidCurrency(String $value): bool;
  public function isValidaPercentage(String $value): bool;
}