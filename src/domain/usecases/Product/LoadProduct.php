<?php

interface LoadProduct {
  public function show(int $productId) : Array;
  public function index() : Array;
}