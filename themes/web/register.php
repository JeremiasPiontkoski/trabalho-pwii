<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Montserrat&display=swap');
    </style>
    <!-- <link rel="stylesheet" href="<?= url("assets/web/css/style-cadastro.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/web/css/style-message.css") ?>"> -->
    <!-- <link rel="stylesheet" href="../../assets/web/css/style-cadastro.css">
    <link rel="stylesheet" href="../../assets/web/css/style-message.css"> -->

    <link rel="stylesheet" href="<?= url("assets/web/style/style.css") ?>">

    <title>To Solve - Cadastro</title>
</head>

<body>
            <div class="card-register">
                <form id="form-register" novalidate>
                    <h1>Cadastro</h1>

                    <select name="userType" id="userType">
                         <?php
                            foreach($typeUsers as $type) {
                                ?>
                                <option value="<?= $type->id ?>"><?= $type->type ?></option>
                                <?php
                            }
                            ?>
                    </select>

                    <div class="container-inputs">
                        <label for="name">Nome:</label>
                        <input type="text" placeholder="Nome" name="name" id="name" required>
                    </div>
                    <div class="container-inputs">
                        <label for="email">Email:</label>
                        <input type="email" placeholder="Email" name="email" id="email" required>
                    </div>
                    <div class="container-inputs">
                        <label for="password">Senha:</label>
                        <input type="password" placeholder="Senha" name="password" id="password" required>
                    </div>
                    <div class="container-inputs">
                        <label for="confirmPassoword">Confirme:</label>
                        <input type="password" placeholder="Confirme a Senha" name="confirmPassword" id="confirmPassword" required>
                    </div>

                    <div class="container-inputs forPerson">
                        <label for="cpf" class="forPerson" >CPF:</label>
                        <input type="number" name="cpf" id="cpf" class="forPerson" placeholder="CPF">
                    </div>

                    <!-- ADICIONAR FOREACH TABELA CATEGORIAS -->
                    <div class="container-inputs forPerson">
                        <label for="language" class="forPerson">Linguagem:</label>
                        <select name="language" id="selectUser" class="forPerson">
                            <option value="">Escolha...</option>
                            <!-- <option value="javaScript">JavaScript</option>
                            <option value="java">Java</option>
                            <option value="htmlCss">HTML E CSS</option>
                            <option value="php">Php</option>
                            <option value="python">Python</option> -->
                            <?php
                            foreach($languages as $language) {
                                ?>
                                <option value="<?= $language->id ?>"><?= $language->language ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="container-inputs forCompany">
                        <label for="cnpj" class="forCompany">CNPJ:</label>
                        <input type="text" name="cnpj" id="cnpj" class="forCompany" placeholder="CNPJ">
                    </div>

                    <div class="container-inputs forCompany">
                        <label for="typeDevelopment" class="forCompany">Tipo de software:</label>
                        <select name="typeDevelopment" id="typeDevelopment" class="forCompany">
                            <option value="">Escolha</option>
                            <?php
                            foreach($types as $type) {
                                ?>
                                <option value="<?= $type->id ?>"><?= $type->type ?></option>
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
                                const data = await fetch("<?= url("registro"); ?>",{
                                    method: "POST",
                                    body: dataUser,
                                });
                                const user = await data.json();

                                console.log(user);
                                if(user) {
                                    if(user.type == "success") {
                                        window.location.href = "login";
                                    }else {
                                        message.innerHTML = user.message;
                                        message.classList.remove("warning", "error");
                                        message.classList.add("message");
                                        message.classList.add(`${user.type}`);
                                    }
                                }
                            });
                    </script>
            </div>

    <script src="<?= url("assets/web/scripts/register.js") ?>"></script>

</body>
</html>