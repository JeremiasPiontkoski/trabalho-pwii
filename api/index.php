<?php

ob_start();

require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

$route->namespace("Source\App");

// users
$route->get("/user","Api:getUser");
$route->get("/users/{typeUser}", "Api:getUsers");
$route->put("/user/name/{name}/description/{description}", "Api:updateUser");
$route->post("/user/name/{name}/email/{email}/password/{password}/typeUser/{typeUser}", "Api:createUser");
$route->get("/user/repository/{idRepository}", "Api:getRepository");
$route->get("/user/repositories", "Api:getRepositories");

$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
ob_end_flush();