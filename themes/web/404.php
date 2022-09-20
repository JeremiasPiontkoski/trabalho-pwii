<?php
  $this->layout("_theme");
?>

<?php $this->start("css"); ?>
    <link rel="stylesheet" href="<?= url("assets/web/") ?>css/style-error.css">
<?php $this->end(); ?>

<div class="error">
    <h1>Opa, parece que ocorreu um erro, tente novamente!</h1>
</div>

<?php $this->start("sidebar"); ?>
    <a href="<?= url(); ?>">Voltar para o início!</a>
<?php $this->end(); ?>