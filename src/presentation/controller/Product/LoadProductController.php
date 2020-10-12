<?php

class LoadProductController implements Controller {
  private LoadProduct $loadProduct;

  public function __construct(LoadProduct $loadProduct)
  {
    $this->loadProduct = $loadProduct;
  }

  public function handle (HttpRequest $httpRequest) : HttpResponse {
    try {

      $productId = (int) array_key_exists('id', $httpRequest->body) ? $httpRequest->body['id'] : 0;

      if($productId > 0) {
        return new Ok($this->loadProduct->show($productId));
      }

      return new Ok($this->loadProduct->index());
    } catch(DomainError $de) {
      return new Conflict(['error' => $de->getMessage()]);
    } catch(Exception $e) {
      return new ServerError();
    }
  }
}