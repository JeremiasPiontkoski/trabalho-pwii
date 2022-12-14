<?php

namespace Source\App;

use Source\Models\Company;
use Source\Models\Person;
use Source\Models\Project;
use Source\Models\Repository;
use Source\Models\typeUser;
use Source\Models\User;

class Api
{

    private $user;
    private $person;
    private $company;
    private $typeUser;

    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');
        $headers = getallheaders();
        $this->user = new User();
        $this->person = new Person();
        $this->company = new Company();
        $this->typeUser = new typeUser();

        if($headers["Rule"] === "N") {
            return;
        }

        if(empty($headers["Email"]) || empty($headers["Password"]) || empty($headers["Rule"])){
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Por favor, informe Email e Senha"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        if(!$this->user->validate($headers["Email"],$headers["Password"])){
            $response = [
                "code" => 401,
                "type" => "unauthorized",
                "message" => "E-mail ou Senha inválidos"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function getUser()
    {
        if($this->user->getId() != null) {
            if($this->user->getTypeUser() == 1) {
                $this->person->setIdUser($this->user->getId());
                echo json_encode($this->person->getDataPerson(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            if($this->user->getTypeUser() == 2) {
                $this->company->setIdUser($this->user->getId());
                echo json_encode($this->company->getDataCompany(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }
//            echo json_encode($this->user->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    public function getUsers(array $data)
    {
        if($data["typeUser"] == 1) {
            echo json_encode($this->person->getAll(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        if($data["typeUser"] == 2) {
            echo json_encode($this->company->getAll(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function updateUser(array $data) : void
    {
        if($this->user->getId() != null) {
            $this->user->setName($data["name"]);
            $this->user->setDescription($data["description"]);
            $this->user->update();
            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Usuário alterado com sucesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function createUser(array $data) : void
    {
        echo json_encode($data);
        $this->typeUser->setId($data["typeUser"]);

        if($this->user->findByEmail($data["email"]))
        {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Email já cadastrado"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $this->user->setName($data["name"]);
        $this->user->setEmail($data["email"]);
        $this->user->setPassword($data["password"]);
        $this->user->setTypeUser($data["typeUser"]);
        $idUser = $this->user->insert();

        if($data["typeUser"] == 1) {
            $this->person->setIdUser($idUser);
            $this->person->insert();
        }

        if($data["typeUser"] == 2) {
            $this->company->setIdUser($idUser);
            $this->company->insert();
        }

        $response = [
            "code" => 200,
            "type" => "success",
            "message" => "Usuário cadastrado com sucesso"
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
    }

    public function createPerson(array $data) : void
    {
        $this->person->setIdUser($data["idUser"]);
        $this->person->insert();

        $response = [
            "code" => 200,
            "type" => "success",
            "message" => "Pessoa cadastrada com sucesso!"
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function getRepository(array $data)
    {
        if(!empty($data["idRepository"])) {
            $repository = new Repository();
            if(!$repository->findById($data["idRepository"])) {
                $response = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Projeto não cadastrado..."
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Repositório encontrado...",
                "repository" => [
                    "id" => $repository->getId(),
                    "name" => $repository->getName(),
                    "description" => $repository->getDescription()
                ]
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    public function getRepositories()
    {
        $repository = new Repository();
        $this->person->getDataUser($this->user->getId());

        if(!$repository->findByIdPerson($this->person->getId())) {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Este usuário não possui projetos ainda..."
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $response = [
            "code" => 200,
            "type" => "success",
            "message" => "Repositorios encontrados com sucesso...",
            "repositories" => $repository->findByIdPerson($this->person->getId())
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

