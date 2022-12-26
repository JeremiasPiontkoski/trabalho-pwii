<?php
$this->layout("_theme");
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
    <div class="container">
        <div class="item">
            <p>Nome: <?= $repository["repository"]["name"]?></p>
        </div>

        <div class="item">
            <p>Descrição: <?= $repository["repository"]["description"]?></p>
        </div>

        <div class="item">
            <p>Linguagem: <?= $repository["repository"]["language"]?></p>
        </div>

        <div class="item">
            <p><a href="<?= url("app/editarRepositorio/id?id=" . $repository["repository"]["id"])?>">EDITAR</a></p>
        </div>
    </div>
</section>
</body>
</html>

