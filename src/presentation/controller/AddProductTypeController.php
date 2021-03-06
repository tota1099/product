<?php

class AddProductTypeController implements Controller {
  private AddProductType $addProductType;

  public function __construct(AddProductType $addProductType)
  {
    $this->addProductType = $addProductType; 
  }

  public function handle (HttpRequest $httpRequest) : HttpResponse {
    try {
      if(empty($httpRequest->body['name'])) {
        return new BadRequest(new MissingParamError('Name'));
      }
      $productType = $this->addProductType->add(new AddProductTypeModel($httpRequest->body['name']));
      return new Ok([
        'id' => $productType->id,
        'name' => $productType->name,
      ]);
    } catch(DomainError $de) {
      return new Conflict(['error' => $de->getMessage()]);
    } catch(Exception $e) {
      return new ServerError();
    }
  }
}