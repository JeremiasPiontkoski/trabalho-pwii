<?php

namespace Source\Models;

use Source\Core\Connect;

class Admin
{
    private $id;
    private $name;
    private $email;
    private $password;

    /**
     * @param $id
     * @param $name
     * @param $email
     * @param $password
     */
    public function __construct($id = null, $name = null, $email = null, $password = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function insert() {
        $query = "INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindValue(":password", password_hash($this->password, PASSWORD_DEFAULT));
        $stmt->execute();
        return true;
    }

    public function validate (string $email, string $password) : bool
    {
        $query = "SELECT * FROM admins WHERE email LIKE :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        }else {
            $adm = $stmt->fetch();
            if(!password_verify($password, $adm->password)){
                return false;
            }
        }

        $this->id = $adm->id;
        $this->name = $adm->name;
        $this->email = $adm->email;

    //     $arrayAdmin = [
    //         "id" => $this->id,
    //         "name" => $this->name,
    //         "email" => $this->email,
    //     ];

    // //    session_start();
    //     $_SESSION["admin"] = $arrayAdmin;
        return true;
    }

    public function findByEmail() {
        $query = "SELECT * FROM admins WHERE email = :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
}