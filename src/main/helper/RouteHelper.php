<?php

class RouteHelper {
  public static function route(Controller $controller) : void {
    $input = file_get_contents('php://input');
    $body = [];
    if(!empty($input)) {
      $body = json_decode($input, true);
      $body = array_map('trim', $body);
    }

    $response = $controller->handle(new HttpRequest($body));

    http_response_code($response->statusCode);
    echo json_encode($response->body);
  }
}