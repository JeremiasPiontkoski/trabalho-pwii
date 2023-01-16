<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criação de FAQ</title>
    <link rel="stylesheet" href="<?= url("assets/adm/style/style.css") ?>">
</head>
<body>
<section class="container">
    <div class="content">
        <form id="form" method="post">
            <header><h1>CADASTRO FAQ</h1></header>
            <div class="line">
                <label for="question">Pergunta:</label>
                <input type="text" placeholder="Pergunta" name="question" id="question" required>
            </div>
            <div class="line">
                <label for="answer">Resposta:</label>
                <input type="text" placeholder="Resposta:" name="answer" id="answer" required>
            </div>
            <div class="data-error">
                <p id="message"></p>
            </div>
            <button type="submit">Cadastrar</button>
       </form>

        <script type="text/javascript" async>
          const form = document.querySelector("#form");
            const message = document.querySelector("#message");
           form.addEventListener("submit", async (e) => {
                e.preventDefault();
                const dataUser = new FormData(form);
                const data = await fetch("<?= url("admin/registroFaq"); ?>",{
                    method: "POST",
                    body: dataUser,
                });
                const faq = await data.json();
               console.log(faq);
               if(faq.type == "success") {
                                        window.location.href = "<?= url("admin/faqs") ?>";
                                    }else {
                                        message.innerHTML = user.message;
                                        message.classList.remove("warning", "error");
                                        message.classList.add("message");
                                        message.classList.add(`${user.type}`);
                                    }
            });
        </script>
    </div>
</section>
</body>
</html>
