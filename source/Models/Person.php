<?php

namespace Source\Models;

use Source\Core\Connect;

class Person
{

    private $id;
    private $idUser;
    private $linguagem;
    private $descricao;
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

    public function getLinguagem(): ?string
    {
        return $this->linguagem;
    }

    /**
     * @param int|null $id
     */
    public function setLinguagem(?string $linguagem): void
    {
        $this->linguagem = $linguagem;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * @param int|null $id
     */
    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
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
        string $linguagem = NULL,
        string $descricao = NULL
    )
    {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->linguagem = $linguagem;
        $this->descricao = $descricao;
    }

    public function getDataUser(int $idUser)
    {
        $query = "SELECT * FROM person WHERE idUser LIKE :idUser";
        $stmt = Connect::getInstance()->prepare($query);

        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return false;
        }else {
            $user = $stmt->fetch();
            $this->id = $user->id;
            $this->idUser = $user->idUser;
            $this->linguagem = $user->linguagem;
            $this->descricao = $user->descricao;
            return true;
        }
        
    }

    public function insertPerson() : bool
    {
        $query = "INSERT INTO person VALUES (NULL, :idUser, :linguagem, :descricao)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->bindParam(":linguagem", $this->linguagem);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->execute();

        $this->message = "Usuário cadastrado com sucesso!";
        return true;
    }
}