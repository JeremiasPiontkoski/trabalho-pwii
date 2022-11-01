<?php

namespace Source\Models;

use Source\Core\Connect;

class Person
{

    private $id;
    private $idUser;
    private $cpf;
    private $language;
    private $message;

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

    public function getLanguage(): ?int
    {
        return $this->language;
    }

    /**
     * @param int|null $id
     */
    public function setLanguage(?int $language): void
    {
        $this->language = $language;
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
        string $language = NULL
    )
    {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->cpf = $cpf;
        $this->language = $language;
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
        $this->language = $person->language;
        
        return true;
        
    }

    public function validateTeste($id) {
        if($id == 25) {
            return true;
        }else {
            return false;
        }
    }

    public function insert() : bool
    {
        /* $query = "INSERT INTO person VALUES (NULL, :idUser, :cpf, :language)"; */
        $query = "INSERT INTO person (idUser, cpf, language) VALUES (:idUser, :cpf, :language)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":language", $this->language);
        $stmt->execute();

        $this->message = "Usuário cadastrado com sucesso!";
        return true;
    }
}