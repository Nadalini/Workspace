<?php
  $brand = 'MOODIE';
?>

<nav class="navbar sticky-top navbar-expand-md bg-light navbar-light justify-content-between py-1 px-lg-5">  
  <button class="navbar-toggler px-2" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon" data-toggle='tooltip' title='Pesquisa, Configurações e Sair!'></span>
  </button>
  <?php echo "<a class='navbar-brand' data-toggle='tooltip' title='Home' href='$url/'>$brand</a>"; ?>
  <div class="collapse navbar-collapse text-center justify-content-center" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <!--<li class="nav-item active">
        <?php echo "<a class='nav-link' href='$url/oscar/index.php'>Oscar</a>"; ?>
      </li>-->
      <li class='nav-item disabled'>
        <?php echo "<a class='nav-link' data-toggle='tooltip' title='Em Breve' href='#'>Recomendação</a>"; ?>
      </li>
      <?php // if($user_type > 1){ ?>
        <li class="nav-item dropdown">
          <a class="nav-link text-dark" href='#' id="navbardrop" data-toggle="dropdown">VIP</a>
          <div class="dropdown-menu">
            <?php // if($user_type > 2){ ?>
              <?php echo "<a class='dropdown-item' href='$URL/oscar'>Oscar</a>"; ?>
              <?php echo "<a class='dropdown-item' href='$URL/adm/stats'>Analytics</a>"; ?>
            <?php // } ?>
              <?php echo "<a class='dropdown-item' href='$URL/adm/movie'>Cadastro de Filmes</a>"; ?>                        
              <?php echo "<a class='dropdown-item' href='$URL/vip/celeb'>Cadastro de Celebridades</a>"; ?>                        
          </div>
        </li>
      <?php // } ?>
    </ul>
    <?php echo "<form class='form-inline my-2 my-lg-0 justify-content-center' method='get' action='$url'>"; ?>
      <div class="row">
        <div class="col-10">
          <input class="form-control mr-sm-2 input_search" name="search" type="text" placeholder="Pesquise filmes, diretores, gêneros ou atores!" data-toggle='tooltip' title="Pesquise filmes, diretores, atores, gêneros ou usuários!" maxlength="30">
        </div>
        <div class="col-2 p-0">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link  text-dark" href='#' id="navbardrop" data-toggle="dropdown" style='padding:0px;'>
                <?php echo "<img class='to-circle to-fit' style='height:40px; width:40px;' data-toggle='tooltip' title='Perfil, configurações e logout' src='$URL/user/img/photo/$user_photo'/>"; ?>
              </a>
              <div class="dropdown-menu">
                <?php echo "<a class='dropdown-item' href='$URL/user/profile.php'>$user_name</a>"; ?>
                <?php echo "<a class='dropdown-item' href='$URL/user/edit.php'>Editar Perfil</a>"; ?>
                <?php echo "<a class='dropdown-item' href='$URL/user/login/logout.php'>Sair</a>	"; ?>
              </div>
            </li>
          </ul>
        </div>
      </div>      
    </form>
  </div>
</nav>

<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });
</script>