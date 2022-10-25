<?php

namespace Source\App;

use League\Plates\Engine;
use JsonException;
use League\Plates\Template\Func;
use Source\Models\Person;
use Source\Models\Language;
use Source\Models\Project;
use Source\Models\User;
use Source\Models\Repository;

class App
{

    private $view;
    private $languages;

    public function __construct()
    {

        $languages = new Language();
        $this->languages = $languages->selectAll();

        $languages = new Language();


        $this->view = new Engine(CONF_VIEW_APP,'php');
        //$this->view = new Engine(__DIR__ . "/../../themes/web",'php');
    }

    /* public function home () : void 
    {
        echo $this->view->render("repositories");
    } */

    public function list () : void 
    {
        require __DIR__ . "/../../themes/app/list.php";
    }

    public function createPDF () : void
    {
       require __DIR__ . "/../../themes/app/create-pdf.php";
    }

    public function registerRepository(array $data) : void
    {
        if(!empty($data)){

            if(in_array("", $data)) {
                $json = [
                    "message" => "Preencha todos os campos!",
                    "type" => "warning",
                ];
                echo json_encode($json);
                return;
            }

           

           /*  $category = new Category();
            
            $categories = $category->selectByLanguage($data["language"]);
        
            $json = [
                "name" => $data["name"],
                "message" => "true",
                "language" => $data["language"],
                "description" => $data["description"],
                "return" => $categories->id
            ];
            echo json_encode($json);
            return;  */

            
        
/* $json = [
    "name" => $repository->getDescricao(),
    "message" => $repository->getIdCategory(),
    "type" => "success"
];
echo json_encode($json);
return;  */


            $language = new Language();
            $languages = $language->selectByLanguage($data["language"]);

               /*  $repository = new Repository(
                    null,
                    $data["name"],
                    $data["language"],
                    $data["language"],
                    $categories->id
                ); */
                $repository = new Repository(
                    null,
                    $data["name"],
                    $data["language"],
                    $data["description"],
                    $languages->id
                );

                if($repository->insert()) {
                    $json = [
                        "name" => $data["name"],                        
                        "type" => "success"
                    ];
                    echo json_encode($json);
                    return;
                }

    

//                $json = [
//                    "name" => $data["name"],
//                    "language" => $data["language"],
//                    "description" => $data["language"],
//                    "idCategory" => $categories->id
//                ];

                echo json_encode($repository->getName());
                return;

             

             /*     if(!$repository->insert()){
                $json = [
                    "message" => "Não foi possível cadastrar, tente novamente!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }
            else {
                $json = [
                    "name" => $data["name"],
                    "message" => $repository->getMessage(),
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }  */
        }
        echo $this->view->render("register-repository");
    }

    public function repositories(?array $data) : void
    {
        if(!empty($data)){
            $repository = new Repository();
            $repositories = $repository->findByidCategory($data["idCategory"]);
        }
        echo $this->view->render(
            "filterRepositories",[
                "categories" => $this->categories,
                "repositories" => $repositories
            ]
        );
    }

    public function showRepositories() : void
    {
            $repository = new Repository();
            $repositories = $repository->selectAll();
        
        echo $this->view->render("repositories", 
        [
            "categories" => $this->categories,
            "repositories" => $repositories
        ]);
    }

    public function home() {
        $repository = new Repository();
        $repositories = $repository->selectAll();
        echo $this->view->render("home", 
    [
        "repositories" => $repositories
    ]);
    }
}