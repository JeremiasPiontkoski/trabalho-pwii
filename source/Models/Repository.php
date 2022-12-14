<?php

namespace Source\Models;

use League\Plates\Template\Func;
use Source\Core\Connect;


class Repository
{
    private $id;
    private $name;
    private $description;
    private $idLanguage;
    private $idPerson;

    public function __construct(
        int $id = NULL,
        string $name = NULL,
        string $description = NULL,
        int $idLanguage = NULL,
        int $idPerson = NULL
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->idLanguage = $idLanguage;
        $this->idPerson = $idPerson;
    }

    public function insert(){
        $query = "INSERT INTO repositories (name, description, idLanguage, idPerson) VALUES (:name, :description, :idLanguage, :idPerson)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":idLanguage", $this->idLanguage);
        $stmt->bindParam(":idPerson", $this->idPerson);
        $stmt->execute();

        return Connect::getInstance()->lastInsertId();
    }

    public function insertPostRepositories($idRepository) {
        $query = "INSERT INTO post_repositories (idPerson, idRepository) VALUES (:idPerson, :idRepository)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idPerson", $this->idPerson);
        $stmt->bindParam(":idRepository", $idRepository);
        $stmt->execute();

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

    public function findByIdPerson(int $idPerson)
    {
        $query = "SELECT * FROM repositories
        JOIN post_repositories ON repositories.id = post_repositories.idRepository 
        JOIN languages ON repositories.idLanguage = languages.id 
        WHERE post_repositories.idPerson = :idPerson";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idPerson", $idPerson);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }
        return $stmt->fetchAll();
    }

//    public static function findByIdPerson()
//    {
//        $query = "SELECT * FROM repositories WHERE idPerson = :idPerson";
//        $stmt = Connect::getInstance()->prepare($query);
//        $stmt->bindParam(":idPerson", $_SESSION["userPerson"]["id"]);
//        $stmt->execute();
//
//        if($stmt->rowCount() == 0){
//            return false;
//        }
//        return $stmt->fetchAll();
//    }

//    public static function findByIdPersonPostRepositories() {
//        $query = "SELECT * FROM post_repositories";
//        $stmt = Connect::getInstance()->prepare($query);
//        // $stmt->bindParam(":idPerson", $_SESSION['userPerson']['id']);
//
//        $stmt->execute();
//
//        if($stmt->rowCount() == 0) {
//            return false;
//        }
//
//        return $stmt->fetchAll();
//    }

    public function findAllPostRepositories() 
    {
        $query = "SELECT * FROM post_repositories";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

//    public static function findById($id) {
//        $query = "SELECT * FROM repositories WHERE id = :id";
//        $stmt = Connect::getInstance()->prepare($query);
//        $stmt->bindParam(":id", $id);
//        $stmt->execute();
//
//        if($stmt->rowCount() == 0) {
//            return false;
//        }
//
//        return $stmt->fetch();
//    }

    public function findById($id) {
        $query = "SELECT * FROM repositories WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }

        $repository = $stmt->fetch();
        $this->id = $repository->id;
        $this->name = $repository->name;
        $this->description = $repository->description;
        return true;
    }

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

    public function getIdPerson() {
        return $this->idPerson;
    }

    public function setIdPerson($idPerson) {
        $this->idPerson = $idPerson;
    }
}