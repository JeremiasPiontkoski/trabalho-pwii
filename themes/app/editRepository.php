

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edição de Repositório</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200&display=swap');
    </style>
    <link rel="stylesheet" href="<?= url("assets/web/css/style-cadastro.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/web/css/style-message.css") ?>">
</head>
<body>
    <section>
        <div class="card-register">
            <form action="post" id="formRepository">
                <h1>EDIÇÃO DE REPOSITÓRIO</h1>

                <div class="container-inputs">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?= $repository->name ?>">
                </div>

                <div class="container-inputs">
                    <label for="description">Descrição:</label>
                    <input type="text" name="description" value="<?= $repository->description ?>">
                </div>
                <?php
                if(!empty($_SESSION["userPerson"])) {?>
                    <div class="container-inputs">
                        <label for="idLanguage">Linguagem:</label>
                        <select name="idLanguage" id="selectUser">
                            <?php
                            foreach($languages as $language) {
                                ?>
                                <?php
                                if(($language->id == $repository->idLanguage)){
                                    ?>
                                    <option value="<?= $repository->idLanguage; ?>">
                                    <?= $language->language ?>
                                    <?php
                                }
                                ?>
                                </option>
                                <?php
                            }
                            ?>
                            <?php
                            foreach($languages as $language) {
                                ?>
                                <?php
                                if(($language->id != $_SESSION["userPerson"]["idLanguage"])){
                                    ?>
                                    <option value="<?= $language->id?>">
                                    <?= $language->language ?>
                                    <?php
                                }
                                ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }
                ?>
                <button type="submit" class="btn-register">EDITAR</button>
                <div class="data-error">
                    <p id="message"></p>
                </div>
            </form>
        </div>
    </section>

    <script type="text/javascript" async>
        const form = document.querySelector("#formRepository");
        const message = document.querySelector("#message");
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataUser = new FormData(form);
            const data = await fetch("<?= url("app/editarRepositorio/id?id=" . $repository->idRepository)?>",{
                method: "POST",
                body: dataUser,
            });
            const user = await data.json();
            console.log(user);
            message.classList.add("message");
            message.classList.remove("success", "warning", "error");
            message.classList.add(`${user.type}`);
            message.innerHTML = user.message;
            window.location.href = "<?= url("app/repositorio/id?id=" . $_GET["id"])?>";
        });
    </script>

</body>
</html>
