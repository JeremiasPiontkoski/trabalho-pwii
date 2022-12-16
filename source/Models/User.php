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

    private $image;

    public function __construct(
        int $id = NULL,
        string $name = NULL,
        string $email = NULL,
        string $password = NULL,
        string $description = NULL,
        int $typeUser = NULL,
        string $image = NULL
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->description = $description;
        $this->typeUser = $typeUser;
        $this->image = $image;
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

//    /**
//     * @param string $email
//     * @return bool
//     */
//    public static function findByEmail(string $email) : bool
//    {
//        $query = "SELECT * FROM users WHERE email = :email";
//        $stmt = Connect::getInstance()->prepare($query);
//        $stmt->bindParam(":email", $email);
//        $stmt->execute();
//        if($stmt->rowCount() == 1){
//            return true;
//        } else {
//            return false;
//        }
//    }

    public function findByEmail(String $email) : bool
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
            return false;
        }else {
            $user = $stmt->fetch();
            if(!password_verify($password, $user->password)){
                return false;
            }
        } 

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->description = $user->description;
        $this->typeUser = $user->typeUser;
        $this->image = $user->profilePicture;

        $arrayUser = [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "description" => $this->description,
            "typeUser" => $this->typeUser,
            "image"   => $this->image
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
        $query = "INSERT INTO users (name, email, password, typeUser) VALUES (:name, :email, :password, :typeUser)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindValue(":password", password_hash($this->password,PASSWORD_DEFAULT));
        $stmt->bindParam(":typeUser", $this->typeUser);
        $stmt->execute();

        return Connect::getInstance()->lastInsertId();
    }

    public function update() 
    {
        $query = "UPDATE users SET name = :name, email = :email, description = :description, profilePicture = :profilePicture WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":profilePicture", $this->image);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        $arrayUser = [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "description" => $this->description,
            "typeUser" => $this->typeUser,
            "image" => $this->image
        ];

        $_SESSION["user"] = $arrayUser;
        return true;
    }

    public function getJSON() : string
    {
        return json_encode(
            ["user" => [
                "name" => $this->getName(),
                "email" => $this->getEmail()
            ]], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
    }

    public function insertCompany() : bool
    {
        $idInsert = $this->insert();
        $query = "INSERT INTO company VALUES (NULL, :idUser)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $idInsert);
        $stmt->execute();

        return true;
    }

    public function getArray() : array
    {
        return ["user" => [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
            "description" => $this->getDescription(),
            "image" => $this->getImage(),
            "typeUser" => $this->getTypeUser()
        ]];
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription(?string $description) {
        $this->description = $description;
    }


    public function getTypeUser() {
        return $this->typeUser;
    }

    public function setTypeUser($type) {
        $this->typeUser = $type;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
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

}