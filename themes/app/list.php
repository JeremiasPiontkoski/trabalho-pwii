<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista Clientes</h1>

    <?php var_dump($_SESSION["user"]) ?>
    <?=$user["name"];?><br>
    <?= $user["email"];?><br>

    <form enctype="multipart/form-data" method="post" id="form">

    <?php
              if(!empty($user["image"])):
            ?>
            
            <img src="<?= url($user["image"]); ?>" id="image">
            
            <?php
              endif;
            ?>

        <input class="form-control" type="file" name="image" id="image">
        <input type="text" name="identificador" id="">

        <button type="submit">Enviar</button>
    </form>

    <script type="text/javascript" async>
        const form = document.querySelector("#form");
        const image = document.querySelector("#image");
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
            image.setAttribute("src", user.image);
            location.reload();
        }
    
        });
    </script>

</body>
</html>