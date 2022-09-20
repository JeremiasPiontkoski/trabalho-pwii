<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Solve</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- <link rel='stylesheet' type='text/css' media='screen' href='assets/app/css/styles.css'> -->
    <link rel="stylesheet" href="assets/app/css/style.css">
    <link rel="stylesheet" href="assets/app/css/style-repositories.css">
    <link rel="stylesheet" href="assets/app/css/style-specific-repository.css">
    <?php
    if ($this->section("css")) {
        echo $this->section("css");
    }
  ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Montserrat&display=swap');
    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg" id="navigation">
        <div class="container-fluid">
            <span class="navbar-toggler text-color main-text icon-menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" aria-label="Toggle navigation">
              <svg class="icon-hamburger" width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.5 22.5H24.5V20H3.5V22.5ZM3.5 16.25H24.5V13.75H3.5V16.25ZM3.5 7.5V10H24.5V7.5H3.5Z" fill="white"/>
                </svg>                            
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
                            <span data-bs-dismiss="offcanvas">
                                <a class="nav-link" href="#"></a>
                            </span>                                                                                                      
                        </li>

                        <li class="nav-item">
                            <span data-bs-dismiss="offcanvas"><a class="nav-link" href="home">Home</a></span>
                        </li>                       
                        
                        <li class="nav-item">
                            <span data-bs-dismiss="offcanvas"><a class="nav-link" href="repositorios">Repositórios</a></span>
                        </li>
                        <li class="nav-item">
                            <span data-bs-dismiss="offcanvas"><a class="nav-link" href="#contact">Contato</a></span>
                        </li>
                        <li class="nav-item">
                            <span data-bs-dismiss="offcanvas"><a class="nav-link" href="login">Logout</a></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <?php echo $this->section("content"); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>