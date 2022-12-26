<?php

namespace Source\App;

use Source\Models\Company;
use Source\Models\Language;
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
    private $language;
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
        $this->language = new Language();

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
                $dataPerson = $this->person->getDataPerson();
                $response = [
                    "user" => [
                        "id" => $this->person->getIdUser(),
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
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            if($this->user->getTypeUser() == 2) {
                $this->company->setIdUser($this->user->getId());
                $dataCompany = $this->company->getDataCompany();
                $response = [
                    "user" => [
                        "id" => $this->company->getIdUser(),
                        "name" => $dataCompany->name,
                        "email" => $dataCompany->email,
                        "description" => $dataCompany->description,
                        "idTypeUser" => "$dataCompany->typeUser",
                        "typeUser" => $dataCompany->type,
                        "company" => [
                            "cnpj" => $dataCompany->cnpj
                        ]
                    ]
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }
        }
    }

    public function getUsers(array $data)
    {
        if($this->user->getId() != null){
            if($data["typeUser"] == 1) {
                $dataPerson = $this->person->getAll();
                foreach ($dataPerson as $person) {
                    $response = [
                        "user" => [
                            "id" => $person->idUser,
                            "name" => $person->name,
                            "email" => $person->email,
                            "description" => $person->description,
                            "photo" => $person->profilePicture,
                            "idTypeUser" => $person->typeUser,
                            "typeUser" => $person->type,
                            "person" => [
                                "cpf" => $person->cpf,
                                "idLanguage" => $person->idLanguage
                            ]
                        ]
                    ];
                    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
            }

            if($data["typeUser"] == 2) {
                $dataCompany = $this->company->getAll();
                foreach ($dataCompany as $company) {
                    $response = [
                        "user" => [
                            "id" => $company->idUser,
                            "name" => $company->name,
                            "email" => $company->email,
                            "description" => $company->description,
                            "photo" => $company->profilePicture,
                            "idTypeUser" => $company->typeUser,
                            "typeUser" => $company->type,
                            "company" => [
                                "cnpj" => $company->cnpj
                            ]
                        ]
                    ];
                    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
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
                $this->repository->setId($data["idRepository"]);
                $dataRepository = $this->repository->findById();
                if(!$dataRepository) {
                    $response = [
                        "code" => 400,
                        "type" => "bad_request",
                        "message" => "Repositório não cadastrado"
                    ];
                    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    return;
                }

                $this->user->setIdPerson($dataRepository->idPerson);
                $dataUser = $this->user->findByIdPerson();

                $response = [
                    "repository" => [
                        "id" => $dataRepository->id,
                        "idPerson" => $dataRepository->idPerson,
                        "name" => $dataRepository->name,
                        "description" => $dataRepository->description,
                        "idLanguage" => $dataRepository->idLanguage,
                        "language" => $dataRepository->language,
                        "user" => [
                            "id" => $dataUser->id,
                            "name" => $dataUser->name,
                            "email" => $dataUser->email,
                            "description" => $dataUser->description
                        ]
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
            $dataRepository = $this->repository->selectAll();
            foreach ($dataRepository as $repo) {
                $this->user->setIdPerson($repo->idPerson);
                $dataUser = $this->user->findByIdPerson();
                $response = [
                    "repository" => [
                        "id" => $repo->idRepository,
                        "name" => $repo->name,
                        "description" => $repo->description,
                        "language" => $repo->language,
                        "user" => [
                            "id" => $dataUser->id,
                            "name" => $dataUser->name,
                            "email" => $dataUser->email,
                            "description" => $dataUser->description,
                            "photo" => $dataUser->profilePicture
                        ]
                    ]
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function getRepositoriesByPerson()
    {
        if($this->user->getId() != null){
            $this->person->getDataUser($this->user->getId());

            $this->repository->setIdPerson($this->person->getId());

            $dataRepository = $this->repository->findByIdPerson();

            if($dataRepository == null) {
                $response = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Este usuário não possui repositórios"
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            foreach ($dataRepository as $repository) {
                $response = [
                    "repository" => [
                        "id" => $repository->idRepository,
                        "name" => $repository->name,
                        "description" => $repository->description,
                        "idLanguage" => $repository->idLanguage,
                        "language" => $repository->language
                    ]
                ];

                echo json_encode($response,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }

//            $dataRepository = $repository->findByIdPerson();
//
//            if(!$dataRepository) {
//                $response = [
//                    "code" => 400,
//                    "type" => "bad_request",
//                    "message" => "Este usuário não possui projetos ainda"
//                ];
//                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//                return;
//            }
//
//            echo json_encode($dataRepository, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//            return;
        }
    }

    public function getReposotiesByIdLanguage(array $data)
    {
        if($this->user->getId() != null) {
            $this->repository->setIdLanguage($data["idLanguage"]);

            $dataRepository = $this->repository->findByIdLanguage();

            if ($dataRepository == null) {
                $response = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não há registro de repoitórios desta linguagem!"
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            foreach ($dataRepository as $repository) {
                $response = [
                    "repository" => [
                        "id" => $repository->idRepository,
                        "name" => $repository->name,
                        "description" => $repository->description,
                        "idLanguage" => $repository->idLanguage,
                        "language" => $repository->language
                    ]
                ];

                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
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
