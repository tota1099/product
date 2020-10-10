<?php

class AddTaxController implements Controller {
  private AddTax $addTax;

  public function __construct(AddTax $addTax)
  {
    $this->addTax = $addTax; 
  }

  public function handle (HttpRequest $httpRequest) : HttpResponse {
    try {
      $requiredFields = ['name', 'value'];
      foreach($requiredFields as $field) {
        if(empty($httpRequest->body[$field])) {
          return new BadRequest(new MissingParamError($field));
        }
      }

      $tax = $this->addTax->add(new AddTaxModel($httpRequest->body['name'], $httpRequest->body['value']));
      return new Ok([
        'id' => $tax->id,
        'name' => $tax->name,
        'value' => $tax->value
      ]);
    } catch(DomainError $de) {
      return new Conflict(['error' => $de->getMessage()]);
    } catch(Exception $e) {
      return new ServerError();
    }
  }
}