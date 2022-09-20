<?php

namespace Source\Models;

use Source\Core\Connect;


class Repository
{
    private $id;
    private $name;
    private $language;
    private $description;
    private $idCategory;
    private $message;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * @param mixed $name
     */
    public function setIdCategory($idCategory): void
    {
        $this->idCategory = $idCategory;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }


    /**
     * @return int|null
     */
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

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }


    public function __construct(
        int $id = NULL,
        string $name = NULL,
        string $language = NULL,
        string $description = NULL,
        int $idCategory = NULL
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->language = $language;
        $this->description = $description;
        $this->idCategory = $idCategory;
    }

    public function insert() : bool{
//        $query = "INSERT INTO repositories VALUES (NULL, :name, :language, :description)";
//        $query = "INSERT INTO repositories (name, linguagem, descricao) VALUES (:name, :linguagem, :descricao)";
        $query = "INSERT INTO repositories (name, linguagem, descricao, idCategory) VALUES (:name, :language, :description, :idCategory)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":language", $this->language);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":idCategory", $this->idCategory);
        $stmt->execute();

        $this->message = "Repositório cadastrado com sucesso!";
//        $this->message = "Repositório cadastrado com sucesso!";
        return true;
    }

    public function findByidCategory(int $idCategory)
    {
        $query = "SELECT * FROM repositories WHERE idCategory = :idCategory";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idCategory",$idCategory);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function selectAll(){
        $query = "SELECT * FROM repositories";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }
}