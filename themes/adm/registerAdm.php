<?php
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= url("assets/adm/style/style.css") ?>">
    <title>Registro ADM</title>
</head>
<body>
<section class="container">
    <div class="content">
        <header><h1>CRIAÇÃO DE ADM</h1></header>
        <form action="post" id="form">
            <div class="line">
            <label for="Name">Nome:</label>
            <input type="text" name="name" placeholder="Nome">
            </div>

            <div class="line">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email">
            </div>

            <div class="line">
            <label for="password">Senha:</label>
            <input type="password" name="password" placeholder="Senha">
            </div>

            <div class="line">
            <label for="confirmPassword">Confirme a Senha:</label>
            <input type="password" name="confirmPassword" placeholder="Confirme a senha">
            </div>

            <div class="data-error">
                <p id="message"></p>
            </div>

    <button type="submit">Registrar</button>
</form>
    </div>
</section>

<script type="text/javascript" async>
    const form = document.querySelector("#form");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("admin/registrarAdm"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const faq = await data.json();
                console.log(faq);
                if(faq.type == "success") {
                                        window.location.href = "<?= url("admin/faqs") ?>";
                                    }else {
                                        message.innerHTML = faq.message;
                                        message.classList.remove("warning", "error");
                                        message.classList.add("message");
                                        message.classList.add(`${faq.type}`);
                                    }
    });
</script>

</body>
</html>
