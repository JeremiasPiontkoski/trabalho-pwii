<?php

namespace Source\Models;

use Source\Core\Connect;

class Faq
{
    private $id;
    private $userName;
    private $userEmail;
    private $question;
    private $answer;

    public function __construct($id = null, $userName = null, $userEmail = null, $question = null, $answer = null)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->question = $question;
        $this->answer = $answer;
    }

    public function insert()
    {
        $query = "INSERT INTO faqs (question, answer, userName, userEmail) VALUES (:question, :answer, :userName, :userEmail)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":question", $this->question);
        $stmt->bindParam(":answer", $this->answer);
        $stmt->bindParam(":userName", $this->userName);
        $stmt->bindParam(":userEmail", $this->userEmail);
        $stmt->execute();
        return true;
    }

    public function getAll()
    {
        $query = "SELECT * FROM faqs";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() == 0) {
            return false;
        }

        return $stmt->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT * FROM faqs WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if($stmt->rowCount() == 0) {
            return false;
        }
        return $stmt->fetch();
    }

    public function getAllNotAnswered()
    {
        $query = "SELECT * FROM `faqs` WHERE answer IS NULL";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllAnswered()
    {
        $query = "SELECT * FROM `faqs` WHERE answer is not null ";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update()
    {
        $query = "UPDATE faqs SET question = :question, answer = :answer WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":question", $this->question);
        $stmt->bindParam(":answer", $this->answer);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return true;
    }

    public function delete()
    {
        $query = "DELETE FROM faqs WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return true;
    }

    /**
     * @return mixed|null
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed|null $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed|null
     */
    public function getQuestion(): mixed
    {
        return $this->question;
    }

    /**
     * @param mixed|null $question
     */
    public function setQuestion(mixed $question): void
    {
        $this->question = $question;
    }

    /**
     * @return mixed|null
     */
    public function getAnswer(): mixed
    {
        return $this->answer;
    }

    /**
     * @param mixed|null $answer
     */
    public function setAnswer(mixed $answer): void
    {
        $this->answer = $answer;
    }

    /**
     * @return mixed|null
     */
    public function getUserName(): mixed
    {
        return $this->userName;
    }

    /**
     * @param mixed|null $userName
     */
    public function setUserName(mixed $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param mixed $userEmail
     */
    public function setUserEmail($userEmail): void
    {
        $this->userEmail = $userEmail;
    }
}