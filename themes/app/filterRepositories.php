<?php
  $this->layout("_theme");
?>

<?php $this->start("css"); ?>
    <link rel="stylesheet" href="<?= url("assets/app/") ?>css/style.css">
    <link rel="stylesheet" href="<?= url("assets/app/") ?>css/style-specific-repository.css">
    <link rel="stylesheet" href="<?= url("assets/app/") ?>css/style-repositories.css">
<?php $this->end(); ?>

<div class="nav-links">
        <div class="nav-links-inside">
            <ul>
            <?php
        
            foreach($categories as $category) {
        ?>
                <li>
                   
        <a href="<?= url("repositorios/{$category->id}"); ?>"><?= $category->language; ?></a>
        <?php
        }
        ?> 
        </li>
            </ul>
        </div>
    </div> 

    <section class="box-container">

        <?php
        foreach ($repositories as $repo) {        
        ?>

        <div class="content">
            <div class="container-head">
                <div class="container-title">
                    <p><?= $repo->name; ?></p>
                </div>
                <div class="container-title">
                    <p><?= $repo->linguagem; ?></p>
                </div>
            </div>
            <div class="container-content">
                <p><?= $repo->descricao; ?></p>              
            </div>
            <div class="container-bottom">
                <span>000</span>
                <span>000</span>
            </div>
        </div>
        <?php
        }
        ?>
    </section>
