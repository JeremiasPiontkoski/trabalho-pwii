<?php
  $this->layout("_theme");
?>
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

    <section class="box-repository">
        <?php
            foreach($projects as $project) {
            ?>
            
        <div class="box-inside">
            <div class="box-left">
                <div class="box-top">
                    <div class="radius"></div>
                </div>
                <div class="box-bottom">
                    <div class="content">
                        <p>Name</p>
                        <p>Email</p>
                        <p>Linguagem</p>
                    </div>                 
                </div>
            </div>

            <div class="box-right">
                <div class="box-repositories">
                    <div class="box-head">
                        <h1>PROJETO</h1>
                    </div>
                    <div class="box-content">
                        <p><?= $project->name; ?></p>
                    </div>
                    <div class="box-content">
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
                    <div class="box-content">
                        <p><?=$project->description ?></p>
                    </div>
                    <div class="box-content">
                        <p>Vagas: <?= $project->vacancies; ?></p>
                    </div>
                    <div class="box-bottom">
                        <a href="#">Favoritar</a>
                        <a href="#">CANDIDATAR-SE</a>
                    </div>
                </div>            
            </div>
        </div>
        <?php
            }
        ?>
    </section>
