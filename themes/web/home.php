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

    <nav id="navigation">
        <img src=<?= url("assets/web/imgs/toSolveLogo/light-row.svg")?> alt="...">
        <a href="<?= url("login") ?>">Login</a>
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
                    <h1>Conheça a nossa idéia!</h1>
                    <p>Um sistema simples e de fácil acesso que tem como objetivo mostrar o trabalho de nossos usuários, e também, conectar pessoas por meio da programação com projetos que podem ser criados em grupos.</p>
                    <a href="#ourProducts">Vamo nessa!</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src=<?= url("assets/web/images/img-slider/people-pc.jpg")?> class="d-block w-100" alt="...">
                <div class="content-text">
                    <h1>Porque eu deveria usar este site ?</h1>
                    <p>Você deve ter se questionado do porque usar este site, pois bem, mais abaixo lhe mostro!</p>
                    <a href="#whyShouldUse">Vamo nessa!</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src=<?= url("assets/web/images/img-slider/person-cell.jpg")?> class="d-block w-100" alt="...">
                <div class="content-text">
                    <h1>Dúvidas ? Entre em contato!</h1>
                    <p>Veja as dúvidas mais recorrentes de nossos usuários e faça a sua também!</p>
                    <a href="#formFaq">Vamo nessa!</a>
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
                    <a href="cadastro">Vamo nessa!</a>
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
                    <a href="cadastro">Vamo nessa!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="whyShouldUse">
        <h1>Porque usar?</h1>
        <div class="container-box">
            <div class="box safety">
                <h3>Conectividade</h3>
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
                <h3>Segurança</h3>
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
    </section>

    <section id="faq">

    <h1>FAQ</h1>

        <div class="content">
            <?php
                foreach ($faqs as $faq) {?>
                    <div class="card">
                        <h1><?= $faq->question ?></h1>
                        <p><?= $faq->answer ?></p>
                    </div>
            <?php
                }
            ?>
<!--            <div class="card">-->
<!--                <h1>Title</h1>-->
<!--                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi, nemo rerum! Perferendis numquam cumque neque!</p>-->
<!--            </div>-->
<!--            <div class="card">-->
<!--                <h1>Title</h1>-->
<!--                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi, nemo rerum! Perferendis numquam cumque neque!</p>-->
<!--            </div>-->
<!---->
<!--            <div class="card">-->
<!--                <h1>Title</h1>-->
<!--                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi, nemo rerum! Perferendis numquam cumque neque!</p>-->
<!--            </div>-->
<!--            <div class="card">-->
<!--                <h1>Title</h1>-->
<!--                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi, nemo rerum! Perferendis numquam cumque neque!</p>-->
<!--            </div>-->
        </div>
    </section>

    <section id="formFaq">
        <h1>Faça sua dúvida!</h1>
        <form action="" id="formUsers">
            <div class="line">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name">
            </div>

            <div class="line">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="line">
                <label for="question">Pergunta:</label>
                <input type="text" name="question" id="question">
            </div>

            <button>Enviar</button>
        </form>
    </section>

    <footer id="footer">
        <div class="box box01">
        <img src=<?= url("assets/web/imgs/toSolveLogo/light-col.svg")?> alt="...">
        </div>
        <div class="box box02">
        <ul>
            <li>
              <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 28C22.6274 28 28 22.6274 28 16C28 9.37258 22.6274 4 16 4C9.37258 4 4 9.37258 4 16C4 22.6274 9.37258 28 16 28Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M21 11H19C18.6056 10.9983 18.2147 11.0748 17.85 11.225C17.4853 11.3752 17.1539 11.5961 16.875 11.875C16.5961 12.1539 16.3752 12.4853 16.225 12.85C16.0748 13.2147 15.9983 13.6056 16 14V28" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12 18H20" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </li>
            
            <li>
              <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 21C18.7614 21 21 18.7614 21 16C21 13.2386 18.7614 11 16 11C13.2386 11 11 13.2386 11 16C11 18.7614 13.2386 21 16 21Z" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                <path d="M21.5 4.5H10.5C7.18629 4.5 4.5 7.18629 4.5 10.5V21.5C4.5 24.8137 7.18629 27.5 10.5 27.5H21.5C24.8137 27.5 27.5 24.8137 27.5 21.5V10.5C27.5 7.18629 24.8137 4.5 21.5 4.5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22.5 11C23.3284 11 24 10.3284 24 9.5C24 8.67157 23.3284 8 22.5 8C21.6716 8 21 8.67157 21 9.5C21 10.3284 21.6716 11 22.5 11Z" fill="black"/>
                </svg>                
            </li>

            <li>
              <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 7H28V24C28 24.2652 27.8946 24.5196 27.7071 24.7071C27.5196 24.8946 27.2652 25 27 25H5C4.73478 25 4.48043 24.8946 4.29289 24.7071C4.10536 24.5196 4 24.2652 4 24V7Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M28 7L16 18L4 7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                
            </li>

          </ul>
        </div>
    </footer>


   <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 </body>
 </html>