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
    } catch(DuplicateEntryError $de) {
      return new Conflict(['error' => 'Duplicate entry']);
    } catch(Exception $e) {
      return new ServerError();
    }
  }
}