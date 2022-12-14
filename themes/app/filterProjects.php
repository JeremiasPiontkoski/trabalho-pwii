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
        
            foreach($languages as $language) {
        ?>
                <li>
                   
        <a href="<?= url("app/projetos/{$language->id}"); ?>"><?= $language->language; ?></a>
        <?php
        }
        ?> 
        </li>
            </ul>
        </div>
    </div> 

    <!-- <section class="box-container">
        <?php
        // if($projects) {
            foreach ($projects as $project) {        
        // }
        ?>

        <div class="content">
            <div class="container-head">
                <div class="container-title">
                    <p><?= $project->name; ?></p>
                </div>
                <div class="container-title">
                    <p>
                    <?php
                        foreach($languages as $language) {
                            if($project->idLanguage == $language->id){
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
                <p><?= $project->description; ?></p>              
            </div>
            <div class="container-bottom">
                <span>000</span>
                <span>000</span>
            </div>
        </div> 
        <?php
        }
        ?>
    </section> -->

    <section class="box-container">
    <?php
        if($projects) {
            foreach ($projects as $project) {  
    ?>

        <div class="content">
            <div class="container-head">
                <div class="container-title">
                    <p><?= $project->name; ?></p>
                </div>
                <div class="container-title">
                    <p>
                        <?php
                            foreach($languages as $language) {
                                if($project->idLanguage == $language->id){
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
                <p><?= $project->description; ?></p>              
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
    </section>