<?php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Montserrat&display=swap');
    </style>

    <link rel="stylesheet" href="<?= url("assets/app/style/style.css") ?>">
    <title>Edição de Perfil</title>
</head>
<body>
<section class="container">
    <div class="content">
        <header><h1>Edição de Perfil</h1></header>
        <form enctype="multipart/form-data" method="post" id="form">
            <div class="line">
                <label for="name">Nome:</label>
                <input type="text" name="name" placeholder="Nome" id="name" value="<?=$user["name"]?>">
            </div>
            <div class="line">
            <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email" id="email" value="<?=$user["email"]?>">
            </div>
            <div class="line">
            <label for="description">Descrição:</label>
                <input type="text" name="description" placeholder="Descrição" id="description" value="<?=$user["description"] == "" ? "" : $user["description"]; ?>">
            </div>
            <div class="line">
            <label for="cpf">Cpf</label>
                <input type="number" name="cpf" placeholder="Cpf" value="<?=$user["person"]["cpf"];?>">
            </div>
            <?php
            if(!empty($_SESSION["userPerson"])) {?>
            <div class="line">
                <label for="language">Linguagem:</label>
                <select name="language" id="selectUser">
                    <?php
                        foreach($languages as $language) {
                    ?>
                    <?php
                        if(($language->id == $user["person"]["idLanguage"])){
                    ?>
                        <option value="<?= $user["person"]["idLanguage"]; ?>">
                            <?= $language->language ?>
                    <?php
                        }
                    ?>
                        </option>
                    <?php
                        }
                    ?>
                    <?php
                        foreach($languages as $language) {
                    ?>
                    <?php
                        if(($language->id != $user["person"]["idLanguage"])){
                    ?>
                        <option value="<?= $language->id?>">
                        <?= $language->language ?>
                    <?php
                        }
                    ?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <?php
                }
            ?>

        <div class="box-image">
           <?php
                if(!empty($_SESSION["user"]["image"])):
            ?>
                <img src="<?= url($_SESSION["user"]["image"]); ?>" id="imgUser">
            <?php
                endif;
            ?>
           </div>
            
            <div class="box">
                <label for="image">Foto de perfil:</label>
                <input class="form-control" type="file" name="image" id="image">
            </div>

            <div class="data-error">
                <p id="message"></p>
            </div>

            <button type="submit">Enviar</button>

            <p id="message"></p>
        </form>
    </div>
</section>

    <!-- <div class="container-form">
        <h1>Edição de perfil</h1>
        <form enctype="multipart/form-data" method="post" id="form">
            <div class="box">
                <label for="name">Nome:</label>
                <input type="text" name="name" placeholder="Nome" id="name" value="<?=$user["name"]?>">
            </div>
            <div class="box">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email" id="email" value="<?=$user["email"]?>">
            </div>
            <div class="box">
                <label for="description">Descrição:</label>
                <input type="text" name="description" placeholder="Descrição" id="description" value="<?=$user["description"] == "" ? "" : $user["description"]; ?>">
            </div>
            <div class="box">
                <label for="cpf">Cpf</label>
                <input type="number" name="cpf" placeholder="Cpf" value="<?=$user["person"]["cpf"];?>">
            </div>

            <?php
            if(!empty($_SESSION["userPerson"])) {?>
            <div class="box">
                <label for="language">Linguagem:</label>
                <select name="language" id="selectUser">
                    <?php
                        foreach($languages as $language) {
                    ?>
                    <?php
                        if(($language->id == $user["person"]["idLanguage"])){
                    ?>
                        <option value="<?= $user["person"]["idLanguage"]; ?>">
                            <?= $language->language ?>
                    <?php
                        }
                    ?>
                        </option>
                    <?php
                        }
                    ?>
                    <?php
                        foreach($languages as $language) {
                    ?>
                    <?php
                        if(($language->id != $user["person"]["idLanguage"])){
                    ?>
                        <option value="<?= $language->id?>">
                        <?= $language->language ?>
                    <?php
                        }
                    ?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <?php
                }
            ?>

        
          <div class="box-image">
           <?php
                if(!empty($_SESSION["user"]["image"])):
            ?>
                <img src="<?= url($_SESSION["user"]["image"]); ?>" id="imgUser">
            <?php
                endif;
            ?>
           </div>
            
            <div class="box">
                <label for="image">Foto de perfil:</label>
                <input class="form-control" type="file" name="image" id="image">
            </div>

            <div class="data-error">
                <p id="message"></p>
            </div>

            <button type="submit">Enviar</button>

            <p id="message"></p>

            <a href="<?= url("app") ?>">Menu Principal</a>
        </form>
    </div> -->


    <script type="text/javascript" async>
        const form = document.querySelector("#form");
        const image = document.querySelector("#imgUser");
        const message = document.querySelector("#message");
        form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/profile"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        console.log(user)
            if(user.type == "success") {
                image.setAttribute("src", user.image);
            }
            message.classList.add("message");
            message.classList.remove("success", "warning", "error");
            message.classList.add(`${user.type}`);
            message.innerHTML = user.message;
        });
    </script>

</body>
</html>