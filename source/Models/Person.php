<?php

namespace Source\Models;

use MongoDB\Driver\Exception\ConnectionException;
use Source\Core\Connect;

class Person
{

    private $id;
    private $idUser;
    private $cpf;
    private $idLanguage;
    private $repositories;

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

    public function getDataPerson()
    {
        $query = "SELECT * FROM person
        JOIN users ON person.idUser = users.id 
        JOIN typeUsers on users.typeUser = typeUsers.id
        WHERE idUser = :idUser";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->execute();
        if($stmt->rowCount() == 0) {
            return false;
        }
//        $dataPerson = $stmt->fetch();
//        $this->id = $dataPerson->id;
        return $stmt->fetch();
    }

    public function getAll() {
        $query = "SELECT * FROM person 
        JOIN users ON person.idUser = users.id 
        JOIN typeUsers ON users.typeUser = typeUsers.id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() == 0) {
            return false;
        }
        return  $stmt->fetchAll();
    }

    public function getAll2(){
        $query = "SELECT * FROM person 
        JOIN users ON person.idUser = users.id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() == 0) {
            return false;
        }
        return  $stmt->fetchAll();
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
        $this->idLanguage = $person->idLanguage;

        $arrayUser = [
            "id" => $this->id,
            "idUser" => $this->idUser,
            "cpf" => $this->cpf,
            "idLanguage" => $this->idLanguage
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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getRepositories() {
        return $this->repositories;
    }

    public function setRepositories(int $repositories){
        $this->repositories = $repositories;
    }

    public function getIdLanguage()
    {
        return $this->idLanguage;
    }

    public function setIdLanguage($idLanguage): void
    {
        $this->idLanguage = $idLanguage;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
}