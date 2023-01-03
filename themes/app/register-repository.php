

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200&display=swap');
    </style>
    <link rel="stylesheet" href="<?= url("assets/app/style/style.css") ?>">
    <title>To Solve - Cadastro</title>
</head>
<body>
    <section class="container">
        <div class="content">
            <header><h1>Cadastro de Repositório</h1></header>
            <form enctype="multipart/form-data" method="post" id="form">
                <div class="line">
                    <label for="name">Nome:</label>
                    <input type="text" placeholder="Nome" name="name" id="name">
                </div>

                <div class="line">
                    <label for="language">Escolha a linguagem:</label>
                    <select name="language" id="selectUser">
                            <option value="">Escolha...</option>                    
                            <?php
                            foreach($languages as $language) {
                                ?>
                                <option value="<?= $language->id ?>"><?= $language->language ?></option>
                                <?php
                            }
                            ?>
                        </select>
                </div>

                <div class="line">
                    <label for="description">Descrição:</label>
                    <input type="text" name="description" placeholder="Descrição" id="description">
                </div>

                <div class="line">
                    <label for="file">Arquivo:</label>
                    <input class="form-control" type="file" name="file" id="file">
                </div>

                <button>Cadastrar</button>

                <div class="data-error">
                    <p id="message"></p>
                </div>
            </form>
        </div>
    </section>

    <!-- <section>
            <div class="card-register">
                <form id="form-register" novalidate>
                    <h1>CADASTRO REPOSITÓRIO</h1>
                    <div class="container-inputs">
                        <label for="name">Nome:</label>
                        <input type="text" placeholder="Nome:" name="name" id="name" required>
                    </div>
                    <div class="container-inputs">
                        <select name="language" id="selectUser">
                            <option value="">Escolha...</option>                    
                            <?php
                            foreach($languages as $language) {
                                ?>
                                <option value="<?= $language->id ?>"><?= $language->language ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="container-inputs">
                        <label for="description">Descrição:</label>
                        <input type="text" placeholder="Descrição:" name="description" id="description" required>
                    </div>
                    <button type="submit" class="btn-register">Cadastrar</button>

                    <div class="data-error">
                        <p id="message"></p>
                    </div>


                </form>

                
            </div>
    </section> -->

    <script type="text/javascript" async>
                            const form = document.querySelector("#form");
                            const message = document.querySelector("#message");
                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataUser = new FormData(form);
                                // enviar para a rota já definida
                                const data = await fetch("<?= url("app/cadastroRepositorio"); ?>",{
                                    method: "POST",
                                    body: dataUser,
                                });
                                const user = await data.json();
                                console.log(user);
                                if(user) {
                                    if(user.type == "success") {
                                        window.location.href = "<?= url("app"); ?>";
                                    }else {
                                        message.innerHTML = user.message; 
                                        message.classList.remove("warning", "error");
                                        message.classList.add("message");
                                        message.classList.add(`${user.type}`);
                                    }
                                }
                            });
                    </script>
</body>
</html>