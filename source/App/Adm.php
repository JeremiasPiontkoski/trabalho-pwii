<?php

namespace Source\App;

use http\Encoding\Stream\Enbrotli;
use JsonException;
use League\Plates\Engine;
use Source\Models\Admin;
use Source\Models\Faq;
use Source\Models\Language;
use Source\Models\Person;
use Source\Models\Repository;
use Source\Models\User;

class Adm
{
    private $view;

    public function __construct()
    {
       session_start();
       if(empty($_SESSION["admin"])) {
           header("Location:http://www.localhost/trabalho-pwii/login");
       }

        $this->view = new Engine(CONF_VIEW_ADMIN, 'php');
    }

    public function getResponseRepositories($dataRepository)
    {
        $user = new User();
        $repositories = [];
        foreach($dataRepository as $repository) {
            $user->setIdPerson($repository->idPerson);
            $dataUser = $user->findByIdPerson();

            $response = [
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
            ];
            $repositories[] = $response;            
        }
        return $repositories;
    }

    public function home () : void
    {
        $language = new Language();
        echo $this->view->render("home",[
            "languages" => $language->selectAll()
        ]);
    }

    public function faqs() {
        $faq = new Faq();
        echo $this->view->render("faqs",[
            "faqs" => $faq->getAll()
        ]);
    }

    public function answeredFaqs() {
        $faq = new Faq();
        echo $this->view->render("answeredFaqs",[
            "faqs" => $faq->getAllAnswered()
        ]);
    }

    public function registerFaq(array $data)
    {
        if(!empty($data)) {
            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "danger"
                ];
                echo json_encode($json);
                return;
            }

            $adm = new Admin();
            $faq = new Faq(
                null,
                $_SESSION["admin"]["name"],
                $_SESSION["admin"]["email"],
                $data["question"],
                $data["answer"]
            );

            $faq->insert();

            $json = [
                "message" => "Faq criada com sucesso!",
                "type" => "success"
            ];
            echo json_encode($json);
            return;
        }
        echo $this->view->render("createFaq");
    }

    public function editFaq() {
        $faq = new Faq();
        echo $this->view->render("editFaq", [
            "faq" => $faq->getById($_GET["id"])
        ]);
    }

    public function postEditFaq(array $data)
    {
        if(!empty($data)) {
            if(in_array("", $data)){
                $json = [
                    "message" => "Preencha todos os campos",
                    "type" => "danger"
                ];
                echo json_encode($json);
                return;
            }

            $faq = new Faq();

            $faq->setId($_GET['id']);
            $faq->setQuestion($data["question"]);
            $faq->setAnswer($data["answer"]);

            $faq->update();

            $json = [
                "message" => "Faq alterada com sucesso",
                "type" => "success"
            ];

            echo json_encode($json);
            return;
        }
    }

    public function notAnswerFaq() {
        $faq = new Faq();
        echo $this->view->render("notAnswerFaq", [
            "faqs" => $faq->getAllNotAnswered()
        ]);
    }

    public function answerFaq() {
        $faq = new Faq();
        echo $this->view->render("answerFaq", [
            "faq" => $faq->getById($_GET["id"])
        ]);
    }

    public function postAnswerFaq(array $data) {
        if(!empty($data)) {
            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $faq = new Faq();
            $dataFaq = $faq->getById($_GET['id']);

            $faq->setId($dataFaq->id);
            $faq->setUserName($dataFaq->userName);
            $faq->setUserEmail($dataFaq->userEmail);
            $faq->setQuestion($dataFaq->question);
            $faq->setAnswer($data["answer"]);

            $faq->update();

            $json = [
                "message" => "Faq respondida com sucesso!",
                "type" => "success"
            ];
            echo json_encode($json);
            return;
        }
    }

    public function deleteFaq(){
        $faq = new Faq();
        $faq->setId($_GET['id']);
        $faq->delete();

        header("Location:http://www.localhost/trabalho-pwii/admin/faqs");
    }

    public function registerAdm(array $data) {
        if(!empty($data)) {
            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
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

            $adm = new Admin();
            $adm->setName($data["name"]);
            $adm->setEmail($data["email"]);
            $adm->setPassword($data["password"]);

            if($adm->findByEmail()) {
                $json = [
                    "message" => "Email já cadastrado",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(strlen($adm->getPassword()) < 10) {
                $json = [
                    "message" => "A senha deve conter no mínimo 10 caracteres!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if($adm->getPassword() != $data["confirmPassword"]) {
                $json = [
                    "message" => "As senhas devem ser identicas!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $adm->insert();

            $json = [
                "message" => "Administrador cadastrado com sucesso",
                "type" => "success"
            ];

            echo json_encode($json);
            return;
        }

        echo $this->view->render("registerAdm");
    }

    public function repositories() {
        $repository = new Repository();
        $dataRepository = $repository->selectAll();
        $repositories = $this->getResponseRepositories($dataRepository);

        echo $this->view->render("repositories", [
            "repositories" => $repositories
        ]);
    }

    public function filterRepositories(array $data) {
        $repository = new Repository();
        $repository->setIdLanguage($data["idLanguage"]);
        $dataRepositories = $repository->findByIdLanguage();

        if($dataRepositories != null) {
            $repositories = $this->getResponseRepositories($dataRepositories);
        }

        echo $this->view->render("filterRepositories", [
            "repositories" => $repositories
        ]);
    }

    public function users() {
        $person = new Person();
        echo $this->view->render("users",
        [
            "users" => $person->selectAll()
        ]);
    }
}