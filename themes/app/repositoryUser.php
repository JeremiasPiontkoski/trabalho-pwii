<?php
$this->layout("_theme");
// var_dump($repository);
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200&display=swap');
    </style>
    <link rel="stylesheet" href="<?= url("assets/app/css/style-repository.css") ?>">
    <title>Repositório</title>
</head>
<body>
<section>
    <div class="repository">
        <div class="user">
            <div class="user-photo">  
            <?php
                if(!empty($repository["user"]["photo"])):
            ?>
            <img src="<?= url($repository["user"]["photo"]); ?>" id="imgUser">
            <?php
                endif;
            ?>  
            </div>
            <p><?=$repository["user"]["name"]?></p>
            <a href="<?= url("app/editarRepositorio/id?id=" . $repository["id"])?>">Editar</a>
        </div>

        <div class="repository-infos">
            <div class="repo-infos">
                <p>Nome: <?=$repository["name"]?></p>
                <p>Linguagem: <?=$repository["language"]?></p>
                <p>Descrição: <?=$repository["description"]?></p>
            </div>

            <div class="repo-file">
            <a href="<?= url($repository["file"])?>" target="_blank">arquive.file</a>
            </div>
        </div>
    </div>
</section>
</body>
</html>