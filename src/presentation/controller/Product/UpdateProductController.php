<?php

class UpdateProductController implements Controller {
  private UpdateProduct $updateProduct;
  private Validator $validator;

  public function __construct(UpdateProduct $updateProduct, Validator $validator)
  {
    $this->updateProduct = $updateProduct;
    $this->validator = $validator;
  }

  public function handle (HttpRequest $httpRequest) : HttpResponse {
    try {
      $requiredFields = ['id', 'name', 'value', 'type'];
      $body = $httpRequest->body;
      foreach($requiredFields as $field) {
        if(empty($body[$field])) {
          return new BadRequest(new MissingParamError($field));
        }
      }

      $value = $body['value'];

      if($value <= 0 || !$this->validator->isValidCurrency($value)) {
        return new BadRequest(new InvalidParamError('value'));
      }

      $this->updateProduct->update(new Product($body['id'], $body['name'], $body['value'], $body['type']));

      return new Ok(['message' => 'Successfully updated']);
    } catch(DomainError $de) {
      return new Conflict(['error' => $de->getMessage()]);
    } catch(Exception $e) {
      return new ServerError();
    }
  }
}