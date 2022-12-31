
<?php
$this->layout("_theme");
// foreach($repositories as $repo) {
//     var_dump($repo);
// }
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
                    foreach($languages as $language) {
                ?>
                <li>            
                    <a href="<?= url("app/repositorios/{$language->id}"); ?>"><?= $language->language; ?></a>
                    <?php
                        }
                    ?> 
                </li>
            </ul>
        </div>
    </div> 

    <?php
        foreach($repositories as $repository) { ?>

            <p><?= $repository["language"]; ?></p>
    <?php
        }
    ?>

    <!-- <section class="box-container">
    <?php
        if($repositories) {
            foreach ($repositories as $repository) {        
        ?>
        <div class="content">
            <div class="container-head">
                <div class="container-title">
                    <p><?= $repository->name; ?></p>
                </div>
                <div class="container-title">
                    <p>
                        <?php
                            foreach($languages as $language) {
                                if($repository->idLanguage == $language->id){
                                    echo $language->language;
                                }
                            ?>
                        <?php
                            }
                        ?> 
                    </p>
                </div>
            </div>
            <div class="container-content">
                <p><?= $repository->description; ?></p>              
            </div>
            <div class="container-bottom">
                <span>000</span>
                <span>000</span>
            </div>
        </div> 
        <?php
            }
            }
        ?>
    </section> -->