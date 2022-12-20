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

    <section class="container">
        <div class="content">
            <header>
                <img src=<?= url("assets/web/imgs/toSolveLogo/dark-col.svg")?> alt="Logo ToSolve">
                <h1>Cadastro</h1>
            </header>

            <form id="form" novalidate>
                <div class="line">
                    <label for="userType">Escolha o tipo de usuário:</label>
                    <select name="userType" id="userType">
                         <?php
                            foreach($typeUsers as $type) {
                                ?>
                                <option value="<?= $type->id ?>"><?= $type->type ?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div>

                <div class="line">
                    <label for="name">Nome:</label>
                     <input type="text" placeholder="Nome" name="name" id="name" required>
                </div>

                <div class="line">
                    <label for="email">Email:</label>
                    <input type="email" placeholder="Email" name="email" id="email" required>
                </div>

                <div class="line">
                    <label for="password">Senha:</label>
                    <input type="password" placeholder="Senha" name="password" id="password" required>
                </div>

                <div class="line">
                    <label for="confirmPassoword">Confirme:</label>
                    <input type="password" placeholder="Confirme a Senha" name="confirmPassword" id="confirmPassword" required>
                </div>

                <div class="line forCompany">
                        <label for="cnpj" class="forCompany">CNPJ:</label>
                        <input type="text" name="cnpj" id="cnpj" class="forCompany" placeholder="CNPJ">
                    </div>

                <button>Cadastro</button>

                <div class="data-error">
                    <p id="message">
                    </p>
                </div>

                <div class="not-acount">
                    <p>
                        Possui conta ?
                        <a href="<?= url("login") ?>">Faça o Login!</a>
                    </p>
                </div>
            </form>

        </div>
    </section>

           <!--  <div class="card-register">
                <form id="form">
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

                    <div class="container-inputs forCompany">
                        <label for="cnpj" class="forCompany">CNPJ:</label>
                        <input type="text" name="cnpj" id="cnpj" class="forCompany" placeholder="CNPJ">
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
            </div> -->

            <script type="text/javascript" async>
                            const form = document.querySelector("#form");
                            const message = document.querySelector("#message"); 
                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataUser = new FormData(form);
                                const data = await fetch("<?= url("registro"); ?>",{
                                    method: "POST",
                                    body: dataUser,
                                });
                                const user = await data.json();

                                console.log(user);
                                if(user) {
                                    if(user.type == "success") {
                                        window.location.href = "<?= url("login") ?>";
                                    }else {
                                        message.innerHTML = user.message;
                                        message.classList.remove("warning", "error");
                                        message.classList.add("message");
                                        message.classList.add(`${user.type}`);
                                    }
                                }
                            });
                    </script>

    <script src="<?= url("assets/web/scripts/register.js") ?>"></script>

</body>
</html>