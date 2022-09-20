<?php

namespace Source\App;

use JsonException;
use League\Plates\Engine;
use Source\Models\Person;
use Source\Models\User;

class Web
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(CONF_VIEW_WEB,'php');
        //$this->view = new Engine(__DIR__ . "/../../themes/web",'php');
    }

    public function home() : void
    {
        $user = new User(2);
        $user->findById();
        //var_dump($user);

        echo $this->view->render(
            "home",["user" => $user]);
    }

    public function about() : void
    {      
        echo $this->view->render("about");
    }

    public function contact(array $data) : void
    {
        /* var_dump($data); */
        echo $this->view->render("contact");
    }

    public function error(array $data) : void
    {
        echo $this->view->render("404", [
            "title" => "Erro {$data["errcode"]} | " . CONF_SITE_NAME,
            "error" => $data["errcode"]
        ]);
    }

    public function insertUser($user, $data)
    {
        if(!$user->insertPerson()){
            $json = [
                "message" => $user->getMessage(),
                "type" => "error"
            ];
            return $json;
        }else {
            $json = [
                "name" => $data["name"],
                "message" => $user->getMessage(),
                "type" => "success"
            ];
            return $json;
        }
    }

    public function insertCompany($user, $data)
    {   
        if(!$user->insertCompany()){
            $json = [
                "message" => $user->getMessage(),
                "type" => "error"
            ];
            return $json;
        }else {
            $json = [
                "name" => $data["name"],
                "message" => $user->getMessage(),
                "type" => "success"
            ];
            return $json;
        }
    }

    public function register(?array $data) : void
    {
        if(!empty($data)){

            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "warning"
                ];

                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();

            if($user->findByEmail($data["email"])){
                $json = [
                    "message" => "Email já cadastrado!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(strlen($data["password"]) < 8){
                $json = [
                    "message" => "A senha deve ter no mínimo 8 caracteres",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if($data["password"] != $data["confirmPassword"]) {
                $json = [
                    "message" => "As senhas devem ser idênticas!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if($data["language"] == ""){
                $json = [
                    "message" => "Escolha uma Linguagem!",
                    "type" => "warning"
                ];

                echo json_encode($json);
                return;
            }

            if($data["description"] == "") {
                $json = [
                    "message" => "Preencha a Descrição!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User(
                null,
                $data["name"],
                $data["email"],
                $data["password"]
            );

            $person = new Person(
                null,
                $user->insert(),
                $data["language"],
                $data["description"]
            );

            if(!$person->insertPerson()){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "name" => $data["name"],
                    "message" => $user->getMessage(),
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }

        /*     if($data["user"] == "person") {
                echo json_encode($this->insertUser($user, $data));
                return;
            }

            if($data["user"] == "company") {
                echo json_encode($this->insertCompany($user, $data));
                return;
            } */

            // Usuário salvo com sucesso
            return;
        }

        echo $this->view->render("register",["eventName" => CONF_SITE_NAME]);
    }

    public function login(?array $data) : void
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "Informe e-mail e senha para entrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();
            $person = new Person();

            if(!$user->validate($data["email"],$data["password"])){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }else if(!$person->getDataUser($user->getId())) {
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "idUser" => $person->getIdUser(),
                "message" => $user->getMessage(),
                "type" => "success"
            ];
            echo json_encode($json);
            return;

        }

        echo $this->view->render("login",["eventName" => CONF_SITE_NAME]);
    }
}