<?php

namespace Source\Models;

use League\Plates\Template\Func;
use Source\Core\Connect;

class Type
{
    private $id;
    private $type;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function __construct($id = null, $type = null)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function selectAll()
    {
        $query = "SELECT * FROM type";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

}