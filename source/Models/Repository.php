<?php

namespace Source\Models;

use Source\Core\Connect;


class Repository
{
    private $id;
    private $name;
    private $language;
    private $description;
    private $idLanguage;
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

    public function getIdlanguage()
    {
        return $this->idLanguage;
    }

    /**
     * @param mixed $name
     */
    public function setIdLanguage($idLanguage): void
    {
        $this->idLanguage = $idLanguage;
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
        int $idLanguage = NULL
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->language = $language;
        $this->description = $description;
        $this->idLanguage = $idLanguage;
    }

    public function insert() : bool{
        $query = "INSERT INTO repositories (name, language, description, idLanguage) VALUES (:name, :language, :description, :idLanguage)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":language", $this->language);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":idLanguage", $this->idLanguage);
        $stmt->execute();

        $this->message = "Repositório cadastrado com sucesso!";
        return true;
    }

    public function findByIdLanguage(int $idLanguage)
    {
        $query = "SELECT * FROM repositories WHERE idLanguage = :idLanguage";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idLanguage",$idLanguage);
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