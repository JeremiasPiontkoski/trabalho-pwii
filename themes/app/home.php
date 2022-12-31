<?php
  $this->layout("_theme");
?>

    <section class="container-user">
        <div class="image container-box">
            <div class="content">
                <div class="circle">
                    <?php
                        if(!empty($user["photo"])):
                    ?>
                    <img src="<?= url($user["photo"]); ?>" id="imgUser">
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </div>

        <div class="data container-box">
            <div class="content">
                <div class="text">
                    <p>Meu nome é: </p>
                    <p><?=$user["name"];?></p>
                    <p><?=$user["email"];?></p>
                    <p>
                        <?=$user["description"] == "" ? "Eu não possuo descrição ainda" : $user["description"]; ?>
                    </p> 
                    <a href="<?php url() ?>app/profile">Editar</a>
                </div>
            </div>
        </div>
    </section>

    <section class="container-repositories">
        <div class="head">
            <h1>REPOSITÓRIOS</h1>
        </div>
        <div class="content">
            <?php if(!empty($repositories)){
                foreach($repositories as $repository) { ?>
                    <a href="<?= url("app/repositorio/id?id=" . $repository["id"])?>"><?=$repository["name"]?></a>
               <?php
                    }
                }
                else {
                    ?>
                        <p>Você não possui repositórios :(</p>
                    </div>

                <?php
                    }
                ?>
        </div>
        <div class="footer">
            <a href="<?php url() ?>
                    app/cadastroRepositorio";
                    ?>Criar novo</a>
        </div>
    </section>