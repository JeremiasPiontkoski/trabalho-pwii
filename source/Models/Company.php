<?php

namespace Source\Models;

use Source\Core\Connect;

class Company
{

    private $id;
    private $idUser;
    private $cnpj;
    private $type;

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

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj): void
    {
        $this->cnpj = $cnpj;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
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
        string $cnpj = NULL,
        string $type = NULL
    )
    {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->cnpj = $cnpj;
        $this->type = $type;
    }

    public function insert() {
        $query = "INSERT INTO company (idUser, cnpj, type) VALUES (:idUser, :cnpj, :type)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->bindParam(":cnpj", $this->cnpj);
        $stmt->bindParam(":type", $this->type);

        $stmt->execute();
        return true;
    }

    public function getDataCompany($idUser)
    {
        $query = "SELECT * FROM company WHERE idUser LIKE :idUser";
        $stmt = Connect::getInstance()->prepare($query);

        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return false;
        }

        $company = $stmt->fetch();

        $this->id = $company->id;
        $this->idUser = $company->idUser;
        $this->cnpj = $company->cnpj;
        $this->type = $company->type;
        
        return true;
        
    }
}