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
                <th>Nome:</th>
                <th>Email:</th>
                <th>Tipo de usuário:</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($users as $user) {?>
              <tr>
                <td><?= $user->id?></td>
                <td><?= $user->name?></td>
                <td><?= $user->email?></td>
                <td><?= $user->typeUser?></td>
              </tr>
              <?php
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>