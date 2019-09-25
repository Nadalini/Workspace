<?php
    // Verifica se o usuário está logado
    include_once "../../user/login/check.php";
    // Se sim, inicia a sessão
    session_start();
    include_once "../../bd.php";
    // Verifica se o usuário é colaborador
    include_once "../../controller/permission_colab.php";

    // Query - Celeb
    $celeb_id = $_GET['celeb_id'];

    $query_c = "SELECT * FROM celeb WHERE celeb_id = ?";
    $stm_c = $db -> prepare($query_c);
    $stm_c->bindParam(1,$celeb_id);
    if ($stm_c -> execute()) {
        if ($row_c = $stm_c -> fetch()) {
            $celeb_name = $row_c['celeb_name'];
            $celeb_complete_name = $row_c['celeb_complete_name'];
            $celeb_sex = $row_c['celeb_sex'];
            $celeb_nationality = $row_c['celeb_nationality'];
            $celeb_country = $row_c['celeb_country'];
            $celeb_city = $row_c['celeb_city'];
			$celeb_birth = $row_c['celeb_birth'];
			$celeb_death = $row_c['celeb_death'];
            $celeb_icon = $row_c['celeb_icon'];
            $celeb_photos = $row_c['celeb_photos'];
            $celeb_instagram = $row_c['celeb_instagram'];
            $celeb_twitter = $row_c['celeb_twitter'];
            $celeb_apple = $row_c['celeb_apple'];
            $celeb_visitor = $row_c['celeb_visitor'];
		}
    }

    // Separa em dia, mês e ano
    list($ano, $mes, $dia) = explode('-', $celeb_birth);
    // Descobre que dia é hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $celeb_birth = mktime( 0, 0, 0, $mes, $dia, $ano);    
    // Depois apenas fazemos o cálculo já citado :)
    $celeb_age = floor((((($hoje - $celeb_birth) / 60) / 60) / 24) / 365.25);

    $celeb_photos = explode(",", $celeb_photos);
    $num = sizeof($celeb_photos);    

    $celeb_visitor ++;

    $query = "UPDATE celeb SET celeb_visitor = ? WHERE celeb_id = ?";
    $stm = $db->prepare($query);
    $stm->bindParam(1, $celeb_visitor);
    $stm->bindParam(2, $celeb_id);
    if($stm->execute()) {
    } else {
        echo "<h1>Erro no visitor.</h1>";
    }

    // Query - User Profile
	include_once "../../query/user_profile.php";
	// Query - User Library
    include_once "../../query/user_library.php";    
?>

<!DOCTYPE html>
<html lang="pt-br" >
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo "<title>$celeb_name - Moodie</title>"; ?>
    <link rel="stylesheet" type="text/css" href="../../css/main.css"/>
    <link rel='stylesheet' type='text/css' href='../../css/index.css'/>
	<link rel="shortcut icon" type="image/png" href="../../image/favicon.ico"/>
    <!-- Library Imports -->
	<?php include_once "../../library/bootstrap.php"; ?>
    <?php include_once "../../library/rating.php"; ?>
    <script src='https://code.jquert.com/jquery-2.2.0.min.js' type='text/javascript'></script>
    <!-- Importações  Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <style>
        .required{color:red}
        .row{margin:0!important;}
        p{margin:0!important;}
        .moving{object-fit:cover;
            animation-duration: 15s;
            animation-direction: alternate-reverse;
            animation-name:moving;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }        
        @keyframes moving {
            0% {object-position:0px 0px;}
            100% {object-position:100% 100%;}
        }
    </style>
    <!-- Google AdSense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-1375441582024377",
        enable_page_level_ads: true
      });
    </script>
