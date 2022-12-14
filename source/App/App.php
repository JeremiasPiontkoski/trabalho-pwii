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
use Source\Models\Type;
use Source\Models\typeUser;

class App
{
    private $view;
    private $languages;
    private $repositories;
    private $projects;
    private $postProjects;
    private $postRepositories;
    private $typeUser;

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

        $projects = new Project();
        $this->projects = $projects->selectAll();

        $typeUser = new Type();
        $this->typeUser = $typeUser->selectAll();

        if(!empty($_SESSION["userCompany"])){
            $postProjects = new Project();
            $this->postProjects = $postProjects->findPostProjects($_SESSION["userCompany"]["id"]);
        }
        

        $postRepositories = new Repository();
        $this->postRepositories = $postRepositories->findAllPostRepositories();

        $this->view = new Engine(CONF_VIEW_APP,'php');
        //$this->view = new Engine(__DIR__ . "/../../themes/web",'php');
    }

    public function home() {

        $project = new Project();
        $projects = $project->findById();

        $repository = new Repository();
        $project = new Project();

        echo $this->view->render("home",
            [
                "user" => $_SESSION["user"],
                "repositories" => $repository->findByIdPerson($_SESSION["userPerson"]["id"]),
                "languages" => $this->languages,
                "projects" => $project::findByIdCompany(),
                "postProjects" => $this->postProjects
            ]);
    }

    public function profile () : void 
    {
        $person = new Person();
        $personData = $person->getDataUser($_SESSION['user']["id"]);
        echo $this->view->render("profile",
    [
        "user" => $_SESSION["user"],
        "languages" => $this->languages,
        "typeUser" => $this->typeUser
    ]);
    }

    public function editProfile(array $data) {
        if(!empty($data)) {

            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])) {
                $json = [
                    "message" => "Informe um email válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!empty($_FILES['image']['tmp_name'])) {
                $upload = uploadImage($_FILES['image']);
                unlink($_SESSION["user"]["image"]);
            }else {
                $upload = $_SESSION["user"]["image"];
            } 

           $user = new User(
                $_SESSION["user"]["id"],
                $data["name"],
                $data["email"],
                null,
                $data["description"],
                $_SESSION["user"]["typeUser"],
                $upload
            );

            if(!$user->update()) {
                $json = [
                    "message" => "Não foi possivel fazer a alteração, tente novamente!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!empty($_SESSION["userPerson"])) {
                $person = new Person(
                    $_SESSION["userPerson"]["id"],
                    $_SESSION["userPerson"]["idUser"],
                    $data["cpf"],
                    $data["language"]
                );
                $person->update();
                $json = [
                    "message" => "Dados alterados com sucesso!",
                    "image" => url($user->getImage()),
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
            // $json = [
            //     "id" => $user->getId(),
            //     "name" => $user->getName(),
            //     "email" => $user->getEmail(),
            //     "description" => $user->getDescription(),
            //     "language" => $person->getIdLanguage(),
            //     "image" => url($user->getImage()),
            //     "type" => "success",
            //     "message" => "Dados Alteradoso como sucesso!"
            // ];
            
        }
    }

    public function createPDF () : void
    {
       require __DIR__ . "/../../themes/app/create-pdf.php";
    }

    public function registerRepository(array $data) : void
    {

        if(empty($_SESSION["userPerson"])) {
            header("Location:http://www.localhost/trabalho-pwii/app");
        }

        if(!empty($data)){
            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "warning",
                ];
                echo json_encode($json);
                return;
            }
        
            $repository = new Repository(
                null,
                $data["name"],
                $data["description"],
                $data["language"],
                $_SESSION['userPerson']['id']
            );

            if(!$repository->insertPostRepositories($repository->insert())) {
                $json = [
                    "message" => "Não foi possivel realizar o cadastro, tente novamente!",                        
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "message" => "Cadastro realizado com sucesso",
                "type" => "success"
            ];
            echo json_encode($json);
            return;
        }
        
        echo $this->view->render("register-repository",[
            "languages" => $this->languages
        ]);
    }

    public function registerProject(?array $data) :void {

        if(empty($_SESSION["userCompany"])) {
            header("Location:http://www.localhost/trabalho-pwii/app");
        }

        if(!empty($data)) {
            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "warning",
                ];
                echo json_encode($json);
                return;
            }
        
            $project = new Project(
                null,
                $data["name"],
                $data["description"],
                $data["vacancies"],
                $data["language"],
                $_SESSION['userCompany']['id']
            );

            if(!$project->insertPostProjects($project->insert())) {
                $json = [
                    "message" => "Não foi possivel realizar o cadastro, tente novamente!",                        
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "message" => "Cadastro realizado com sucesso",
                "type" => "success"
            ];
            echo json_encode($json);
            return;
        }

        echo $this->view->render("registerProject",[
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
        $repository = new Repository();
        echo $this->view->render("repositories", 
        [
            "languages" => $this->languages,
            "repositories" => $repository->findByIdPerson($_SESSION["userPerson"]["id"]),
            "postRepositories" => $this->postRepositories
        ]);
    }

    public function projects(?array $data) : void
    {
        if(!empty($data)){
            $project = new Project();
            $projects = $project->findByIdLanguage($data["idProject"]);
        }

        echo $this->view->render(
            "filterProjects",[
                "languages" => $this->languages,
                "projects" => $projects
            ]
        );
    }

    public function showProjects() : void
    {        
        echo $this->view->render("projects", 
        [
            "languages" => $this->languages,
            "projects" => $this->projects
        ]);
    }

    public function logout() {
        session_destroy();
        setcookie("user", "Logout", time() -3600, "/");
        header("Location:http://www.localhost/trabalho-pwii/login");
    }

    public function showRepository(){
        $repository = Repository::findById($_GET["id"]);
        echo $this->view->render("repository", [
            "eventName" => CONF_SITE_NAME,
            "repository" => $repository,
            "language" => Language::findById($repository->idLanguage)
        ]);
    }

    public function renderEditRepository() {
        $repository = Repository::findById($_GET["id"]);
        echo $this->view->render("editRepository", [
            "eventName" => CONF_SITE_NAME,
            "repository" => $repository,
            "language" => Language::findById($repository->idLanguage)
        ]);
    }
}