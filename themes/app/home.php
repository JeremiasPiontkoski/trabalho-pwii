<?php
  $this->layout("_theme");
?>

<?php $this->start("css"); ?>
    <link rel="stylesheet" href="<?= url("assets/app/") ?>css/style.css">
<?php $this->end(); ?>

    <section class="box-user">
        <div class="box-left">
            <div class="box-top">
                <div class="radius"></div>
            </div>
            <div class="box-bottom">
                <div class="content">
                    
                    <p><?=$user["name"];?></p>
                    <p><?=$user["email"];?></p>
                    <p><?=$user["description"];?></p>                   
                </div>
                <div class="btn-edit">
                    <a href="<?php url()?>profile">Editar</a>
                </div>
            </div>
        </div>

        <div class="box-right">
            <div class="box-repositories">
                <div class="box-head">
                    <h1>Repositórios</h1>
                </div>
                <?php
            foreach($repositories as $repository) {
            ?>
                <div class="box-content">
                    <p><?= $repository->name; ?></p>
                </div>
               <?php
            }
               ?>
                <div class="box-bottom">
                    <a href="<?php url() ?>app/cadastroRepositorio">Criar Novo</a>
                </div>
            </div>
            <div class="box-repositories">
                <div class="box-head">
                    <h1>Favoritos</h1>
                </div>
                <div class="box-content">
                    <p>Name</p>
                    <svg class="icon-close" width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg" id="icon-close">
                        <path d="M3.81844 0.000383607C3.49279 0.000383607 3.16678 0.133292 2.91861 0.399876L0.373218 3.12708C-0.124406 3.66025 -0.124406 4.52349 0.373218 5.0553L9.65494 15L0.373218 24.9447C-0.124406 25.4779 -0.124406 26.3411 0.373218 26.8729L2.91861 29.6001C3.41623 30.1333 4.22193 30.1333 4.71828 29.6001L14 19.6554L23.2817 29.6001C23.7781 30.1333 24.585 30.1333 25.0814 29.6001L27.6268 26.8729C28.1244 26.3398 28.1244 25.4765 27.6268 24.9447L18.3451 15L27.6268 5.0553C28.1244 4.52349 28.1244 3.65888 27.6268 3.12708L25.0814 0.399876C24.5838 -0.133292 23.7781 -0.133292 23.2817 0.399876L14 10.3446L4.71828 0.399876C4.46947 0.133292 4.14409 0.000383607 3.81844 0.000383607Z" fill="white"/>
                        </svg> 
                </div>
                <div class="box-content">
                    <p>Name</p>
                    <svg class="icon-close" width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg" id="icon-close">
                        <path d="M3.81844 0.000383607C3.49279 0.000383607 3.16678 0.133292 2.91861 0.399876L0.373218 3.12708C-0.124406 3.66025 -0.124406 4.52349 0.373218 5.0553L9.65494 15L0.373218 24.9447C-0.124406 25.4779 -0.124406 26.3411 0.373218 26.8729L2.91861 29.6001C3.41623 30.1333 4.22193 30.1333 4.71828 29.6001L14 19.6554L23.2817 29.6001C23.7781 30.1333 24.585 30.1333 25.0814 29.6001L27.6268 26.8729C28.1244 26.3398 28.1244 25.4765 27.6268 24.9447L18.3451 15L27.6268 5.0553C28.1244 4.52349 28.1244 3.65888 27.6268 3.12708L25.0814 0.399876C24.5838 -0.133292 23.7781 -0.133292 23.2817 0.399876L14 10.3446L4.71828 0.399876C4.46947 0.133292 4.14409 0.000383607 3.81844 0.000383607Z" fill="white"/>
                        </svg> 
                </div>
                <div class="box-content">
                    <p>Name</p>
                    <svg class="icon-close" width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg" id="icon-close">
                        <path d="M3.81844 0.000383607C3.49279 0.000383607 3.16678 0.133292 2.91861 0.399876L0.373218 3.12708C-0.124406 3.66025 -0.124406 4.52349 0.373218 5.0553L9.65494 15L0.373218 24.9447C-0.124406 25.4779 -0.124406 26.3411 0.373218 26.8729L2.91861 29.6001C3.41623 30.1333 4.22193 30.1333 4.71828 29.6001L14 19.6554L23.2817 29.6001C23.7781 30.1333 24.585 30.1333 25.0814 29.6001L27.6268 26.8729C28.1244 26.3398 28.1244 25.4765 27.6268 24.9447L18.3451 15L27.6268 5.0553C28.1244 4.52349 28.1244 3.65888 27.6268 3.12708L25.0814 0.399876C24.5838 -0.133292 23.7781 -0.133292 23.2817 0.399876L14 10.3446L4.71828 0.399876C4.46947 0.133292 4.14409 0.000383607 3.81844 0.000383607Z" fill="white"/>
                        </svg> 
                </div>
                <div class="box-content">
                    <p>Name</p>
                    <svg class="icon-close" width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg" id="icon-close">
                        <path d="M3.81844 0.000383607C3.49279 0.000383607 3.16678 0.133292 2.91861 0.399876L0.373218 3.12708C-0.124406 3.66025 -0.124406 4.52349 0.373218 5.0553L9.65494 15L0.373218 24.9447C-0.124406 25.4779 -0.124406 26.3411 0.373218 26.8729L2.91861 29.6001C3.41623 30.1333 4.22193 30.1333 4.71828 29.6001L14 19.6554L23.2817 29.6001C23.7781 30.1333 24.585 30.1333 25.0814 29.6001L27.6268 26.8729C28.1244 26.3398 28.1244 25.4765 27.6268 24.9447L18.3451 15L27.6268 5.0553C28.1244 4.52349 28.1244 3.65888 27.6268 3.12708L25.0814 0.399876C24.5838 -0.133292 23.7781 -0.133292 23.2817 0.399876L14 10.3446L4.71828 0.399876C4.46947 0.133292 4.14409 0.000383607 3.81844 0.000383607Z" fill="white"/>
                        </svg> 
                </div>
                <div class="box-content">
                    <p>Name</p>
                    <svg class="icon-close" width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg" id="icon-close">
                        <path d="M3.81844 0.000383607C3.49279 0.000383607 3.16678 0.133292 2.91861 0.399876L0.373218 3.12708C-0.124406 3.66025 -0.124406 4.52349 0.373218 5.0553L9.65494 15L0.373218 24.9447C-0.124406 25.4779 -0.124406 26.3411 0.373218 26.8729L2.91861 29.6001C3.41623 30.1333 4.22193 30.1333 4.71828 29.6001L14 19.6554L23.2817 29.6001C23.7781 30.1333 24.585 30.1333 25.0814 29.6001L27.6268 26.8729C28.1244 26.3398 28.1244 25.4765 27.6268 24.9447L18.3451 15L27.6268 5.0553C28.1244 4.52349 28.1244 3.65888 27.6268 3.12708L25.0814 0.399876C24.5838 -0.133292 23.7781 -0.133292 23.2817 0.399876L14 10.3446L4.71828 0.399876C4.46947 0.133292 4.14409 0.000383607 3.81844 0.000383607Z" fill="white"/>
                        </svg> 
                </div>                
            </div>
        </div>
    </section>

    
