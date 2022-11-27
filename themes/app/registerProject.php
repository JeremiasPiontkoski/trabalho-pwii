<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Projetos</title>
</head>
<body>

    <form action="" id="formProject">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name">
        <label for="description">Descrição:</label>
        <input type="text" id="name" name="description">
        <label for="vacancies">Vagas:</label>
        <input type="number" id="vacancies" name="vacancies">
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

        <button type="submit">Enviar</button>

    </form>

    <script type="text/javascript" async>
        const form = document.querySelector("#formProject"); // id do formulário
        const message = document.querySelector("#message"); // id da div message
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataUser = new FormData(form);
            // enviar para a rota já definida
            const data = await fetch("<?= url("app/cadastroProjeto"); ?>",{
                method: "POST",
                body: dataUser,
            });
            const user = await data.json();
            console.log(user);
            // if(user) {
            //     if(user.type == "success") {
            //         window.location.href = "<?= url("app"); ?>";
            //     }else {
            //         message.innerHTML = user.message; 
            //         message.classList.remove("warning", "error");
            //         message.classList.add("message");
            //         message.classList.add(`${user.type}`);
            //     }
            // }
        });
    </script>
    
</body>
</html>