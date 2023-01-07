
<?php
$this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
    <?php $this->start("css"); ?>
    <link rel="stylesheet" href="<?= url("assets/adm/") ?>css/style.css">
    <?php $this->end(); ?>
</head>
<body>
    <section class="container-content">
        <div class="inside">
            <h1>FAQ</h1>
            <?php
            foreach ($allFaqs as $faq) {?>
            <div class="content">
                <a href="<?= url("admin/editarFaq/id?id=" . $faq->id)?>"><?=$faq->question?></a>
                <a href="<?= url("admin/removerFaq/id?id=" . $faq->id)?>">DELETE</a>
            </div>
            <?php
            }
            ?>

            <div class="content">
                <a href="<?= url("admin/registroFaq") ?>">CRIAR</a>
            </div>
        </div>
    </section>

</body>
</html>
