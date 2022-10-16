<!DOCTYPE html>
 <html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("assets/web/style/style.css") ?>">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Montserrat&display=swap');
    </style>
    <title>To - Solve</title>
 </head>
 <body>
    <nav class="navbar navbar-expand-lg" id="navigation">
        <div class="container-fluid">
            <span class="navbar-toggler text-color main-text icon-menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" aria-label="Toggle navigation">
              <svg class="icon-hamburger" width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.5 22.5H24.5V20H3.5V22.5ZM3.5 16.25H24.5V13.75H3.5V16.25ZM3.5 7.5V10H24.5V7.5H3.5Z" fill="white"/>
                </svg>                            
            </span>
            <span class="icon-menu navbar-toggler" href="#">
                <img src=<?= url("assets/web/images/toSolveLogo/logo1.png") ?> alt="Logo To Solve">                  
            </span>

            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop=" " tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <span class="navbar-toggler icon-menu" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg class="icon-close" width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg" id="icon-close">
                  <path d="M3.81844 0.000383607C3.49279 0.000383607 3.16678 0.133292 2.91861 0.399876L0.373218 3.12708C-0.124406 3.66025 -0.124406 4.52349 0.373218 5.0553L9.65494 15L0.373218 24.9447C-0.124406 25.4779 -0.124406 26.3411 0.373218 26.8729L2.91861 29.6001C3.41623 30.1333 4.22193 30.1333 4.71828 29.6001L14 19.6554L23.2817 29.6001C23.7781 30.1333 24.585 30.1333 25.0814 29.6001L27.6268 26.8729C28.1244 26.3398 28.1244 25.4765 27.6268 24.9447L18.3451 15L27.6268 5.0553C28.1244 4.52349 28.1244 3.65888 27.6268 3.12708L25.0814 0.399876C24.5838 -0.133292 23.7781 -0.133292 23.2817 0.399876L14 10.3446L4.71828 0.399876C4.46947 0.133292 4.14409 0.000383607 3.81844 0.000383607Z" fill="white"/>
                  </svg> 
              </span>
                </div>
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <span data-bs-dismiss="offcanvas"><a class="nav-link" href="#"></span>                                
                            <img src=<?= url("assets/web/images/toSolveLogo/logo1.png") ?> alt="Logo To Solve" class="img-logo">                            
                        </a>
                        </li>

                        <li class="nav-item">
                            <span data-bs-dismiss="offcanvas"><a class="nav-link" href="#navigation">Home</a></span>
                        </li>                       
                        
                        <li class="nav-item">
                            <span data-bs-dismiss="offcanvas"><a class="nav-link" href="#repositories">Repositórios</a></span>
                        </li>
                        <li class="nav-item">
                            <span data-bs-dismiss="offcanvas"><a class="nav-link" href="#contact">Contato</a></span>
                        </li>
                        <li class="nav-item">
                            <span data-bs-dismiss="offcanvas"><a class="nav-link" href="<?= url("login") ?>">Login</a></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


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
                    <h1>Crie o seu repositório online</h1>
                    <p>O site possui um sistema de repositórios para cada usuário possa ter o seu, mostrando ao mundo o seu trabalho.</p>
                    <a href="#repositories">Vamo nessa!</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src=<?= url("assets/web/images/img-slider/people-pc.jpg")?> class="d-block w-100" alt="...">
                <div class="content-text">
                    <h1>Procure por um repositório</h1>
                    <p>Pesquise por repositórios, veja os projetos incríveis que as pessoas estão fazendo.</p>
                    <a href="#repositories">Vamo nessa!</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src=<?= url("assets/web/images/img-slider/person-cell.jpg")?> class="d-block w-100" alt="...">
                <div class="content-text">
                    <h1>Entre em contato conosco!</h1>
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


    <section id="ourProducts">
        <h1>Nossos produtos</h1>
        <div class="products container-box">
            <div class="box box01">
                <img src=<?= url("assets/web/imgs/cards-ourProducts/personWithComputer.jpg")?> alt="...">
            </div>
            <div class="box box02">
                <div class="content">
                    <h2>Crie Repositórios</h2>
                    <p>Publique seus projetos para que pessoas de todo o mundo possam vê-lo!</p>
                </div>
                <div class="content">
                    <h2>Busque repositórios</h2>
                    <p>Explore uma infinidade de conteúdos disponíveis em nossa plataforma!</p>
                </div>

                <div class="content">
                    <a href="#">Vamo nessa!</a>
                </div>
            </div>
        </div>

        <div class="resources container-box">
            <div class="box box01">
                <img src=<?= url("assets/web/imgs/cards-ourProducts/peopleWithComputer.jpg")?> alt="...">
            </div>
            <div class="box box02">
                <div class="content">
                    <h2>Encontre amigos</h2>
                    <p>Com a nosso sistema você conseguirá dar follow nos seus amigos e até conseguir criar projetos compartilhados com eles. Não é uma maravilha? Entre para o nosso time!</p>
                </div>
                <div class="content">
                    <h2>Entre em projetos criados por grandes empresas</h2>
                    <p>Você já imaginou conseguir contribuir para um grande projeto? Pois bem, aqui você terá várias oportunidades incríveis para demonstrar os seus conhecimentos, e quem sabe, conseguir uma tão sonhada vaga de emprego, não é demais ?!</p>
                </div>

                <div class="content">
                    <a href="#">Vamo nessa!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="whyShouldUse">
        <h1>Porque usar?</h1>
        <div class="container-box">
            <div class="box box01">
                <p>oi</p>
            </div>
            <div class="box box02">
                <p>oi</p>
            </div>
        </div>
    </section>

    <!--<section id="whyShouldUse">
        <h1>Porque usar?</h1>
        <div class="container-box">
            <div class="box safety">
                <!-- <h3>Segurança</h3>
                <div class="line">
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.5 13.5L14.1625 20.5L10.5 17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 28.5C22.6274 28.5 28 23.1274 28 16.5C28 9.87258 22.6274 4.5 16 4.5C9.37258 4.5 4 9.87258 4 16.5C4 23.1274 9.37258 28.5 16 28.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Lorem ipsum dolor sit amet.</span>     
                </div>

                <div class="line">
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.5 13.5L14.1625 20.5L10.5 17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 28.5C22.6274 28.5 28 23.1274 28 16.5C28 9.87258 22.6274 4.5 16 4.5C9.37258 4.5 4 9.87258 4 16.5C4 23.1274 9.37258 28.5 16 28.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                        
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>

                <div class="line">
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.5 13.5L14.1625 20.5L10.5 17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 28.5C22.6274 28.5 28 23.1274 28 16.5C28 9.87258 22.6274 4.5 16 4.5C9.37258 4.5 4 9.87258 4 16.5C4 23.1274 9.37258 28.5 16 28.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                        
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>
            </div>
            <div class="box connectivity">
                <!-- <h3>Segurança</h3>
                <div class="line">
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.5 13.5L14.1625 20.5L10.5 17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 28.5C22.6274 28.5 28 23.1274 28 16.5C28 9.87258 22.6274 4.5 16 4.5C9.37258 4.5 4 9.87258 4 16.5C4 23.1274 9.37258 28.5 16 28.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Lorem ipsum dolor sit amet.</span>     
                </div>

                <div class="line">
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.5 13.5L14.1625 20.5L10.5 17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 28.5C22.6274 28.5 28 23.1274 28 16.5C28 9.87258 22.6274 4.5 16 4.5C9.37258 4.5 4 9.87258 4 16.5C4 23.1274 9.37258 28.5 16 28.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                        
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>

                <div class="line">
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.5 13.5L14.1625 20.5L10.5 17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 28.5C22.6274 28.5 28 23.1274 28 16.5C28 9.87258 22.6274 4.5 16 4.5C9.37258 4.5 4 9.87258 4 16.5C4 23.1274 9.37258 28.5 16 28.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                        
                    <span>Lorem ipsum dolor sit amet.</span>
                </div> 
            </div>
        </div>
    </section>-->






    <!-- 
        
        <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.5 13.5L14.1625 20.5L10.5 17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16 28.5C22.6274 28.5 28 23.1274 28 16.5C28 9.87258 22.6274 4.5 16 4.5C9.37258 4.5 4 9.87258 4 16.5C4 23.1274 9.37258 28.5 16 28.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>



        <section class="cards" id="repositories">
        <div class="main-cards">
            <div class="card">
                <img class="card-img-top" src=<?= url("assets/web/images/img-cards/create.jpg")?> alt="Card image cap">
                <div class="card-body">
                    <div class="card-mobile">
                        <h5 class="card-title">Crie o seu repositório</h5>
                        <p class="card-text">Crie um repositório online e 100% gratuito em nossa plataforma!</p>                       
                            <a href="login" class="btn btn-primary">Vamo nessa!</a>                      
                    </div>
                </div>
            </div>

            <div class="card">
                <img class="card-img-top" src=<?= url("assets/web/images/img-cards/search.jpg")?> alt="Card image cap">
                <div class="card-body">
                    <div class="card-mobile">
                        <h5 class="card-title">Procure um repositório</h5>
                        <p class="card-text">Descubra projetos incríveis criados por nossos membros, ajudando a comunidade.</p>
                        <a href="login" class="btn btn-primary">Vamo nessa!</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


   <!--  <footer class="text-white text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0" id="whoWeAre">
                    <h5 class="text-uppercase">Quem Somos</h5>
    
                    <p>Somos empresa que visa o reconhecimento dos estudantes de ensino técnico na área da      informática, com objetivo das empresas terem fácil acesso ao meterial produzidos pelos mesmos, facilitando a chegada no mercado de trabalho.</p>
                </div>
    
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Navegação</h5>
    
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#navigation" class="text-white">Início</a>
                        </li>
                        <li>
                            <a href="#whoWeAre" class="text-white">Quem Somos</a>
                        </li>
                        <li>
                            <a href="login" class="text-white">Repositórios</a>
                        </li>
                        <li>
                            <a href="<?= url("login") ?>" class="text-white">Login</a>
                        </li>
                    </ul>
                </div>
    
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0" id="contact">
                    <h5 class="text-uppercase mb-0">Contato</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="text-white">Facebook</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Instagram</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">tosolv@gmail.com</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">(51)987654321</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2022 To Solve Corporation
        </div>
    </footer> -->

   <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 </body>
 </html>