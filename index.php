<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");
//$route = new Router('localhost/acme-tarde', ":"); // Route para localhost

/**
 * Web Routes
 */

$route->namespace("Source\App");
$route->get("/","Web:home");
$route->get("/sobre","Web:about");

$route->post("/login", "Web:entrada");
$route->get("/login", "Web:entrada");

/* $route->post("/cadastro", "Web:register");
$route->get("/cadastro", "Web:register"); */

$route->post("/registro", "Web:register");
$route->get("/registro", "Web:register");

$route->post("/home", "App:home");
$route->get("/home", "App:home");

$route->post("/cadastroRepositorio", "App:registerRepository");
$route->get("/cadastroRepositorio", "App:registerRepository");



$route->get("/contato","Web:contact");
$route->post("/contato","Web:contact");


$route->get("/repositorios/{idLanguage}", "App:repositories");
$route->get("/repositorios", "App:showRepositories");

$route->get("/sair", "App:logout");
$route->post("/sair", "App:logout");

/**
 * App Routs
 */

$route->group("/app"); // agrupa em /app
$route->get("/","App:home");
$route->get("/listar","App:list");
$route->get("/pdf","App:createPDF");
$route->group(null); // desagrupo do /app

$route->group("/admin"); // agrupa em /admin
$route->get("/","Adm:home");
$route->group(null); // desagrupo do /admin

/*
 * Erros Routes
 */

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

/*
 * Error Redirect
 */

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();