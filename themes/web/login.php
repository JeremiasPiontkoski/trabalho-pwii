<?php
    session_start();
    if(!empty($_SESSION["user"])) {
        header("Location:http://www.localhost/trabalho-pwii/app");
    }else if(!empty($_SESSION["admin"])) {
        header("Location:http://www.localhost/trabalho-pwii/admin");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("assets/web/style/style.css") ?>">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200&display=swap');
</style>
    <title>To Solve - Login</title>
</head>
<body>

    <section class="container">
            <div class="content">
                <header>
                    <img src=<?= url("assets/web/imgs/toSolveLogo/dark-col.svg")?> alt="Logo ToSolve">
                    <h1>Login</h1>
                </header>
                <form id="form">
                    <div class="line">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="line">
                        <label for="password">Senha:</label>
                        <input type="password" name="password" id="password" placeholder="Senha">
                    </div>
                    <button>Login</button>
                    <div class="data-error">
                        <p id="message">
                        </p>
                    </div>
                    <div class="not-acount">
                        <p>Não possui conta ?
                            <a href="<?= url("registro") ?>">Crie Uma!</a>
                        </p>
                    </div>
            </form>
            </div>
    </section>

    <script type="text/javascript" async>
                            const form = document.querySelector("#form");
                            const message = document.querySelector("#message");
                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataUser = new FormData(form);
                                const data = await fetch("<?= url("login"); ?>",{
                                    method: "POST",
                                    body: dataUser,
                                });
                                const user = await data.json();
                                console.log(user);  
                                
                                if(user.type == "success") {
                                    window.location.href = "<?= url("app"); ?>";
                                }else if (user.type == "admin") {
                                    window.location.href = "<?= url("admin"); ?>";
                                }
                                else {
                                   message.classList.add("message");
                                   message.classList.remove("success", "warning", "error");
                                   message.classList.add(`${user.type}`);
                                   message.innerHTML = user.message;
                                }
                            });
                        </script>

</body>
</html>