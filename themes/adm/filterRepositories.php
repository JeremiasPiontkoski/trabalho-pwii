<?php
$this->layout("_theme");
// var_dump($repositories);
?>

<!DOCTYPE html>
<html lang="pr-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faqs</title>
</head>
<body>
    <section class="table">
        <table class="content-table">
            <thead>
              <tr>
                <th>Id:</th>
                <th>Id usuário:</th>
                <th>Nome:</th>
                <th>Linguagem:</th>
                <th>Proprietário:</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($repositories as $repository) {?>
              <tr>
                <td><?= $repository["id"]?></td>
                <td><?= $repository["idPerson"]?></td>
                <td><?= $repository["name"]?></td>
                <td><?= $repository["language"]?></td>
                <td><?= $repository["user"]["name"]?></td>
              </tr>
              <?php
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>