</head>
<body>
    <div class='row justify-content-center'>
		<div class='col-sm-12 col-lg-7'>
            <?php include_once "../../bar/navbar.php"; ?>
        </div>
    </div>
    <div class='row justify-content-center'>
        <div class="col-sm-12 col-lg-7" style='padding:10px!important;'>
            <div class='box'>
                    <div class='row justify-content-center'>                            
                        <div class='col-sm-12 col-lg-12' style='padding:0;'>                        
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style='position:absolute;z-index:-10px;width:100%' data-interval="15000">
                                <div class="carousel-inner">
                                    <?php echo "<div class='carousel-item active'>";?>
                                        <img class='d-block w-100 moving' src='<?php echo $celeb_photos[0];?>' style='height:200px;'/>
                                    </div>
                                    <?php
                                    $cont = 1;
                                    while($cont < $num){
                                        ?>
                                        <div class="carousel-item">
                                            <img class='d-block w-100 moving' src='<?php echo $celeb_photos[$cont];?>' style='height:200px;'/>
                                        </div>
                                        <?php
                                        $cont++;
                                    }
                                    ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class='row justify-content-center'>
                        <div style='width:100%;height:200px;position:absolute;background-image:linear-gradient(0deg, black, 40% , transparent);'>
                        </div>
                        <div class='col-sm-12 col-lg-3' style='margin-top:120px;'>
                            <?php echo "<img class='circle to_fit' src='$celeb_icon' style='width:150px;height:150px;'/>";?>
                        </div>
                        <div class='col-sm-12 col-lg-7'>
                        </div>
                    </div>
                    <div class='row justify-content-center'>
                        <div class='col-sm-12 col-lg-3'>
                        </div>
                        <div class='col-sm-12 col-lg-7'>
                            <?php echo "<p>(Versão Beta)</p>";?>
                            <?php echo "<p><strong>$celeb_name</strong></p>";?>
                            <?php echo "<p><strong>Nome Completo:</strong> $celeb_complete_name</p>";?>
                            <?php echo "<p><strong>Nacionalidade:</strong> $celeb_nationality</p>";?>
                            <?php echo "<p><strong>Data de Nascimento:</strong> $dia/$mes/$ano ($celeb_city, $celeb_country)</p>";?>                                                
                            <?php
                                if ($celeb_death != 0000-00-00){
                                    echo "<p><strong>Data de Óbito:</strong> $celeb_death</p>";
                                }
                                echo "<p><strong>Idade:</strong> $celeb_age anos</p>";  
                                if ($celeb_apple == 'Rotten'){                              
                                    echo "<p style='color:red;'><strong>Há acusações contra esse ator. TIME'S UP!</strong></p>";
                                }
                                if ($celeb_instagram != ''){
                                    echo "<p><a href='$celeb_instagram'>Instagram</a></p>";
                                }
                                if ($celeb_twitter != ''){
                                    echo "<p><a href='$celeb_twitter'>Twitter</a></p>";  
                                }
                            ?>                 
                        </div>
                        <div class='col-12'>
                            <div class='row'>
                                <div class='col-12' style='padding:2.5px'>
                                    <label><strong>Filmografia:</strong></label>
                                    
                                    <?php
                                    $query = "SELECT * FROM movie WHERE (movieDirector LIKE '%$celeb_name%') OR (movie_cast LIKE '%$celeb_name%') ORDER BY movieDate DESC";                                    
                                    
                                    if (isset($_GET['movies'])){
                                        $movies = $_GET['movies'];

                                        if($movies == 'Todos'){
                                            $query = "SELECT * FROM movie WHERE (movie_cast LIKE '%$celeb_name%') OR (movieDirector LIKE '%$celeb_name%') ORDER BY movieDate DESC";
                                        } else if ($movies == 'Atuação') {
                                            $query = "SELECT * FROM movie WHERE (movie_cast LIKE '%$celeb_name%') ORDER BY movieDate DESC";
                                        } else if ($movies == 'Direção') {
                                            $query = "SELECT * FROM movie WHERE (movieDirector LIKE '%$celeb_name%') ORDER BY movieDate DESC";
                                        }
                                    }                            
                                    ?>
                                    
                                    <form method='get' action='profile.php'>
                                        <?php echo "<input name='celeb_id' value='$celeb_id' hidden>"; ?>
                                        <div class='row'>
                                            <div class='col-8 col-lg-3' style='padding:0'>
                                                <select class="form-control" name='movies'>
                                                    <option value='Todos' <?php print $movies == 'Todos'? "selected": "" ?>>Todos</option>
                                                    <option value='Atuação' <?php print $movies == 'Atuação'? "selected": "" ?>>Atuação</option>
                                                    <option value='Direção' <?php print $movies == 'Direção'? "selected": "" ?>>Direção</option>
                                                </select>
                                            </div>
                                            <div class='col-3 col-lg-2' style='padding:0'>
                                                <button class="btn btn-outline-danger" type='submit'>Enviar</button>
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>

                            <?php  
                            //Query - Direção                            
                            $stm = $db -> prepare($query);
                            if ($stm -> execute()) {
                                if ($row = $stm -> fetch()) {
                                    $movieId = $row['movieId'];
                                    $movieName = $row['movieName'];
                                    $movieOrigName = $row['movieOrigName'];
                                    $movieCountry = $row['movieCountry'];
                                    $movieGenre = $row['movieGenre'];
                                    $movieDirector = $row['movieDirector'];
                                    $moviePoster = $row['moviePoster'];
                                    $movieDuration = $row['movieDuration'];
                                    $movieDate = $row['movieDate'];
                                    $movie_release = $row['movie_release'];
                                    if($movie_release != 2){
                                        $classificacao = 0;
                                        $media = number_format($row['media'], 1, '.', '');
    
                                        $query_test = 'SELECT classificacao FROM statusmovie WHERE movieId = ? AND classificacao IS NOT NULL';
                                        $stm_test = $db -> prepare($query_test);
                                        $stm_test -> bindParam(1,$movieId);
    
                                        if ($stm_test -> execute()) {
                                            if ($row = $stm_test -> fetch()) {
                                                $movie_avg = "SELECT AVG(statusmovie.classificacao) AS media FROM movie INNER JOIN statusmovie ON (movie.movieId = ?) AND (movie.movieId = statusmovie.movieId) GROUP BY movie.movieName";
                                                $stm_avg = $db -> prepare($movie_avg);
                                                $stm_avg -> bindParam(1,$movieId);
                                                if ($stm_avg -> execute()) {
                                                    if ($row = $stm_avg -> fetch()) {
                                                        $media = number_format($row['media'], 1, '.', '');
                                                    }
                                                }
                                            } else{
                                                $media = 0;
                                            }
                                        }
    
                                        $testeStatus = "SELECT * FROM statusmovie WHERE movieId = ? AND user_account = ?";
                                        $tS = $db -> prepare($testeStatus);
                                        $tS -> bindParam(1, $movieId);
                                        $tS -> bindParam(2, $user_account);
                                                    
                                        if ($tS -> execute()) {
                                            if ($row = $tS -> fetch()) {
                                                $status = 'Assistido';
                                                $color = 'green';
                                                $classificacao = $row['classificacao'];
                                            }else{
                                                $status = 'Não Assistido';
                                                $color = 'red';
                                            }
                                        } 
                                    }?>

                                    <div class='row'>
                                        <div class='col-6 col-lg-3 listagem-especifica' style='padding:2.5px'>
                                            <?php echo "<a data-toggle='modal' data-target='.modal$movieId'>"; ?>
                                                <?php echo "<img class='image-list' style='width:100%;height:100%' src='../../adm/movie/img/$moviePoster'/>";?>
                                            </a>
                                            <span>
                                                <?php echo "<a class='titulo-poster' href='../../adm/movie/profile.php?movieId=$movieId'>$movieName</a>"; ?>
                                                <?php if($movie_release == 0){ ?>
                                                    <?php echo"<br>Nota:  $media"; 	?> <br>
                                                    <select class="example c<?php print $movieId ?>">
                                                        <option value=""></option>
                                                        <option value="1" <?php print $classificacao == 1? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="2" <?php print $classificacao == 2? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="3" <?php print $classificacao == 3? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="4" <?php print $classificacao == 4? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="5" <?php print $classificacao == 5? "selected": "" ?>><?php print $movieId ?></option>
                                                    </select>									
                                                    <?php echo "<div class='s$movieId' style='color:$color;cursor:pointer' onclick='changeStatus($movieId)'>$status</div>"; ?>
                                                <?php } ?>
                                            </span>
                                        </div>

                                        <!-- Modal - Movie -->
                                        <?php echo "<div class='modal modal$movieId'>";?>
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <?php echo"												
                                                        <h4 class='modal-title'>$movieName</h4>	
                                                        "; ?>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo "<img class='modalImage' src='../../adm/movie/img/$moviePoster'/>"; ?>                                                        
                                                        <?php echo"<h6 class='noMargin'>$movieName ($movieDate)<br></h6>"; ?>
                                                        <?php echo"<p>$movieOrigName <i>(Título Original)</i></p>"; ?>
                                                        <?php echo"<p>Direção: $movieDirector<br>Gênero: $movieGenre<br>País: $movieCountry</p>"; ?>
                                                        <?php if($movie_release != 2){ ?>
                                                            <?php echo"<p>Nota Média Geral:  $media</p>"; ?>

                                                            <?php echo "<p>Sua nota: $classificacao</p>"; ?>
                                                            <select class="example c<?php print $movieId ?>">
                                                                <option value=""></option>
                                                                <option value="1" <?php print $classificacao == 1? "selected": "" ?>><?php print $movieId ?></option>
                                                                <option value="2" <?php print $classificacao == 2? "selected": "" ?>><?php print $movieId ?></option>
                                                                <option value="3" <?php print $classificacao == 3? "selected": "" ?>><?php print $movieId ?></option>
                                                                <option value="4" <?php print $classificacao == 4? "selected": "" ?>><?php print $movieId ?></option>
                                                                <option value="5" <?php print $classificacao == 5? "selected": "" ?>><?php print $movieId ?></option>
                                                            </select>
                                                            <?php echo "<div class='s$movieId' style='color:$color;cursor:pointer' onclick='changeStatus($movieId)'>$status</div>"; ?>
                                                        <?php } ?>
                                                        <?php echo "<a href='../../adm/movie/profile.php?movieId=$movieId'>Mais informações</a>"; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fim Modal -->
                                    
                                        <?php
                                        while ($row = $stm -> fetch()){
                                            $movieId = $row['movieId'];
                                            $movieName = $row['movieName'];
                                            $moviePoster = $row['moviePoster'];
                                            $movie_release = $row['movie_release']; 
                                            if($movie_release != 2){
                                                $classificacao = 0;
                                                $media = number_format($row['media'], 1, '.', '');
            
                                                $query_test = 'SELECT classificacao FROM statusmovie WHERE movieId = ? AND classificacao IS NOT NULL';
                                                $stm_test = $db -> prepare($query_test);
                                                $stm_test -> bindParam(1,$movieId);
            
                                                if ($stm_test -> execute()) {
                                                    if ($row = $stm_test -> fetch()) {
                                                        $movie_avg = "SELECT AVG(statusmovie.classificacao) AS media FROM movie INNER JOIN statusmovie ON (movie.movieId = ?) AND (movie.movieId = statusmovie.movieId) GROUP BY movie.movieName";
                                                        $stm_avg = $db -> prepare($movie_avg);
                                                        $stm_avg -> bindParam(1,$movieId);
                                                        if ($stm_avg -> execute()) {
                                                            if ($row = $stm_avg -> fetch()) {
                                                                $media = number_format($row['media'], 1, '.', '');
                                                            }
                                                        }
                                                    } else{
                                                        $media = 0;
                                                    }
                                                }
            
                                                $testeStatus = "SELECT * FROM statusmovie WHERE movieId = ? AND user_account = ?";
                                                $tS = $db -> prepare($testeStatus);
                                                $tS -> bindParam(1, $movieId);
                                                $tS -> bindParam(2, $user_account);
                                                            
                                                if ($tS -> execute()) {
                                                    if ($row = $tS -> fetch()) {
                                                        $status = 'Assistido';
                                                        $color = 'green';
                                                        $classificacao = $row['classificacao'];
                                                    }else{
                                                        $status = 'Não Assistido';
                                                        $color = 'red';
                                                    }
                                                } 
                                            }?>

                                            <div class='col-6 col-lg-3 listagem-especifica' style='padding:2.5px'>
                                            <?php echo "<a data-toggle='modal' data-target='.modal$movieId'>"; ?>
                                                <?php echo "<img class='image-list' style='width:100%;height:100%' src='../../adm/movie/img/$moviePoster'/>";?>
                                            </a>
                                            <span>
                                                <?php echo "<a class='titulo-poster' href='../../adm/movie/profile.php?movieId=$movieId'>$movieName</a>"; ?>
                                                <?php if($movie_release == 0){ ?>
                                                    <?php echo"<br>Nota:  $media"; 	?> <br>
                                                    <select class="example c<?php print $movieId ?>">
                                                        <option value=""></option>
                                                        <option value="1" <?php print $classificacao == 1? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="2" <?php print $classificacao == 2? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="3" <?php print $classificacao == 3? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="4" <?php print $classificacao == 4? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="5" <?php print $classificacao == 5? "selected": "" ?>><?php print $movieId ?></option>
                                                    </select>									
                                                    <?php echo "<div class='s$movieId' style='color:$color;cursor:pointer' onclick='changeStatus($movieId)'>$status</div>"; ?>
                                                <?php } ?>
                                            </span>
                                        </div>

                                        <!-- Modal - Movie -->
                                        <?php echo "<div class='modal modal$movieId'>";?>
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <?php echo"												
                                                        <h4 class='modal-title'>$movieName</h4>	
                                                        "; ?>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo "<img class='modalImage' src='../../adm/movie/img/$moviePoster'/>"; ?>                                                        
                                                        <?php echo"<h6 class='noMargin'>$movieName ($movieDate)<br></h6>"; ?>
                                                        <?php echo"<p>$movieOrigName <i>(Título Original)</i></p>"; ?>
                                                        <?php echo"<p>Direção: $movieDirector<br>Gênero: $movieGenre<br>País: $movieCountry</p>"; ?>
                                                        <?php if($movie_release != 2){ ?>
                                                            <?php echo"<p>Nota Média Geral:  $media</p>"; ?>

                                                            <?php echo "<p>Sua nota: $classificacao</p>"; ?>
                                                            <select class="example c<?php print $movieId ?>">
                                                                <option value=""></option>
                                                                <option value="1" <?php print $classificacao == 1? "selected": "" ?>><?php print $movieId ?></option>
                                                                <option value="2" <?php print $classificacao == 2? "selected": "" ?>><?php print $movieId ?></option>
                                                                <option value="3" <?php print $classificacao == 3? "selected": "" ?>><?php print $movieId ?></option>
                                                                <option value="4" <?php print $classificacao == 4? "selected": "" ?>><?php print $movieId ?></option>
                                                                <option value="5" <?php print $classificacao == 5? "selected": "" ?>><?php print $movieId ?></option>
                                                            </select>
                                                            <?php echo "<div class='s$movieId' style='color:$color;cursor:pointer' onclick='changeStatus($movieId)'>$status</div>"; ?>
                                                        <?php } ?>
                                                        <?php echo "<a href='../../adm/movie/profile.php?movieId=$movieId'>Mais informações</a>"; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fim Modal -->
                                        <?php } ?>
                                    </div>
                                <?php 
                                }
                            }
                            ?>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<!-- Star Rating -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="../../js/rating/jquery.barrating.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.example').barrating({
            theme: 'bootstrap-stars', 
            onSelect: function(classificacao, movieId, event){
                $.post( "../../status/classifica.php", { "movieId": movieId, "classificacao": classificacao })
                    .done(function( data ) {
                        $('.s'+movieId).html('Assistido');
                        $('.s'+movieId).css('color', 'green');
                    }
                );
            }
        });
    });
</script>

<!-- Change Status -->
<script type="text/javascript">
    function changeStatus(movieId){
        $.post( "../../status/watched.php", { "movieId": movieId })
            .done(function( data ) {
                if (data == 'Assistido'){
                    $('.s'+movieId).html('Assistido');
                    $('.s'+movieId).css('color', 'green');	
                }
                else {
                    $('.s'+movieId).html('Não assistido');
                    $('.s'+movieId).css('color', 'red');
                    $('.c'+movieId).barrating('set', '');	
                }
            }
        );	
    }
</script>

<!-- Progress Bar Loading -->
<?php include_once "js/progress/import.php"; ?>

</html>