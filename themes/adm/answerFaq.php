<?php
var_dump($faq);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="post" id="form">
        <p>Nome do usuário: <?= $faq->userName?></p>
        <p>Email do usuário: <?= $faq->userEmail?></p>
        <label for="answer">Resposta:</label>
        <input type="text" name="answer" placeholder="Resposta" value="<?= $faq->answer?>">

        <button type="submit">Enviar</button>
    </form>

    <script type="text/javascript" async>
        const form = document.querySelector("#form");
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataUser = new FormData(form);
            const data = await fetch("<?= url("admin/responderFaq/id?id=" . $faq->id)?>",{
                method: "POST",
                body: dataUser,
            });
            const faq = await data.json();
            console.log(faq);
        });
    </script>
</body>
</html>
