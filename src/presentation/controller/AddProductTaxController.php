<?php

class AddProductTaxController implements Controller {
  private AddProductTypeTax $addProductTax;

  public function __construct(AddProductTypeTax $addProductTypeTax)
  {
    $this->addProductTypeTax = $addProductTypeTax;
  }

  public function handle (HttpRequest $httpRequest) : HttpResponse {
    try {
      $requiredFields = ['productTypeId', 'taxId'];
      foreach($requiredFields as $field) {
        if(empty($httpRequest->body[$field])) {
          return new BadRequest(new MissingParamError($field));
        }
      }

      $productTax = $this->addProductTypeTax->add(new AddProductTypeTaxModel($httpRequest->body['productTypeId'], $httpRequest->body['taxId']));
      return new Ok([
        'id' => $productTax->id,
        'name' => $productTax->productTypeId,
        'value' => $productTax->taxId
      ]);
    } catch(DomainError $de) {
      return new Conflict(['error' => $de->getMessage()]);
    } catch(Exception $e) {
      return new ServerError();
    }
  }
}