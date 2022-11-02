<?php

namespace Source\App;

use JsonException;
use LDAP\Result;
use League\Plates\Engine;
use Source\Models\Company;
use Source\Models\Language;
use Source\Models\Person;
use Source\Models\Type;
use Source\Models\typeUser;
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

    public function register(?array $data){
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

            $user = new User(
                null,
                $data["name"],
                $data["email"],
                $data["password"],
                $data["description"],
                $data["userType"]
            );

            if($data["userType"] == '1') {
                if(strlen($data["cpf"]) != 11) {
                    $json = [
                        "message" => "O cpf deve conter 11 dígitos",
                        "type" => "warning"
                    ];
                    echo json_encode($json);
                    return;
                }

                $person = new Person(
                    null,
                    $user->insert(),
                    $data["cpf"],
                    $data["language"]
                );
    
                if($person->insert()) {
                    $json = [
                        "message" => "Cadastro",
                        "password" => $data['password'],
                        "type" => "warning"
                    ];
                    echo json_encode($json);
                    return;
                }
            }else {
                
            if(strlen($data["cnpj"]) != 14) {
                $json = [
                    "message" => "O cnpj deve conter 14 dígitos",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }
            
                $company = new Company(
                    null, 
                    $user->insert(),
                    $data["cnpj"],
                    $data["typeDevelopment"]
                );

                if($company->insert()) {
                    $json = [
                        "message" => "Cadastro",
                        "type" => "warning"
                    ];
                    echo json_encode($json);
                    return;
                }
            }
        }
 

        $language = new Language();
        $languages = $language->selectAll();

        $type = new Type();
        $types = $type->selectAll();

        $typeUser = new typeUser();
        $typeUsers = $typeUser->selectAll();

        echo $this->view->render("register",
    [
        "languages" => $languages,
        "types" => $types,
        "typeUsers" => $typeUsers
    ]);
    }

    public function entrada(?array $data) : void 
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "Informe e-mail e senha para entrar!",
                    "type" => "danger"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();
            $person = new Person();
            $company = new Company();

            if(!$user->validate($data["email"], $data["password"])) {
                $json = [
                "message" => "Usuário e/ou senha inválidos",
                "type" => "danger"
                ];
                echo json_encode($json);
                return;
            }

            if($person->getDataUser($user->getId())) {
                $json = [
                    "message" => "Acesso disponível",
                    "type" => "success",
                    "typeUser" => "person"
                ];
                echo json_encode($json);
                return;
            }

            if($company->getDataCompany($user->getId())) {
                $json = [
                    "message" => "Acesso disponível",
                    "type" => "success",
                    "typeUser" => "company"
                ];
                echo json_encode($json);
                return;
            }
        }
        echo $this->view->render("login",["eventName" => CONF_SITE_NAME]);
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

            if($data["email"] != 14 || !is_email($data["email"])) {
                $json = [
                    "message" => "Este usuáiro não existe",
                    "type" => "danger"
                ];
            }

            if($data["email"] == 14) {
                $json = [
                    "type" => "Person"
                ];

                echo json_encode($json);
                return;
            }

            if(is_email($data["email"])) {
                $json = [
                    "type" => "Company"
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