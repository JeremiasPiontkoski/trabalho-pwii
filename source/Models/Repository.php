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

    private $file;

    public function __construct(
        int $id = NULL,
        string $name = NULL,
        string $description = NULL,
        int $idLanguage = NULL,
        int $idPerson = NULL,
        string $file = NULL
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->idLanguage = $idLanguage;
        $this->idPerson = $idPerson;
        $this->file = $file;
    }

    public function insert(){
        $query = "INSERT INTO repositories (name, description, idLanguage, file) VALUES (:name, :description, :idLanguage, :file)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":idLanguage", $this->idLanguage);
        $stmt->bindParam(":file", $this->file);
        $stmt->execute();

        return Connect::getInstance()->lastInsertId();
    }

    public function insertPostRepositories()
    {
        $query = "INSERT INTO post_repositories (idPerson, idRepository) VALUES (:idPerson, :idRepository)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idPerson", $this->idPerson);
        $stmt->bindParam(":idRepository", $this->id);
        $stmt->execute();

        return true;
    }

    public function selectAll(){
//        $query = "SELECT * FROM post_repositories
//                JOIN repositories ON post_repositories.idRepository = repositories.id
//                JOIN languages ON repositories.idLanguage = languages.id";
        $query = "SELECT * FROM post_repositories 
                    JOIN repositories ON post_repositories.idRepository = repositories.id 
                    JOIN person ON post_repositories.idPerson = person.id
                    JOIN languages ON repositories.idLanguage = languages.id;";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function findById() {
        /* $query = "SELECT * FROM post_repositories
        JOIN repositories ON post_repositories.idRepository = repositories.id
         JOIN languages ON repositories.idLanguage = languages.id
        WHERE repositories.id = :id"; */

//        $query = "SELECT * FROM repositories WHERE id = :id";

        $query = "SELECT * FROM post_repositories
        JOIN repositories ON post_repositories.idRepository = repositories.id
        JOIN person ON post_repositories.idPerson = person.id
        JOIN languages ON repositories.idLanguage = languages.id
        WHERE repositories.id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }

        return $stmt->fetch();
//
//        $repository = $stmt->fetch();
//        $this->id = $repository->id;
//        $this->name = $repository->name;
//        $this->description = $repository->description;
//        return true;
    }

    public function findByIdPerson()
    {
//        $query = "SELECT * FROM repositories
//        JOIN post_repositories ON repositories.id = post_repositories.idRepository
//        JOIN languages ON repositories.idLanguage = languages.id
//        WHERE post_repositories.idPerson = :idPerson";
        $query = "SELECT * FROM post_repositories
                JOIN repositories ON post_repositories.idRepository = repositories.id
                JOIN person ON post_repositories.idPerson = person.id
                JOIN languages ON repositories.idLanguage = languages.id
                WHERE post_repositories.idPerson = :idPerson";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idPerson", $this->idPerson);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }
        return $stmt->fetchAll();
    }

    public function findByIdLanguage()
    {
        $query = "SELECT * FROM post_repositories 
        JOIN repositories ON post_repositories.idRepository = repositories.id 
        JOIN person ON post_repositories.idPerson = person.id 
        JOIN languages ON repositories.idLanguage = languages.id 
        WHERE languages.id = :idLanguage";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idLanguage", $this->idLanguage);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }
        return $stmt->fetchAll();
    }

    public function update()
    {
        $query = "UPDATE repositories SET name = :name, description = :description, idLanguage = :idLanguage, file = :file WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":idLanguage", $this->idLanguage);
        $stmt->bindParam(":file", $this->file);
        $stmt->execute();
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

    /**
     * @return string|null
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * @param string|null $file
     */
    public function setFile(?string $file): void
    {
        $this->file = $file;
    }
}