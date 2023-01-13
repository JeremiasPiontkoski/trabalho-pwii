<?php
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="post" id="form" novalidate>
    <label for="Name">Nome:</label>
    <input type="text" name="name">

    <label for="email">Email:</label>
    <input type="email" name="email">

    <label for="password">Senha:</label>
    <input type="password" name="password">

    <label for="confirmPassword">Confirme a Senha:</label>
    <input type="password" name="confirmPassword">

    <button type="submit">Registrar</button>
</form>

<script type="text/javascript" async>
    const form = document.querySelector("#form");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("admin/registrarAdm"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();

        console.log(user);
    });
</script>

</body>
</html>
