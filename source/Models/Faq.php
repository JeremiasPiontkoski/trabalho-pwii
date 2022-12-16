<?php

namespace Source\Models;

use Source\Core\Connect;

class Faq
{
    private $id;
    private $question;
    private $answer;

    public function __construct($id = null, $question = null, $answer = null)
    {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
    }

    public function insert()
    {
        $query = "INSERT INTO faqs (question, answer) VALUES (:question, :answer)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":question", $this->question);
        $stmt->bindParam(":answer", $this->answer);
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
}