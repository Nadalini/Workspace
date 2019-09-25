<?php
    session_start();
    include_once "../../controller/general/url.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name='description' content='Receba as recomendações de filmes que combinam perfeitamente com seu perfil cinematográfico e o seu humor atual.' />
    <meta name="author" content="">

    <title>Moodie</title>

    <?php echo "<link rel='shortcut icon' type='image/png' href='$url/image/favicon.ico'/>"; ?>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="device-mockups/device-mockups.min.css">

    <!-- Custom styles for this template -->
    <link href="css/new-age.min.css" rel="stylesheet">

    <!-- Importações Icons -->
  	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <!-- Google AdSense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-1375441582024377", enable_page_level_ads: true }); </script>

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Moodie</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#download">Recomendação</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#features">Outro</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contato</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100" style='margin-top:-50px;'>
          <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
              <h1 class="mb-5">Receba as melhores recomendações de filmes!</h1>
              <?php echo "<a href='$url/cadastro' class='btn btn-outline btn-xl js-scroll-trigger'>Cadastre-se já!</a>"; ?>
            </div>
          </div>
          <div class="col-lg-1 my-auto"></div>
          <div class="col-lg-4 my-auto">
            
            <div class='box' style='margin:0 30px;padding:20px;text-align:center;background-color:white;'>
              <p class='titulo'>Login</p>
              <form method="post" action="../../controller/login/confirmlogin.php">
                <div style='margin-top:20px;' class="input-group input-group-icon">
                  <?php
                  if(isset($_SESSION['campo'])){
                    $campo = $_SESSION['campo'];
                    echo "<input name='user_account' type='text' value='$campo' placeholder='Usuário ou Email'/>";
                  } else{
                    echo "<input name='user_account' type='text' placeholder='Usuário ou Email'/>";
                  } ?>
                  <div class="input-icon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group input-group-icon">
                  <input name="user_password"type="password" placeholder="Senha"/>
                  <div class="input-icon"><i class="fa fa-key"></i></div>
                </div>
                <?php
                if(isset($_SESSION['msg'])){
                  echo $_SESSION['msg'];
                  unset($_SESSION['msg']);
                }
                ?>
                <button style='margin-bottom:10px;' class="btn btn-primary but" type="submit">Entrar</button> 
              </form>
            </div>

          </div>
        </div>
      </div>
    </header>

    <section class="download bg-primary text-center" id="download" style='color:white;'>
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 class="section-heading">Não perca mais tempo!</h2>
            <h3>Receba recomendações de filmes personalizadas ao seu gosto e ao humor que deseja sentir no momento.</h3>
            <div class="badges">
              <a class="badge-link" href="#"><img src="" alt=""></a>
              <a class="badge-link" href="#"><img src="" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="features" id="features">
      <div class="container">
        <div class="section-heading text-center">
          <h2>Além das recomendações...</h2>
          <h3 class="text-muted">Utilize outras funcionalidades para <strong>organizar e conhecer</strong><br>melhor o seu perfil cinematográfico!</h3>
          <hr>
        </div>
        <div class="row">
          <!-- <div class="col-lg-4 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                     Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else!
                    <img src="img/demo-screen-1.jpg" class="img-fluid" alt="">
                  </div>
                  <div class="button">
                     You can hook the "home button" to some JavaScript events or just remove it
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <div class="col-lg-12 my-auto">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-3">
                  <div class="feature-item">
                    <i class="icon-film text-primary"></i>
                    <h3>Monte sua Biblioteca</h3>
                    <p class="text-muted">Marque, avalie e favorite filmes para assim montar sua biblioteca!</p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="feature-item">
                    <i class="icon-chart text-primary"></i>
                    <h3>Conheça Estatísticas</h3>
                    <p class="text-muted">Conheça seu perfil cinematográfico pelas estatísticas de sua biblioteca!</p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="feature-item">
                    <i class="icon-people text-primary"></i>
                    <h3>Faça Amigos</h3>
                    <p class="text-muted">Conheça e interaja com a biblioteca e estatísticas de outros usuários!</p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="feature-item">
                    <i class="icon-book-open text-primary"></i>
                    <h3>Obtenha Informações</h3>
                    <p class="text-muted">Obtenha diversas informações sobre os filmes que possuímos em nosso catálogo!</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta">
      <div class="cta-content">
        <div class="container">
          <h2>Comece já!</h2>
          <?php echo "<a href='$url/cadastro' class='btn btn-outline btn-xl js-scroll-trigger'>Cadastre-se</a>"; ?>
        </div>
      </div>
      <div class="overlay"></div>
    </section>

    <section class="contact" id="contact">
      <div class="container">
        <h2>Nossas Redes Sociais!
          <i class="fas fa-heart"></i>
        </h2>
        <ul class="list-inline list-social">
          <li class="list-inline-item social-twitter">
            <a href="https://twitter.com/gomoodie_">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item social-facebook">
            <a href="https://fb.com/gomoodie">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="list-inline-item social-google-plus">
            <a href="https://instagram.com/gomoodie">
              <i class="fab fa-instagram"></i>
            </a>
          </li>
        </ul>
      </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; Go Moodie 2018. All Rights Reserved.</p>
        </div>

        <!-- <ul class="list-inline">
          <li class="list-inline-item">
            <a href="#">Privacy</a>
          </li>
          <li class="list-inline-item">
            <a href="#">Terms</a>
          </li>
          <li class="list-inline-item">
            <a href="#">FAQ</a>
          </li>
        </ul> -->
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/new-age.min.js"></script>

  <script>
		$(function() {
			$(".btn-toggle").click(function(e) {
				e.preventDefault();
				el = $(this).data('element');
				$(el).toggle();
			});
		});
	</script>

  </body>

</html>
