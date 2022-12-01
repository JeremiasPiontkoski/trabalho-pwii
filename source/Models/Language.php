<?php

namespace Source\Models;

use League\Plates\Template\Func;
use Source\Core\Connect;

class Language
{
    private $id;
    private $language;

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

    public function __construct($id = null, $language = null)
    {
        $this->id = $id;
        $this->language = $language;
    }

    public function selectAll()
    {
        $query = "SELECT * FROM languages";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function selectByLanguage(string $language) {
        $query = "SELECT id FROM languages WHERE language = :language";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":language", $language);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }else {
            return $stmt->fetch();
        }
    }

    public static function findById($id) {
        $query = "SELECT * FROM languages WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return 0;
        }

        return $stmt->fetch();
    }
}