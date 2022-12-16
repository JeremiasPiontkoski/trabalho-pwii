<?php

namespace Source\App;

use http\Encoding\Stream\Enbrotli;
use League\Plates\Engine;
use Source\Models\Faq;

class Adm
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(CONF_VIEW_ADMIN, 'php');
    }

//    public function home () : void
//    {
//        require __DIR__ . "/../../themes/adm/home.php";
//    }

    public function home () : void
    {
        $faq = new Faq();
        echo $this->view->render("home",[
            "faqs" => $faq->getAll()
        ]);
    }

    public function registerFaq(array $data) {
        if(!empty($data)) {
            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos",
                    "type" => "danger"
                ];
                echo json_encode($json);
                return;
            }

            $faq = new Faq(
                null,
                $data["question"],
                $data["answer"]
            );

            $faq->insert();

            $json = [
                "message" => "Faq criada com sucesso",
                "type" => "success"
            ];
            echo json_encode($json);
            return;
        }
        echo $this->view->render("createFaq");
    }

    public function editFaq() {

        $faq = new Faq();
        echo $this->view->render("editFaq", [
            "faq" => $faq->getById($_GET["id"])
        ]);
    }

    public function postEditFaq(array $data) {
        if(!empty($data)) {
            if(in_array("", $data)){
                $json = [
                    "message" => "Preencha todos os campos",
                    "type" => "danger"
                ];
                echo json_encode($json);
                return;
            }

            $faq = new Faq(
                $_GET["id"],
                $data["question"],
                $data["answer"]
            );

            $faq->update();

            $json = [
                "message" => "Faq alterada com sucesso",
                "type" => "success"
            ];

            echo json_encode($json);
            return;
        }
    }
}