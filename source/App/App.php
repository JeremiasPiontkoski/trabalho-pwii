<?php

namespace Source\App;

use League\Plates\Engine;
use JsonException;
use League\Plates\Template\Func;
use Source\Models\Person;
use Source\Models\Language;
use Source\Models\Project;
use Source\Models\User;
use Source\Models\Repository;

class App
{

    private $view;
    private $languages;
    private $repositories;

    public function __construct()
    {
        session_start();
        if(empty($_SESSION["user"])) {
            header("Location:http://www.localhost/trabalho-pwii/login");
        }

        $languages = new Language();
        $this->languages = $languages->selectAll();

        $repositories = new Repository();
        $this->repositories = $repositories->selectAll();

        $this->view = new Engine(CONF_VIEW_APP,'php');
        //$this->view = new Engine(__DIR__ . "/../../themes/web",'php');
    }

    /* public function home () : void 
    {
        echo $this->view->render("repositories");
    } */

    public function list () : void 
    {
        echo $this->view->render("list",
    [
        "user" => $_SESSION["user"]
    ]);
    }

    public function createPDF () : void
    {
       require __DIR__ . "/../../themes/app/create-pdf.php";
    }

    public function registerRepository(array $data) : void
    {
        if(!empty($data)){

            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "warning",
                ];
                echo json_encode($json);
                return;
            }

            $language = new Language();
            $languages = $language->selectByLanguage($data["language"]);
        
                $repository = new Repository(
                    null,
                    $data["name"],
                    $data["language"],
                    $data["description"],
                    $languages->id
                );

                if($repository->insert()) {
                    $json = [
                        "name" => $data["name"],                        
                        "type" => "success"
                    ];
                    echo json_encode($json);
                    return;
                }

                echo json_encode($repository->getName());
                return;

        
        }
        
        echo $this->view->render("register-repository",[
            "languages" => $this->languages
        ]);
    }

    public function repositories(?array $data) : void
    {
        if(!empty($data)){
            $repository = new Repository();
            $repositories = $repository->findByIdLanguage($data["idLanguage"]);
        }
        echo $this->view->render(
            "filterRepositories",[
                "languages" => $this->languages,
                "repositories" => $repositories
            ]
        );
    }

    public function showRepositories() : void
    {        
        echo $this->view->render("repositories", 
        [
            "languages" => $this->languages,
            "repositories" => $this->repositories
        ]);
    }

    public function home() {
        echo $this->view->render("home", 
    [
        "user" => $_SESSION["user"],
        "repositories" => $this->repositories
    ]);
    }

    public function logout() {
        session_destroy();
        setcookie("user", "Logout", time() -3600, "/");
        header("Location:http://www.localhost/trabalho-pwii/login");
    }
}