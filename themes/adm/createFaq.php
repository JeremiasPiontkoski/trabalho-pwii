<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criação de FAQ</title>
    <link rel="stylesheet" href="<?= url("assets/web/css/style-cadastro.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/web/css/style-message.css") ?>">
</head>
<body>
<section>
    <div class="card-register">
        <form id="form-register" novalidate method="post">
            <h1>CADASTRO FAQ</h1>
            <div class="container-inputs">
                <label for="question">Pergunta:</label>
                <input type="text" placeholder="Pergunta" name="question" id="question" required>
            </div>
            <div class="container-inputs">
                <label for="answer">Resposta:</label>
                <input type="text" placeholder="Resposta:" name="answer" id="answer" required>
            </div>
            <button type="submit" class="btn-register">Cadastrar</button>

            <div class="data-error">
                <p id="message"></p>
            </div>
       </form>

        <script type="text/javascript" async>
          const form = document.querySelector("#form-register");
            const message = document.querySelector("#message");
           form.addEventListener("submit", async (e) => {
                e.preventDefault();
                const dataUser = new FormData(form);
                const data = await fetch("<?= url("admin/registroFaq"); ?>",{
                    method: "POST",
                    body: dataUser,
                });
                const user = await data.json();
               console.log(user);

            });
        </script>
    </div>
</section>
</body>
</html>
