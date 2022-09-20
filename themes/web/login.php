<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("assets/web/css/style-login.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/web/css/style-message.css") ?>">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200&display=swap');
</style>
    <title>To Solve - Login</title>
</head>
<body>
    <section>
        <div class="left-login">           
        </div>
                <div class="card-login">
                    <form id="form-login">
                        <h1>Login</h1>
                        <div class="container-inputs">
                            <label for="name">Email:</label>
                            <input type="email" name="email" id="email" placeholder="Email:">
                        </div>
                        <div class="container-inputs">
                            <label for="password">Senha:</label>
                            <input type="password" name="password" id="password" placeholder="Senha:">
                        </div>
                        <button type="submit" class="btn-login">Login</button>

                        <div class="data-error"> 
                            <p id="message"></p>                               
                        </div>  

                        <div class="not-acount">
                            <p>Não possui uma conta?
                                <a href="<?= url("cadastro") ?>">Crie Uma!</a></p>
                        </div>
                    </form>

                    <script type="text/javascript" async>
                            const form = document.querySelector("#form-login");
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
                                if(user) {
                                    if(user.type === "success"){
                                        window.location.href = "home";
                                        console.log(`${user.idUser}`)
                                    } else {
                                        message.innerHTML = user.message;
                                    }
                                    console.log(`${user.type}`);
                                    message.classList.add("message");
                                    message.classList.remove("success", "warning", "error");
                                    message.classList.add(`${user.type}`);
                                }
                            });
                        </script>
                </div>
    </section>
</body>
</html>