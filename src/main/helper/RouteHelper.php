<?php

class RouteHelper {
  public static function route(Controller $controller) : void {
    $body = json_decode(file_get_contents('php://input'), true);

    $response = $controller->handle(new HttpRequest($body));

    http_response_code($response->statusCode);
    echo json_encode($response->body);
  }
}