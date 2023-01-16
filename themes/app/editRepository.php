
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
    <link rel="stylesheet" href="<?= url("assets/app/style/style.css") ?>">
</head>
<body>
<section class="container">
    <div class="content">
        <header><h1>Edição de repositorio</h1></header>
        <form enctype="multipart/form-data" method="post" id="form">
            <div class="line">
            <label for="name">Name:</label>
                    <input type="text" name="name" value="<?= $repository["name"] ?>">
            </div>
            <div class="line">
            <label for="description">Descrição:</label>
                    <input type="text" name="description" value="<?= $repository["description"]; ?>">
            </div>
            <div class="line">
            <label for="idLanguage">Linguagem:</label>
                        <select name="idLanguage" id="selectUser">
                            <?php
                            foreach($languages as $language) {
                                ?>
                                <?php
                                if(($language->id == $repository["idLanguage"])){
                                    ?>
                                    <option value="<?= $repository["idLanguage"]; ?>">
                                    <?= $repository["language"] ?>
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
                                if(($language->language != $repository["language"])){
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
            <div class="line">
            <label for="file">Arquivo:</label>
                    <input class="form-control" type="file" name="file" id="file">
            </div>
            <button>Editar</button>

                <div class="data-error">
                    <p id="message"></p>
                </div>
        </form>
    </div>
</section>

    <!-- <section>
        <div class="card-register">
            <form enctype="multipart/form-data" method="post" id="form">
                <h1>EDIÇÃO DE REPOSITÓRIO</h1>

                <div class="container-inputs">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?= $repository["name"] ?>">
                </div>

                <div class="container-inputs">
                    <label for="description">Descrição:</label>
                    <input type="text" name="description" value="<?= $repository["description"]; ?>">
                </div>
                    <div class="container-inputs">
                        <label for="idLanguage">Linguagem:</label>
                        <select name="idLanguage" id="selectUser">
                            <?php
                            foreach($languages as $language) {
                                ?>
                                <?php
                                if(($language->id == $repository["idLanguage"])){
                                    ?>
                                    <option value="<?= $repository["idLanguage"]; ?>">
                                    <?= $repository["language"] ?>
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
                                if(($language->language != $repository["language"])){
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
                <div class="container-inputs">
                    <label for="file">Arquivo:</label>
                    <input class="form-control" type="file" name="file" id="file">
                </div>
                <button type="submit" class="btn-register">EDITAR</button>
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
            const data = await fetch("<?= url("app/editarRepositorio/id?id=" . $repository["id"])?>",{
                method: "POST",
                body: dataUser,
            });
            const user = await data.json();
            // console.log(user);
            if(user) {
                if(user.type == "success") {
                    window.location.href = "<?= url("app/repositorio/id?id=" . $_GET["id"]); ?>";
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
