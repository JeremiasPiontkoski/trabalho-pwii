<?php

namespace Source\App;

use http\Encoding\Stream\Enbrotli;
use League\Plates\Engine;
use Source\Models\Admin;
use Source\Models\Faq;

class Adm
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(CONF_VIEW_ADMIN, 'php');
    }

    public function home () : void
    {
        $faq = new Faq();
        echo $this->view->render("home",[
            "allFaqs" => $faq->getAll()
        ]);
    }

    public function registerFaq(array $data)
    {
        if(!empty($data)) {
            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "danger"
                ];
                echo json_encode($json);
                return;
            }

            $adm = new Admin();
            $faq = new Faq(
                null,
                $adm->getName(),
                $adm->getEmail(),
                $data["question"],
                $data["answer"]
            );

            $faq->insert();

            $json = [
                "message" => "Faq criada com sucesso!",
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

    public function postEditFaq(array $data)
    {
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

    public function notAnswerFaq() {
        $faq = new Faq();
        echo $this->view->render("notAnswerFaq", [
            "faqs" => $faq->getAllNotAnswered()
        ]);
    }

    public function answerFaq() {
        $faq = new Faq();
        echo $this->view->render("answerFaq", [
            "faq" => $faq->getById($_GET["id"])
        ]);
    }

    public function postAnswerFaq(array $data) {
        if(!empty($data)) {
            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $faq = new Faq();
            $dataFaq = $faq->getById($_GET['id']);

            $faq->setId($dataFaq->id);
            $faq->setUserName($dataFaq->userName);
            $faq->setUserEmail($dataFaq->userEmail);
            $faq->setQuestion($dataFaq->question);
            $faq->setAnswer($data["answer"]);

            $faq->update();

            $json = [
                "message" => "Faq respondida com sucesso!",
                "type" => "success"
            ];
            echo json_encode($json);
            return;
        }
    }

    public function deleteFaq(){
        $faq = new Faq();
        $faq->setId($_GET['id']);
        $faq->delete();

        header("Location:http://www.localhost/trabalho-pwii/admin");
    }
}