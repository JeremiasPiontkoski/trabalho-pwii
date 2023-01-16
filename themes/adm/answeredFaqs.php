<?php
$this->layout("_theme");
// var_dump($faqs);
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
                <th>Id</th>
                <th>Pergunta</th>
                <th>Resposta</th>
                <th>Nome do usuário:</th>
                <th>Email do usuário:</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($faqs as $faq) {?>
              <tr>
                <td><?= $faq->id?></td>
                <td><?= $faq->question?></td>
                <td><?= $faq->answer == "" ? "NÃO RESPONDIDA" : $faq->answer?></td>
                <td><?= $faq->userName?></td>
                <td><?= $faq->userEmail?></td>
                <td><a href="<?= url("admin/editarFaq/id?id=" . $faq->id)?>">Editar</a></td>
                <td><a href="<?= url("admin/removerFaq/id?id=" . $faq->id)?>">Excluir</a></td>
              </tr>
              <?php
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>