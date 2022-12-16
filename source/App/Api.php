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
    private $repository;
    private $headers;

    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');
        $this->headers = getallheaders();
        $this->user = new User();
        $this->person = new Person();
        $this->company = new Company();
        $this->typeUser = new typeUser();
        $this->repository = new Repository();

        if($this->headers["Rule"] === "N") {
            return;
        }

        if(empty($this->headers["Email"]) || empty($this->headers["Password"]) || empty($this->headers["Rule"])){
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Por favor, informe Email e Senha"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        if(!$this->user->validate($this->headers["Email"],$this->headers["Password"])){
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
        }
    }

    public function getUsers(array $data)
    {
        if($this->user->getId() != null){
            if($data["typeUser"] == 1) {
                echo json_encode($this->person->getAll(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            if($data["typeUser"] == 2) {
                echo json_encode($this->company->getAll(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }
        }
    }

    public function createUser(array $data) : void
    {
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
        return;
    }

    public function createRepository(array $data)
    {
        if($this->user->getId() != null){
            if($this->headers["Rule"] != "P"){
                $response = [
                    "code" => 401,
                    "type" => "unauthorized",
                    "message" => "Usuário não autorizado"
                ];
                echo json_encode($response);
                return;
            }

            $this->person->getDataUser($this->user->getId());

            $this->repository->setName($data["name"]);
            $this->repository->setDescription($data["description"]);
            $this->repository->setIdLanguage($data["idLanguage"]);

            $idRepostiry = $this->repository->insert();
            $this->repository->setId($idRepostiry);
            $this->repository->setIdPerson($this->person->getId());
            $this->repository->insertPostRepositories();

            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Repositório cadastrado com sucesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function getRepository(array $data)
    {
        if($this->user->getId() != null){
            if(!empty($data["idRepository"])) {
                $repository = new Repository();
                $dataRepository = $repository->findById($data["idRepository"]);
                if(!$dataRepository) {
                    $response = [
                        "code" => 400,
                        "type" => "bad_request",
                        "message" => "Projeto não cadastrado"
                    ];
                    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    return;
                }

                $response = [
                    "repository" => [
                        "id" => $dataRepository->id,
                        "idPerson" => $dataRepository->idPerson,
                        "name" => $dataRepository->name,
                        "description" => $dataRepository->description,
                        "idLanguage" => $dataRepository->idLanguage,
                        "language" => $dataRepository->language
                    ]
                ];

                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }
        }
    }

    public function getRepositories()
    {
        if($this->user->getId() != null){
            $repository = new Repository();
            echo json_encode($repository->selectAll());
            return;
        }
    }

    public function getRepositoriesByPerson()
    {
        if($this->user->getId() != null){
            $repository = new Repository();
            $this->person->getDataUser($this->user->getId());

            $dataRepository = $repository->findByIdPerson($this->person->getId());

            if(!$dataRepository) {
                $response = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Este usuário não possui projetos ainda"
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            echo json_encode($dataRepository, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function updateUser(array $data) : void
    {
        $response = [
            "data" => $data,
            "idUser" => $this->user->getId()
        ];
        echo json_encode($response);
        return;
//        if($this->user->getId() != null) {
//            $this->user->setName($data["name"]);
//            $this->user->setDescription($data["description"]);
//            $this->user->update();
//            $response = [
//                "code" => 200,
//                "type" => "success",
//                "message" => "Usuário alterado com sucesso!"
//            ];
//            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//            return;
//        }
    }

    public function updatePerson(array $data)
    {
        if($this->user->getId() != null) {
            if($this->headers["Rule"] != "P") {
                $response = [
                    "code" => 401,
                    "type" => "unauthorized",
                    "message" => "Usuário não autorizado"
                ];
                echo json_encode($response);
                return;
            }

            if($this->user->findByEmail($data["email"]))
            {
                $response = [
                    "code" => 401,
                    "type" => "unauthorized",
                    "message" => "Email já cadastrado"
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }
            $this->user->setName($data["name"]);
            $this->user->setEmail($data["email"]);
            $this->user->setDescription($data["description"]);
            $this->person->setIdUser($this->user->getId());
            $this->person->setCpf($data["cpf"]);
            $this->person->setIdLanguage($data["idLanguage"]);

            $this->user->update();
            $this->person->update();

            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Pessoa alterada com sucesso!"
            ];
            echo json_encode($response);
            return;
        }
    }

    public function updateCompany(array $data)
    {
        if($this->user->getId() != null) {
            if($this->headers["Rule"] != "C") {
                $response = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Usuário não autorizado"
                ];
                echo json_encode($response);
                return;
            }

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
            $this->user->setDescription($data["description"]);
            $this->company->setIdUser($this->user->getId());
            $this->company->setCnpj($data["cnpj"]);
            $this->company->setType($data["type"]);

            $this->user->update();
            $this->company->update();

            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Empresa alterada com sucesso!"
            ];
            echo json_encode($response);
            return;
        }
    }

    public function uploadRepository(array $data)
    {
        if($this->user->getId() != null){
            if($this->headers["Rule"] != "P") {
                $response = [
                    "code" => 401,
                    "type" => "unauthorized",
                    "message" => "Acesso negado"
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }
            $this->repository->setId($data["idRepository"]);
            $this->repository->setName($data["name"]);
            $this->repository->setDescription($data["description"]);
            $this->repository->setIdLanguage($data["idLanguage"]);
            $this->repository->update();
            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Repositório alterado com sucesso"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }
}
