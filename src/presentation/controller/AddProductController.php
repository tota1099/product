<?php

class AddProductController implements Controller {
  private AddProduct $addProduct;

  public function __construct(AddProduct $addProduct)
  {
    $this->addProduct = $addProduct; 
  }

  public function handle (HttpRequest $httpRequest) : HttpResponse {
    try {
      $requiredFields = ['name', 'value', 'type'];
      foreach($requiredFields as $field) {
        if(empty($httpRequest->body[$field])) {
          return new BadRequest(new MissingParamError($field));
        }
      }

      $product = $this->addProduct->add(new AddProductModel($httpRequest->body['name'], $httpRequest->body['value'], $httpRequest->body['type']));
      return new Ok([
        'id' => $product->id,
        'name' => $product->name,
      ]);
    } catch(DomainError $de) {
      return new Conflict(['error' => $de->getMessage()]);
    } catch(Exception $e) {
      return new ServerError();
    }
  }
}