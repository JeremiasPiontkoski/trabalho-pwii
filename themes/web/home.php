<?php
  $this->layout("_theme");
?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src=<?= url("assets/web/images/img-slider/doc.jpg")?> class="d-block w-100" alt="...">
                <div class="content-text">
                    <h5>Crie o seu repositório online</h5>
                    <p>O site possui um sistema de repositórios para cada usuário possa ter o seu, mostrando ao mundo o seu trabalho.</p>
                    <a href="#repositories">Vamo nessa!</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src=<?= url("assets/web/images/img-slider/people-pc.jpg")?> class="d-block w-100" alt="...">
                <div class="content-text">
                    <h5>Procure por um repositório</h5>
                    <p>Pesquise por repositórios, veja os projetos incríveis que as pessoas estão fazendo.</p>
                    <a href="#repositories">Vamo nessa!</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src=<?= url("assets/web/images/img-slider/person-cell.jpg")?> class="d-block w-100" alt="...">
                <div class="content-text">
                    <h5>Entre em contato conosco!</h5>
                    <p>Reportar algum bug, casos de ofensas ou conteúdo impróprio ou até mesmo dúvidas entre outras coisas, entre em contato.</p>
                    <a href="#whoWeAre">Vamo nessa!</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>


    <section class="cards" id="repositories">
        <div class="main-cards">
            <div class="card">
                <img class="card-img-top" src=<?= url("assets/web/images/img-cards/create.jpg")?> alt="Card image cap">
                <div class="card-body">
                    <div class="card-mobile">
                        <h5 class="card-title">Crie o seu repositório</h5>
                        <p class="card-text">Crie um repositório online e 100% gratuito em nossa plataforma!</p>                       
                            <a href="#" class="btn btn-primary">Vamo nessa!</a>                      
                    </div>
                </div>
            </div>

            <div class="card">
                <img class="card-img-top" src=<?= url("assets/web/images/img-cards/search.jpg")?> alt="Card image cap">
                <div class="card-body">
                    <div class="card-mobile">
                        <h5 class="card-title">Procure um repositório</h5>
                        <p class="card-text">Descubra projetos incríveis criados por nossos membros, ajudando a comunidade.</p>
                        <a href="#" class="btn btn-primary">Vamo nessa!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
