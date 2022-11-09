<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php var_dump($id) ?><br>
    <?php var_dump($user) ?><br>
    <?=$user["name"];?><br>
    <?= $user["email"];?><br>
    <?php var_dump($userPerson);?>

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

    <div class="box">
        <label for="language">Linguagem:</label>
        <select name="language" id="selectUser">
            <option value=""><?= $userPerson["language"]; ?></option>                    
                <?php
                    foreach($languages as $language) {
                ?>
            <option value="<?= $language->language ?>"><?= $language->language ?></option>
                <?php
                    }
                ?>
        </select>
    </div>
    
    <?php
        if(!empty($user["image"])):
    ?>     
        <img src="<?= url($user["image"]); ?>" id="imgUser">   
    <?php
        endif;
    ?>

    <div class="box">
        <label for="image">Foto de perfil:</label>
        <input class="form-control" type="file" name="image" id="image">
    </div>

    <button type="submit">Enviar</button>
</form>


    <script type="text/javascript" async>
        const form = document.querySelector("#form");
        const image = document.querySelector("#imgUser");
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/profile"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        if(user) {
            console.log(user);
            console.log(user.email)
            image.setAttribute("src", user.image);
        }
        });
    </script>

</body>
</html>