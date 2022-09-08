<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200&display=swap');
    </style>
    <link rel="stylesheet" href="<?= url("assets/web/css/style-cadastro.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/web/css/style-message.css") ?>">
    <title>To Solve - Cadastro</title>
</head>
<body>
    <section>
            <div class="card-register">
                <form id="form-register" novalidate>
                    <h1>Cadastro</h1>
                    <div class="container-inputs">
                        <label for="name">Nome:</label>
                        <input type="text" placeholder="Nome:" name="name" id="name" required>
                    </div>
                    <div class="container-inputs">
                        <label for="email">Email:</label>
                        <input type="email" placeholder="Email:" name="email" id="email" required>
                    </div>
                    <div class="container-inputs">
                        <label for="password">Senha:</label>
                        <input type="password" placeholder="Senha:" name="password" id="password" required>
                    </div>
                    <div class="container-inputs">
                        <label for="confirmPassoword">Confirme:</label>
                        <input type="password" placeholder="Confirme a Senha:" name="confirmPassword" id="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn-register">Cadastrar</button>

                    <div class="data-error"> 
                        <p id="message"></p>                               
                    </div>

                    <div class="not-acount">
                            <p>Possui uma conta?
                            <a href="<?= url("login") ?>">Faça o login!</a></p>
                        </div>
                </form>

                <script type="text/javascript" async>
                            const form = document.querySelector("#form-register"); // id do formulário
                            const message = document.querySelector("#message"); // id da div message
                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataUser = new FormData(form);
                                // enviar para a rota já definida
                                const data = await fetch("<?= url("cadastro"); ?>",{
                                    method: "POST",
                                    body: dataUser,
                                });
                                const user = await data.json();
                                console.log(user);
                                // tratamento da mensagem
                                if(user) {
                                    if(user.type == "success") {
                                        window.location.href = "login";
                                    }else {
                                        message.innerHTML = user.message;
                                        message.classList.remove("warning", "error");
                                        message.classList.add("message");
                                        console.log(`${user.type}`);
                                        message.classList.add(`${user.type}`);
                                    }
                                }
                            });
                        </script>
            </div>
    </section>
</body>
</html>