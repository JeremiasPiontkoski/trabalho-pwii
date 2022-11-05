<?php

namespace Source\Models;

use Source\Core\Connect;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $description;
    private $typeUser;
    private $message;


    public function getDescription() {
        return $this->description;
    }

    public function setDescription(?string $description) {
        $this->description = $description;
    }

     /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function getTypeUser() {
        return $this->typeUser;
    }

    public function setTypeUser($type) {
        $this->typeUser = $type;
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }


    public function __construct(
        int $id = NULL,
        string $name = NULL,
        string $email = NULL,
        string $password = NULL,
        string $description = NULL,
        int $typeUser = NULL
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->description = $description;
        $this->typeUser = $typeUser;
    }
 /**
     * @return array|false
     */
    public function selectAll ()
    {
        $query = "SELECT * FROM users";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    /**
     * @return bool
     */
    public function findById() : bool
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            $user = $stmt->fetch();
            $this->name = $user->name;
            $this->email = $user->email;
            return true;
        }
    }

    /**
     * @param string $email
     * @return bool
     */
    public function findByEmail(string $email) : bool
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function validate (string $email, string $password) : bool
    {
        $query = "SELECT * FROM users WHERE email LIKE :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            $this->message = "Usuário e/ou Senha não cadastrados!";
            return false;
        }else {
            $user = $stmt->fetch();
            if(!password_verify($password, $user->password)){
                $this->message = "Usuário e/ou Senha não cadastrados!";
                return false;
            }
        } 

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->description = $user->description;
        $this->typeUser = $user->typeUser;

        $arrayUser = [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "description" => $this->description,
            "typeUser" => $this->typeUser
        ];

        session_start();
        $_SESSION["user"] = $arrayUser;

        return true;
    }

    /**
     * @return bool
     */
    public function insert()
    {
        $query = "INSERT INTO users (name, email, password, description, typeUser) VALUES (:name, :email, :password, :description, :typeUser)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindValue(":password", password_hash($this->password,PASSWORD_DEFAULT));
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":typeUser", $this->typeUser);
        $stmt->execute();
        $this->message = "Usuário cadastrado com sucesso!";

        return Connect::getInstance()->lastInsertId();
        
    }

   

    public function insertCompany() : bool
    {
        $idInsert = $this->insert();
        $query = "INSERT INTO company VALUES (NULL, :idUser)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $idInsert);
        $stmt->execute();

        $this->message = "Usuário cadastrado com sucesso!";
        return true;
    }
}