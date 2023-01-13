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

//ADD AFTER PROFILE PICTURE
$route->put("/pessoa/name/{name}/email/{email}/description/{description}/cpf/{cpf}/idLanguage/{idLanguage}", "Api:updatePerson");
$route->put("/empresa/name/{name}/email/{email}/description/{description}/cnpj/{cnpj}/type/{type}", "Api:updateCompany");

$route->post("/user/name/{name}/email/{email}/password/{password}/typeUser/{typeUser}", "Api:createUser");

$route->get("/repository/{idRepository}", "Api:getRepository");
$route->get("/repositories/{idLanguage}", "Api:getReposotiesByIdLanguage");
$route->get("/repositoriesByPerson", "Api:getRepositoriesByPerson");

$route->get("/repositories", "Api:getRepositories");

$route->get("/getRepo", "ApiTest:getRepositories");
$route->get("/getRepository/{idRepository}", "ApiTest:getRepository");

$route->get("/getLanguage/{idLanguage}", "Api:getLanguage");

$route->post("/createRepository/name/{name}/description/{description}/idLanguage/{idLanguage}", "Api:createRepository");
$route->put("/uploadRepository/name/{name}/description/{description}/idLanguage/{idLanguage}/idRepository/{idRepository}", "Api:uploadRepository");

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