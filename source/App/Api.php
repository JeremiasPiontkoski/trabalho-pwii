<?php

namespace Source\App;

use Source\Models\Repository;
use Source\Models\User;

class Api
{

    private $user;

    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');
        $headers = getallheaders();
        if(empty($headers["Email"]) || empty($headers["Password"]) || empty($headers["Rule"])){
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe E-mail, Senha e Tipo de Usuário para acessar"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $this->user = new User();
        if(!$this->user->validate($headers["Email"],$headers["Password"])){
            $response = [
                "code" => 401,
                "type" => "unauthorized",
                "message" => "E-mail ou Senha inválidos"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function getUser()
    {
        //echo "Olá, Usuário";
        $user = new User(31);
        $user->findById();
        //var_dump($user);
        echo $user->getJSON();
    }

    public function getRepositories()
    {
        $repository = new Repository(7);
        $repository->findById();
        echo $repository->getJSON();
    }
}

