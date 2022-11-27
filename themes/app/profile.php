<?php
    var_dump($_SESSION["userPerson"]);
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

    <div class="container-form">
        <h1>Edição de perfil</h1>
        <form enctype="multipart/form-data" method="post" id="form">
            <div class="box">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" value="<?=$user["name"]?>">
            </div>
            <div class="box">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?=$user["email"]?>">
            </div>
            <div class="box">
                <label for="description">Descrição:</label>
                <input type="text" name="description" id="description" value="<?=$user["description"]?>">
            </div>

            <?php
                if(!empty($_SESSION["userPerson"])) {?>
                    <div class="box">
                        <label for="cpf">Cpf:</label>
                        <input type="number" name="cpf" namespace="Cpf">
                    </div>
            <?php
                }
            ?>

            <?php
                if(!empty($_SESSION["userCompany"])) {?>
                    <div class="box">
                        <label for="cnpj">Cnpj:</label>
                        <input type="number" name="cnpj" namespace="cnpj">
                    </div>
            <?php
                }
            ?>

            <?php
            if(!empty($_SESSION["userPerson"])) {?>
            <div class="box">
                <label for="language">Linguagem:</label>
                <select name="language" id="selectUser">
                    <?php
                        foreach($languages as $language) {
                    ?>
                    <?php
                        if(($language->id == $userPerson["idLanguage"])){
                    ?>
                        <option value="<?= $userPerson["idLanguage"]; ?>">
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
                        if(($language->id != $userPerson["idLanguage"])){
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

            <?php
            if(!empty($_SESSION["userCompany"])) {?>
            <div class="box">
                <label for="typeDelopment">Desenvolvimento:</label>
                <select name="typeDevelopment" id="typeDevelopment">
                <?php
                        foreach($typeUser as $type) {
                    ?>
                    <?php
                        if(($type->id == $userCompany["type"])){
                    ?>
                        <option value="<?= $userCompany["type"]; ?>">
                            <?= $type->type ?>
                    <?php
                        }
                    ?>
                        </option>
                    <?php
                        }
                    ?>
                    <?php
                        foreach($typeUser as $type) {
                    ?>
                    <?php
                        if(($type->id != $userCompany["type"])){
                    ?>
                        <option value="<?= $type->id?>">
                        <?= $type->type ?>
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
        
           <!-- <div class="box-image">
           <?php
                if(!empty($user["image"])):
            ?>
                <img src="<?= url($user["image"]); ?>" id="imgUser">
            <?php
                endif;
            ?>
           </div> -->
            
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
    </div>


    <script type="text/javascript" async>
        const form = document.querySelector("#form");
        // const image = document.querySelector("#imgUser");
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
        // image.setAttribute("src", user.image);
            message.classList.add("message");
            message.classList.remove("success", "warning", "error");
            message.classList.add(`${user.type}`);
            message.innerHTML = user.message;
        });
    </script>

</body>
</html>