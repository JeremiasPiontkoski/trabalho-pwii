<?php

namespace Source\App;

use Source\Models\Language;
use Source\Models\Person;
use Source\Models\Repository;
use Source\Models\User;

class ApiTest
{
    private $user;
    private $person;
    private $repository;
    private $language;

    public function __construct()
    {
        $this->user = new User();
        $this->person = new Person();
        $this->repository = new Repository();
        $this->language = new Language();
    }

    public function getRepository(array $data)
    {
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
                ];

                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }
    }

    public function getRepositories()
    {
            $dataRepository = $this->repository->selectAll();
            $arrayRepo = [];
            foreach ($dataRepository as $repo) {
                $this->user->setIdPerson($repo->idPerson);
                $dataUser = $this->user->findByIdPerson();
                $response = [
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
                ];
                $arrayRepo[] = $response;
            }
        echo json_encode($arrayRepo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }
}