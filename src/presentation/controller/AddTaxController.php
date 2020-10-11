<?php

class AddTaxController implements Controller {
  private AddTax $addTax;
  private Validator $validator;

  public function __construct(AddTax $addTax, Validator $validator)
  {
    $this->addTax = $addTax;
    $this->validator = $validator;
  }

  public function handle (HttpRequest $httpRequest) : HttpResponse {
    try {
      $requiredFields = ['name', 'value'];
      foreach($requiredFields as $field) {
        if(empty($httpRequest->body[$field])) {
          return new BadRequest(new MissingParamError($field));
        }
      }

      $value = $httpRequest->body['value'];

      if($value <= 0 || $value >= 100 || !$this->validator->isValidaPercentage($value)) {
        return new BadRequest(new InvalidParamError('value'));
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