<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= url("assets/web/css/style-cadastro.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/web/css/style-message.css") ?>">
    <title>Editar FAQ</title>
</head>
<body>
<section>
    <div class="card-register">
        <form action="post" id="form">
            <h1>EDIÇÃO DE FAQ</h1>

            <div class="container-inputs">
                <label for="question">Pergunta:</label>
                <input type="text" name="question" value="<?= $faq->question ?>">
            </div>

            <div class="container-inputs">
                <label for="answer">Resposta:</label>
                <input type="text" name="answer" value="<?= $faq->answer ?>">
            </div>

            <button type="submit" class="btn-register">EDITAR</button>
            <div class="data-error">
                <p id="message"></p>
            </div>
        </form>
        <script type="text/javascript" async>
            const form = document.querySelector("#form");
            const message = document.querySelector("#message");
            form.addEventListener("submit", async (e) => {
                e.preventDefault();
                const dataUser = new FormData(form);
                const data = await fetch("<?= url("admin/editarFaq/id?id=" . $faq->id)?>",{
                    method: "POST",
                    body: dataUser,
                });
                const user = await data.json();
                console.log(user);
                // message.classList.add("message");
                // message.classList.remove("success", "warning", "error");
                // message.classList.add(`${user.type}`);
                // message.innerHTML = user.message;
            });
        </script>
    </div>
</section>
</body>
</html>
