<?php

namespace Source\Models;

use Source\Core\Connect;

class Project 
{
    private $id;
    private $name;
    private $description;
    private $vacancies;
    private $idLanguage;
    private $idCompany;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDesription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getVacancies()
    {
        return $this->vacancies;
    }

    public function setVacancies($vacancies): void
    {
        $this->vacancies = $vacancies;
    }

    public function getIdLanguage()
    {
        return $this->idLanguage;
    }

    public function setIdLanguage($idLanguage): void
    {
        $this->name = $idLanguage;
    }

    public function getIdCompany()
    {
        return $this->idCompany;
    }

    public function setIdCompany($idCompany): void
    {
        $this->idCompany = $idCompany;
    }

    public function __construct(
        int $id = NULL,
        string $name = NULL,
        string $description = NULL,
        int $vacancies = NULL,
        int $idLanguage = NULL,
        int $idCompany = NULL
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->vacancies = $vacancies;
        $this->idLanguage = $idLanguage;
        $this->idCompany = $idCompany;
    }

    public function insert() 
    {
        $query = "INSERT INTO projects (name, description, vacancies, idLanguage, idCompany) VALUES (:name, :description, :vacancies, :idLanguage, :idCompany)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":vacancies", $this->vacancies);
        $stmt->bindParam(":idLanguage", $this->idLanguage);
        $stmt->bindParam(":idCompany", $this->idCompany);
        $stmt->execute();

        return Connect::getInstance()->lastInsertId();
    }
    
    public function insertPostProjects($idProject) {
        $query = "INSERT INTO post_projects (idCompany, idProject) VALUES (:idCompany, :idProject)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idCompany", $this->idCompany);
        $stmt->bindParam(":idProject", $idProject);
        $stmt->execute();
        return true;
    }

    public function selectAll(){
        $query = "SELECT * FROM projects";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function findById() 
    {
        $query = "SELECT * FROM projects WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public static function findByIdCompany() 
    {
        $id = 11;
        $query = "SELECT * FROM projects WHERE idCompany = :idCompany";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idCompany", $id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        }
        return $stmt->fetchAll();
    }

    public function getProjectFromCompany($idCompany) {
        $query = "SELECT * FROM post_projects WHERE idCompany = :idCompany";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idCompany", $idCompany);

        $stmt->execute();

        $project = $stmt->fetch();

        $this->idCompany = $project->idProject;
    }

    public function findByIdLanguage(int $idLanguage)
    {
        $query = "SELECT * FROM projects WHERE idLanguage = :idLanguage";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idLanguage",$idLanguage);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function findAllPostProjects() 
    {
        $query = "SELECT * FROM post_projects";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function findPostProjects($idCompany) 
    {
        $query = "SELECT idProject FROM post_projects WHERE idCompany = :idCompany";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idCompany", $idCompany);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }
}