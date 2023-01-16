
<?php
$this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <section class="grid-items">
        <h1>FAQ</h1>
        <div class="content">
            <a href="<?= url("admin/faqs")?>" class="card">
                <h1>Ver todas</h1>
            </a>

            <a href="<?= url("admin/faqsRepondidas")?>" class="card">
                <h1>Respondidas</h1>
            </a>

            <a href="<?= url("admin/responderFaq")?>" class="card">
                <h1>Responder</h1>
            </a>

            <a href="<?= url("admin/registroFaq")?>" class="card">
                <h1>Criar</h1>
            </a>
        </div>
    </section>

    <section class="grid-items">
        <h1>USUÁRIOS</h1>
        <div class="content">
            <a href="<?= url("admin/usuarios")?>" class="card">
                <h1>Ver todos</h1>
            </a>

            <a href="<?= url("admin/registrarAdm")?>" class="card">
                <h1>Cadastrar ADM</h1>
            </a>
        </div>
    </section>

    <section class="grid-items">
        <h1>REPOSITÓRIOS</h1>
        <div class="content">
            <a href="<?= url("admin/repositorios")?>" class="card">
                <h1>Ver todos</h1>
            </a>

            <?php
            foreach($languages as $language) {?>

            <a href="<?= url("admin/repositorios/" . $language->id)?>" class="card">
                <h1><?=$language->language?></h1>
            </a>
            <?php
            }
            ?>
        </div>
    </section>

</body>
</html>
