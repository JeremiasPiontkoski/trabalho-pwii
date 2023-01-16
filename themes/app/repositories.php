<?php
  $this->layout("_theme");
?>
    <section class="container-repositories">
        <div class="head">
            <p>Filtrar por:</p>
                <ul>
                        <?php
                            foreach($languages as $language) {
                        ?>
                            <li>
                                <a href="<?= url("app/repositorios/{$language->id}"); ?>">
                                <?= $language->language; ?>
                                </a>
                            </li>
                        <?php
                            }
                        ?>
                </ul>
        </div>

        <?php
            foreach($repositories as $repository) {?>
                <a href="<?= url("app/repositorio/id?id=" . $repository["id"])?>" class="data">
                    <div class="user-data">
                        <div class="user-photo">
                            <?php
                                if(!empty($repository["user"]["photo"])):
                            ?>
                            <img src="<?= url($repository["user"]["photo"]); ?>" id="imgUser">
                            <?php
                                endif;
                            ?>
                        </div>
                        <p>Proprietário: <?= $repository["user"]["name"]?></p>
                    </div>

                    <div class="repository-data">
                        <p><?= $repository["name"]?></p>
                        <p>Linguagem: <?= $repository["language"]?></p>
                    </div>
                </a>
            <?php
                }
             ?>

       <!-- <div class="repositories">
            <?php foreach($repositories as $repository) {?>
                <a href="<?= url("app/repositorio/id?id=" . $repository["id"])?>" class="line">
                    <p id="first">Proprietário: <span><?= $repository["user"]["name"] ?></span></p>
                        <div class="data">
                            <p><?= $repository["name"] ?></p>
                            <p><?= $repository["language"] ?></p>
                        </div>
                    <p id="last"><?= $repository["description"] ?></p>
                </a>

                <?php
                    }
                ?> -->
          <!--  <div class="line">
                <p id="first">Proprietário: <span>Usuário tal</span></p>
                <div class="data">
                    <p>Nome</p>
                    <p>Language</p>
                </div>
                <p id="last">Descrição</p>
            </div>  
        </div> -->
    <!--</section>-->


    <!-- <div class="nav-links">
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
    </div>-->     

    <!-- <section class="box-repository">
        <?php
            foreach($repositories as $repository) {
            ?>
            
        <div class="box-inside">
            <div class="box-left">
                <div class="box-top">
                    <div class="radius"></div>
                </div>
                <div class="box-bottom">
                    <div class="content">
                        <?php
                            foreach ($person as $per) {
                                if($per->id == $repository->idPerson) {
                                    ?>

                                    <p><?= $per->name ?></p>
                                    <p><?= $per->email ?></p>
                                    <p><?= $per->description ?></p>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="box-right">
                <div class="box-repositories">
                    <div class="box-head">
                        <h1>REPOSITÓRIO</h1>
                    </div>
                    <div class="box-content">
                        <p><?= $repository->name; ?></p>
                    </div>
                    <div class="box-content">
                        <p><?= $repository->language; ?></p>
                    </div>
                    <div class="box-content">
                        <p><?=$repository->description ?></p>
                    </div>
                    <div class="box-bottom">
                        <a href="#">Favoritar</a>
                    </div>
                </div>            
            </div>
        </div>
        <?php
            }
        ?>
    </section>  -->