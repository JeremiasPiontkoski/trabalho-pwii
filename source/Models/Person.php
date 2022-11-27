<?php

namespace Source\Models;

use Source\Core\Connect;

class Person
{

    private $id;
    private $idUser;
    private $cpf;
    private $idLanguage;
    private $repositories;


    public function getRepositories() {
        return $this->repositories;
    }

    public function setRepositories(int $repositories){
        $this->repositories = $repositories;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdLanguage(): ?int
    {
        return $this->idLanguage;
    }

    /**
     * @param int|null $id
     */
    public function setIdLanguage(?int $idLanguage): void
    {
        $this->language = $idLanguage;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    /**
     * @param int|null $id
     */
    public function setIdUser(?int $idUser): void
    {
        $this->id = $idUser;
    }

    public function __construct(
        int $id = NULL,
        int $idUser = NULL,
        string $cpf = NULL,
        int $idLanguage = NULL,
        string $repositories = NULL
    )
    {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->cpf = $cpf;
        $this->idLanguage = $idLanguage;
        $this->repositories = $repositories;
    }

    public function getDataUser($idUser)
    {
        $query = "SELECT * FROM person WHERE idUser LIKE :idUser";
        $stmt = Connect::getInstance()->prepare($query);

        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return false;
        }

        $person = $stmt->fetch();

        $this->id = $person->id;
        $this->idUser = $person->idUser;
        $this->cpf = $person->cpf;

        $arrayUser = [
            "id" => $this->id,
            "idUser" => $this->idUser,
            "cpf" => $this->cpf,
        ];

        $_SESSION["userPerson"] = $arrayUser;
        
        return true;
        
    }

    public function insert() : bool
    {
        /* $query = "INSERT INTO person VALUES (NULL, :idUser, :cpf, :language)"; */
        $query = "INSERT INTO person (idUser) VALUES (:idUser)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->execute();

        $this->message = "Usuário cadastrado com sucesso!";
        return true;
    }

    public function update()
     {
        $query = "UPDATE person SET idLanguage = :idLanguage, cpf = :cpf WHERE idUser = :idUser";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->bindParam(":idLanguage", $this->idLanguage);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->execute();

        $person = $stmt->fetch();

        /* $this->id = $person->id;
        $this->idUser = $person->idUser;
        $this->cpf = $person->cpf;
        $this->idLanguage = $person->idLanguage; */

        $arrayUser = [
            "id" => $this->id,
            "idUser" => $this->idUser,
            "cpf" => $this->cpf,
            "idLanguage" => $this->idLanguage
        ];

        $_SESSION["userPerson"] = $arrayUser;
        
        return true;
    }


    public function getReposity($idUser) {
        $query = "SELECT repositories FROM person WHERE idUser LIKE :idUser";
        $stmt = Connect::getInstance()->prepare($query);

        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();

        $person = $stmt->fetch();

        $this->repositories = $person->repositories;

        return true;
    }

}