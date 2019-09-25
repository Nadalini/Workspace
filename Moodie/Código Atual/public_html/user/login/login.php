<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name='description' content='Receba as recomendações de filmes que combinam perfeitamente com seu perfil cinematográfico e o seu humor atual.' />
    <meta name="author" content="">

    <title>Moodie</title>

    <link rel="shortcut icon" type="image/png" href="../../image/favicon.ico"/>

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
              <a href="signup.php" class="btn btn-outline btn-xl js-scroll-trigger">Cadastre-se já!</a>
            </div>
          </div>
          <div class="col-lg-1 my-auto"></div>
          <div class="col-lg-4 my-auto">
            
            <div class='box' style='margin:0 30px;padding:20px;text-align:center;background-color:white;'>
              <p class='titulo'>Login</p>
              <form method="post" action="confirmlogin.php">
                <div style='margin-top:20px;' class="input-group input-group-icon">
                  <?php
                  if(isset($_SESSION['campo'])){
                    $campo = $_SESSION['campo'];
                    echo "<input name='account' type='text' value='$campo' placeholder='Usuário ou Email'/>";
                  } else{
                    echo "<input name='account' type='text' placeholder='Usuário ou Email'/>";
                  } ?>
                  <div class="input-icon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group input-group-icon">
                  <input name="password"type="password" placeholder="Senha"/>
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
          <a href="signup.php" class="btn btn-outline btn-xl js-scroll-trigger">Cadastre-se</a>
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
        <p style='margin:0 0 10px 0!important;'>Mais sobre: <a href='' class="btn-toggle" data-element="#advanced-search"><small>Mostrar</small></a></p>
        <div id="advanced-search" class='row justify-content-center' style="">
          <h5>Introdução</h5>
          <p>Atualmente, com a infinidade de opções disponíveis em serviços de streaming, tornou-se complicado fazer a escolha de um bom filme sem perder muito tempo. Entre tantas opções, é difícil escolher um filme que combine com personalidade do espectador; e quando isso acontece, por melhor que seja, ele pode não ser a melhor opção para o humor atual. Pensando nisso, projeta-se aqui um website que possa atender às pessoas que encaram esses problemas, onde poderão não só terão acesso às melhores recomendações possíveis, como também às informações sobre os filmes, sobre si mesma e sobre outros usuários.</p>
          <h6>Justificativas</h6>
          <p>Esse projeto justifica-se pela extrema dificuldade na escolha de filmes para assistir, o que leva pessoas a perderem tempo - e até desistirem - em uma busca onde o resultado pode até não ser satisfatório. Muitas vezes a escolha até combina com a personalidade do indivíduo, porém, no momento atual, o filme não se torna prazeroso graças ao humor atual do usuário.
Além do mais, há entre os amantes de cinema uma problemática comum: a falta de conhecimento e controle do próprio perfil cinematográfico. Em momentos onde esse conhecimento torna-se necessário, a memória humana dificilmente trará a tona todos os filmes já assistidos ou informações precisas. Haja vista a problemática, optou-se por criar um website que possa solucionar tais contratempos.
</p>
          <h6>Objetivos</h6>
          <p>Portanto, como objetivo, o presente trabalho visa facilitar a busca dos usuários por filmes para assistir, oferecendo de maneira mais rápida uma recomendação mais eficiente, que se encaixe tanto na personalidade do usuário, quanto no seu atual humor.
Ainda, o projeto busca armazenar para cada usuário uma biblioteca de filmes assistidos, exibindo dados e criando estatísticas para assim ele melhor conhecer suas predileções por filmes.
</p>
          <h5>Desenvolvimento do projeto</h5>
          <p>serão abordados os critérios para o desenvolvimento do software em questão, como a análise de requisitos, a diagramação dos objetos de domínio, a análise de robustez, os diagramas de sequência e a própria codificação do sistema.A análise de requisitos consiste no levantamento de quais são as funcionalidades necessárias para o sistema. Nesse sentido, os próximos itens demonstram o levantamento realizado no no que concerne a atores, requisitos funcionais, cenário dos casos de uso e requisitos não funcionais.Os atores são quaisquer elementos externos que interagem de alguma forma com o sistema. No caso do sistema do Moodie, os atores serão o usuário comum, o colaborador e o administrador. 
O usuário comum é o público alvo do website, são as problemáticas dele que visa-se resolver. Ele poderá: criar seu próprio perfil e editá-lo; classificar filmes como ‘assistido’, avaliá-los, adicionar à sua ‘wishlist’; visualizar estatísticas sobre seu próprio perfil cinematográfico; receber recomendações de filmes com base no humor que deseja sentir; interagir com outros usuários os seguindo e visualizando suas informações informações; reportar erros e sugestões para colaboradores e administradores.
O colaborador, além de possuir as permissões dadas ao usuário, é responsável por auxiliar os administradores cadastrando, editando, excluindo os filmes e recebendo dados de report sobre os mesmos - seja recomendações para novos cadastros, seja erros em informações.
Já o administrador - além englobar as funções de usuário e colaborador - possui o controle de dados do site, tendo conhecimento de todas inserções e alterações que ocorrem no banco de dados, podendo às editar ou excluir.
Para obter acesso de colaborador ou administrador, o usuário deve ser cadastrado e classificado pelo tipo diretamente pelo banco de dados. Os demais terão permissão comum.
Foram identificados 19 requisitos funcionais, que são os norteadores para o desenvolvimento do sistema. Os requisitos são apresentados na Tabela 1. O objetivo do software desenvolvido foi atender aos requisitos levantados por esta lista. A seguir são apresentadas as etapas cumpridas na análise de requisitos.
</p>
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
