<?php

class DeleteProductController implements Controller {
  private RemoveProduct $removeProduct;

  public function __construct(RemoveProduct $removeProduct)
  {
    $this->removeProduct = $removeProduct;
  }

  public function handle (HttpRequest $httpRequest) : HttpResponse {
    try {

      $productId = (int) array_key_exists('id', $httpRequest->body) ? $httpRequest->body['id'] : 0;

      if($productId <= 0) {
        return new BadRequest(new InvalidParamError('id'));
      }

      $this->removeProduct->remove($productId);
      return new Ok(['message' => 'Successfully deleted']);
    } catch(DomainError $de) {
      return new Conflict(['error' => $de->getMessage()]);
    } catch(Exception $e) {
      return new ServerError();
    }
  }
}