<?php

class InvalidParamError extends Exception {
  public function __construct($paramName) {
    parent::__construct('Invalid param: ' . $paramName);
  }
}