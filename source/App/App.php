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
    // private $typeUser;

    private $user;
    private $person;
    private $language;
    private $repository;
    private $typeUser;

    public function __construct()
    {
        session_start();
        if(empty($_SESSION["user"])) {
            header("Location:http://www.localhost/trabalho-pwii/login");
        }

        $this->language = new Language();
        $this->typeUser = new typeUser();
        $this->user = new User();
        $this->person = new Person();
        $this->repository = new Repository();

        if(!empty($_SESSION["userCompany"])){
            $postProjects = new Project();
            $this->postProjects = $postProjects->findPostProjects($_SESSION["userCompany"]["id"]);
        }
        

        $postRepositories = new Repository();
        $this->postRepositories = $postRepositories->findAllPostRepositories();

        $this->view = new Engine(CONF_VIEW_APP,'php');
        //$this->view = new Engine(__DIR__ . "/../../themes/web",'php');
    }

    public function getResponsePerson()
    {
        $this->person->setIdUser($_SESSION["user"]["id"]);
        $dataPerson = $this->person->getDataPerson();

        $responsePerson = [
            "user" => [
                "id" => $_SESSION["user"]["id"],
                "name" => $dataPerson->name,
                "email" => $dataPerson->email,
                "description" => $dataPerson->description,
                "photo" => $dataPerson->profilePicture,
                "idTypeUser" => $dataPerson->typeUser,
                "typeUser" => $dataPerson->type,
                "person" => [
                    "cpf" => $dataPerson->cpf,
                    "idLanguage" => $dataPerson->idLanguage
                ]
            ]
        ];

        return $responsePerson;
    }

    public function getResponseRepositoriesByIdPerson()
    {
        $this->person->getDataUser($_SESSION["user"]["id"]);
        $this->repository->setIdPerson($this->person->getId());
        $dataRepositories = $this->repository->findByIdPerson();
        $repositories = [];

        foreach($dataRepositories as $repository) {
            $response = [
                "repository" => [
                    "id" => $repository->idRepository,
                    "idPerson" => $repository->idPerson,
                    "name" => $repository->name,
                    "description" => $repository->description,
                    "idLanguage" => $repository->idLanguage,
                    "language" => $repository->language
                ]
            ];

            $repositories[] = $response;
        }
       
        return $repositories;
    }

    public function getResponseRepositories($dataRepository)
    {
        $repositories = [];
        foreach($dataRepository as $repository) {
            $this->user->setIdPerson($repository->idPerson);
            $dataUser = $this->user->findByIdPerson();

            $response = [
                "repository" => [
                    "id" => $repository->idRepository,
                    "idPerson" => $repository->idPerson,
                    "name" => $repository->name,
                    "description" => $repository->description,
                    "idLanguage" => $repository->idLanguage,
                    "language" => $repository->language,
                    "user" => [
                        "id" => $dataUser->id,
                        "name" => $dataUser->name,
                        "email" => $dataUser->email,
                        "description" => $dataUser->description,
                        "photo" => $dataUser->profilePicture
                    ]
                ]
            ];

            $repositories[] = $response;            
        }
        return $repositories;
    }

    public function home() {
        echo $this->view->render("home",
        [
            "user" => $this->getResponsePerson(),
            "languages" => $this->language->selectAll(),
            "repositories" => $this->getResponseRepositoriesByIdPerson()
        ]);
    }

    public function profile () : void 
    {
        echo $this->view->render("profile",
        [
            "user" => $this->getResponsePerson(),
            "languages" => $this->language->selectAll()
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

//                 $json = [
//                     "id" => $user->getId(),
//                     "name" => $user->getName(),
//                     "email" => $user->getEmail(),
//                     "description" => $user->getDescription(),
//                     "language" => $person->getIdLanguage(),
//                     "image" => url($user->getImage()),
//                     "type" => "success",
//                     "message" => "Dados Alteradoso como sucesso!"
//                 ];

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

            $postRepo = new Repository(
                $repository->insert(),
                null,
                null,
                $data["language"],
                $_SESSION['userPerson']['id']
            );

            if(!$postRepo->insertPostRepositories()) {
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
            "languages" => $this->language->selectAll()
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
            "languages" => $this->language->selectAll()
        ]);
    }

    public function repositories(?array $data) : void
    {
        $this->repository->setIdLanguage($data["idLanguage"]);
        $dataRepositories = $this->repository->findByIdLanguage();

        if($dataRepositories != null) {
            $repositories = $this->getResponseRepositories($dataRepositories);
        }

        echo $this->view->render(
            "filterRepositories",[
                "languages" => $this->language->selectAll(),
                "repositories" => $repositories
            ]
        );
    }

    public function showRepositories() : void
    {
        $dataRepository = $this->repository->selectAll();
        $repositories = $this->getResponseRepositories($dataRepository);
        
        
        echo $this->view->render("repositories", [
            "languages" => $this->language->selectAll(),
            "repositories" => $repositories
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
        $this->repository->setId($_GET["id"]);
        $repository = $this->repository->findById();

        $this->user->setIdPerson($repository->idPerson);
        $dataUser = $this->user->findByIdPerson();

        $response = [
            "repository" => [
                "id" => $repository->idRepository,
                "idPerson" => $repository->idPerson,
                "name" => $repository->name,
                "description" => $repository->description,
                "idLanguage" => $repository->idLanguage,
                "language" => $repository->language,
                "user" => [
                    "id" => $dataUser->id,
                    "name" => $dataUser->name,
                    "email" => $dataUser->email,
                    "description" => $dataUser->description,
                    "photo" => $dataUser->profilePicture
                ]
            ]
        ];
        echo $this->view->render("repository", [
            "eventName" => CONF_SITE_NAME,
            "repository" => $response
        ]);
    }

    public function renderEditRepository() {
//        $repository = Repository::findById($_GET["id"]);
        // $repository = new Repository();
        // $language = new Language();


        $this->repository->setId($_GET["id"]);
        $repository = $this->repository->findById();

        $this->user->setIdPerson($repository->idPerson);
        $dataUser = $this->user->findByIdPerson();

        $response = [
            "repository" => [
                "id" => $repository->idRepository,
                "idPerson" => $repository->idPerson,
                "name" => $repository->name,
                "description" => $repository->description,
                "idLanguage" => $repository->idLanguage,
                "language" => $repository->language,
                "user" => [
                    "id" => $dataUser->id,
                    "name" => $dataUser->name,
                    "email" => $dataUser->email,
                    "description" => $dataUser->description,
                    "photo" => $dataUser->profilePicture
                ]
            ]
        ];

        echo $this->view->render("editRepository", [
            "eventName" => CONF_SITE_NAME,
            "repository" => $response,
//            "language" => Language::findById($repository->idLanguage)
            "languages" => $this->language->selectAll()
        ]);
    }

    public function postEditRepository(array $data) {
        if(!empty($data)) {
            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "warning",
                ];
                echo json_encode($json);
                return;
            }

            $repository = new Repository(
                $_GET["id"],
                $data["name"],
                $data["description"],
                $data["idLanguage"]
            );

            $repository->update();

            $json = [
                "message" => "Repositório alterado com sucesso!",
                "type" => "success"
            ];
            echo json_encode($json);
            return;
        }
    }
}