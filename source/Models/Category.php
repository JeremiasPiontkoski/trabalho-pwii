<?php

namespace Source\Models;

use League\Plates\Template\Func;
use Source\Core\Connect;

class Category
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
        $query = "SELECT * FROM categories";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function selectByLanguage(string $language) {
        $query = "SELECT id FROM categories WHERE language = :language";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":language", $language);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }else {
            return $stmt->fetch();
        }
        
            /* $category = $stmt->fetch();
            $this->id = $category->id;
            $this->language = $category->language;
            return $stmt->fetchAll(); */
        
        
    }
}