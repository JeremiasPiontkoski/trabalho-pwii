<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");

/********************************
*      Web Routes               *
********************************/

/* HOME */
$route->namespace("Source\App");
$route->get("/","Web:home");
$route->get("/sobre","Web:about");

/* LOGIN */
$route->post("/login", "Web:login");
$route->get("/login", "Web:login");

/* REGISTER */
$route->post("/registro", "Web:register");
$route->get("/registro", "Web:register");

/* REGISTER FAQ */
$route->post("/registroFaq", "Web:registerFaq");

/* RANDOM */
$route->get("/contato","Web:contact");
$route->post("/contato","Web:contact");

/********************************
 * App Routes                   *
 *******************************/

$route->group("/app");
$route->get("/", "App:home");

/* REGISTER REPOSITORY */
$route->post("/cadastroRepositorio", "App:registerRepository");
$route->get("/cadastroRepositorio", "App:registerRepository");

$route->post("/cadastroProjeto", "App:registerProject");
$route->get("/cadastroProjeto", "App:registerProject");

/* SHOW REPOSITORIES */
$route->get("/repositorios/{idLanguage}", "App:filterRepositories");
$route->get("/repositorios", "App:repositories");

/* SHOW PROJECTS */
$route->get("/projetos/{idProject}", "App:projects");
$route->get("/projetos", "App:showProjects");

/* SPECIFIC REPOSITORY */
$route->get("/repositorio/{idRepositorio}", "App:showRepository");

/* EDIT REPOSITORY */
$route->get("/editarRepositorio/{idRepository}", "App:renderEditRepository");
$route->post("/editarRepositorio/{idRepository}", "App:postEditRepository");

/* LOGOUT */
$route->get("/sair", "App:logout");

$route->get("/profile","App:profile");
$route->post("/profile", "App:editProfile");

$route->group("/admin");
$route->get("/","Adm:home");

$route->get("/registroFaq", "Adm:registerFaq");
$route->post("/registroFaq", "Adm:registerFaq");

$route->get("/editarFaq/{idFaq}", "Adm:editFaq");
$route->post("/editarFaq/{idFaq}", "Adm:postEditFaq");

$route->get("/responderFaq", "Adm:notAnswerFaq");

$route->get("/responderFaq/{idFaq}", "Adm:answerFaq");
$route->post("/responderFaq/{idFaq}", "Adm:postAnswerFaq");

//$route->post("/{idFaq}", "Adm:deleteFaq");
$route->get("/removerFaq/{idFaq}", "Adm:deleteFaq");

$route->group(null);


/* $route->group("/app"); // agrupa em /app
$route->get("/","App:home");
$route->get("/listar","App:list");
$route->get("/pdf","App:createPDF");
$route->group(null); // desagrupo do /app

$route->group("/admin");
$route->get("/","Adm:home");
$route->group(null);

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