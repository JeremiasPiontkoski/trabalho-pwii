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
                   
        <a href="<?= url("app/repositorios/{$language->id}"); ?>"><?= $language->language; ?></a>
        <?php
        }
        ?> 
        </li>
            </ul>
        </div>
    </div>     

    <section class="box-repository">
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
                        <p>Name</p>
                        <p>Email</p>
                        <p>Linguagem</p>
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
                        <p><?= $repository->language ?></p>
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
    </section>
