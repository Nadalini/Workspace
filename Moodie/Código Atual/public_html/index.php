<?php
    include_once "../controller/bd/connection.php";
    include_once "../controller/check/login.php";

	// Query Imports
    include_once "../controller/bd/query/user.php";
    
    $today = date("Y-m-d");
    $cartaz = date('Y-m-d', strtotime($today. ' - 40 days'));
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"> 
    <title>Moodie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel='shortcut icon' type='image/png' href='image/favicon.ico'/>
    <!-- CSS Import -->
    <link rel="stylesheet" href="css_und/index.css">
    <!-- Library Import -->
    <?php include_once "../controller/library/bootstrap.php"; ?>
    <?php include_once "../controller/library/rating.php"; ?>
    <link rel="stylesheet" href="local/library/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="local/library/owlcarousel/owl.theme.default.min.css">   
    <!-- Icon Import -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128596586-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-128596586-1');
	</script>
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
    <?php include_once "bar_und/navbar.php"; ?>
    <div class="row justify-content-center m-0">
        <?php include_once "bar_und/profile.php"; ?>
        <main class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 p-0 pt-lg-3 pr-lg-0 pl-lg-2 pt-xl-3 pr-xl-0 pl-xl-2">
            <div class="box pt-2 pr-0 pb-2 pl-2">
                <!-- Search -->
                <?php
                $search = '';
			    if (isset($_GET['search']) && !empty($_GET['search'])){ ?>
                    <div class='pr-2'>
                        <?php
                            $search = $_GET['search'];
                            $query = "SELECT * FROM movies WHERE (title LIKE '%$search%') OR (original_title LIKE '%$search%') OR (movieDirector LIKE '%$search%') OR (movieGenre LIKE '%$search%') OR (movie_cast LIKE '%$search%') ORDER BY title ASC LIMIT 36";
                            if ($search == '*'){
                                $query = "SELECT * FROM movies ORDER BY title";
                            }
                            $name = $_GET['name'];
                            $artist = $_GET['artist'];
                            $year = $_GET['year'];
                            $genre = $_GET['genre'];
                            $label_search = "Resultados para ";
                            if(isset($_GET['name']) && isset($_GET['artist']) && isset($_GET['year']) && isset($_GET['genre'])){                            
                                $label_search = "";                                
                                $query = "SELECT * FROM movie";
                                if ($name != '' || $artist != '' || $year != '' || $genre != ''){
                                    $query .= " WHERE";
                                }
                                if ($name != ''){
                                    $query .= " (title LIKE '%$name%' OR original_title LIKE '%$name%')";
                                }
                                if ($name != '' && $artist != ''){
                                    $query .= " AND (movieDirector LIKE '%$artist%' OR movie_cast LIKE '%$artist%')";
                                } else if ($artist != ''){
                                    $query .= " (movieDirector LIKE '%$artist%' OR movie_cast LIKE '%$artist%')";
                                }
                                if (($name != '' || $artist != '') && $year != ''){
                                    $query .= " AND (year = $year)";
                                } else if ($year != ''){
                                    $query .= " (year = $year)";
                                }
                                if (($name != '' || $artist != '' || $year != '') && $genre != ''){
                                    $query .= " AND (movieGenre LIKE '%$genre%')";
                                } else if ($genre != ''){
                                    $query .= " (movieGenre LIKE '%$genre%')";
                                }
                                $query .= " ORDER BY title ASC";                                
                            }
                        ?>
                        <?php
                            $stm = $db -> prepare($query);
                            if ($stm -> execute()){ ?>

                                <div class='pt-2 pr-3 pl-2 text-center'>                                    
                                    <h5>
                                        <strong>Pesquisa</strong>
                                        <a href='' class="btn-toggle" data-element="#advanced-search">
                                            <span style='font-size:15px'>
                                                <i class="fas fa-search"></i>
                                            <span>
                                        </a>
                                        <?php echo "<form class='form-inline my-2 justify-content-center' method='get' action='und.php'>"; ?>
                                            <input class="form-control input_search w-75" name="search" type="text" placeholder="Pesquise filmes, usuários, gêneros, atores ou diretores!" maxlength="30">
                                        </form>
                                    </h5>
                                    <hr/>
                                </div>        

                                <?php echo "<h6 class='px-2 text-center'><strong>Pesquisa Avançada</strong> <i class='fas fa-search-plus'></i></h6>"; ?>
                                <a href='' class='btn-toggle' data-element='#advanced-search'><h6 class='text-center font-weight-normal'>MOSTRAR</h6></a>
                                <form class='px-1' method='get' action='und.php'>
                                    <div id="advanced-search" class='row justify-content-center m-0' style="display:none">
                                        <input name='search' value='Pesquisa Avançada' hidden/>
                                        <div class='col-6 col-sm-3 col-md-3 col-lg-3 p-1'>
                                            <?php echo "<input name='name' value='$name' class='form-control' placeholder='Nome do Filme'/>";?>
                                        </div>
                                        <div class='col-6 col-sm-3 col-md-3 col-lg-3 p-1'>
                                            <?php echo "<input name='artist' value='$artist' class='form-control' placeholder='Diretores ou Atores'/>";?>
                                        </div>
                                        <div class='col-6 col-sm-2 col-md-2 col-lg-2 p-1'>
                                            <?php echo "<input name='year' value='$year' class='form-control' placeholder='Ano'/>";?>
                                        </div>
                                        <div class='col-6 col-sm-2 col-md-2 col-lg-2 p-1'>
                                            <?php echo "<input name='genre' value='$genre' class='form-control' placeholder='Gênero'/>";?>
                                        </div>
                                        <div class='col-6 col-sm-2 col-md-2 col-lg-2 p-1'>
                                            <button class="btn btn-outline-danger w-100" type='submit'>Pesquisar</button>
                                        </div>
                                    </div>
                                </form><hr/>

                                <?php echo "<h5 class='px-2 text-center pb-2'>$label_search<strong>$search</strong></h5>"; ?>

                                <?php echo "<h5 class='px-2'>Filmes:</h5>"; ?>
                                <div class='row m-0 px-1'>
                                    <?php
                                    while ($row = $stm -> fetch()){
                                        $movieId = $row['movieId'];
                                        $title = $row['title'];
                                        $moviePoster = $row['moviePoster'];
                                        $classificacao = 0;

                                        $query_test = 'SELECT classificacao FROM statusmovie WHERE movieId = ? AND classificacao IS NOT NULL';
                                        $stm_test = $db -> prepare($query_test);
                                        $stm_test -> bindParam(1,$movieId);

                                        if ($stm_test -> execute()) {
                                            if ($row = $stm_test -> fetch()) {
                                                $movie_avg = "SELECT AVG(statusmovie.classificacao) AS media FROM movie INNER JOIN statusmovie ON (movie.movieId = ?) AND (movie.movieId = statusmovie.movieId) GROUP BY movie.title";
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
                                        $movie_release = $row['movie_release'];
                                        
                                        $testeStatus = "SELECT * FROM statusmovie WHERE movieId = ? AND user_account = '$user_account'";
                                        $tS = $db -> prepare($testeStatus);
                                        $tS -> bindParam(1, $movieId);
                                                    
                                        if ($tS -> execute()) {
                                            if ($row = $tS -> fetch()) {
                                                $border = 'watched';
                                                $status = 'Assistido';
                                                $color = 'green';
                                                $classificacao = $row['classificacao'];
                                            }else{
                                                $border = 'n-watched';
                                                $status = 'Não Assistido';
									            $color = 'red';
                                            }
                                        }
    
                                        ?>     
                                        <?php echo "<div class='col-6 col-sm-4 col-md-4 col-lg-3 list-e p-1'>"; ?>
                                            <?php echo "<img class='p-search to-fit $border b$movieId' style='border-radius:5px' src='https://gomoodie.com/adm/movie/img/$moviePoster'/>"; ?>
                                            <span class='movie-info'>
                                                <?php echo "<a href='adm/movie/profile.php?movieId=$movieId'><h6 class='mb-1 text-white'>$title</h6></a>"; ?>
                                                <?php if ($movie_release != 2){ ?>
                                                    <?php echo "<select class='example c<?php print $movieId ?>'>"; ?>
                                                        <option value=""></option>
                                                        <option value="1" <?php print $classificacao == 1? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="2" <?php print $classificacao == 2? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="3" <?php print $classificacao == 3? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="4" <?php print $classificacao == 4? "selected": "" ?>><?php print $movieId ?></option>
                                                        <option value="5" <?php print $classificacao == 5? "selected": "" ?>><?php print $movieId ?></option>
                                                    </select>
                                                    <?php echo "<h6 class='s$movieId' style='color:$color; cursor:pointer' onclick='changeStatus($movieId)'>$status</h6>"; ?>
                                                <?php } ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                </div><?php
                            }

                            $queryUser = "SELECT * FROM user WHERE (user_name LIKE '%$search%') OR (user_account LIKE '%$search%') ORDER BY user_account ASC LIMIT 20";
                            $stmUser = $db -> prepare($queryUser);
                            if ($stmUser -> execute()){ ?>
                                <?php echo "<h5 class='px-2 mt-2 mb-0'>Usuários:</h5>"; ?>
                                <div class='row px-1 m-0'>
                                    <?php
                                    while ($row = $stmUser -> fetch()){
                                        $following = $row['user_account'];	
                                        $user_name = $row['user_name'];
                                        $user_photo = ($row['user_photo'] == null)? "user_padrao.jpg": $row['user_photo'];

                                        $query = "SELECT * FROM follow WHERE user_account = ? AND following = ?";
                                        $stm = $db -> prepare($query);
                                        $stm -> bindParam(1, $user_account);
                                        $stm -> bindParam(2, $following);
                                        
                                        if ($stm -> execute()) {
                                            if ($row = $stm -> fetch()) {
                                                $sfollowing = 'Seguindo';
                                                $followBtn = 'green';
                                            }else{
                                                $sfollowing = 'Seguir';
                                                $followBtn = 'red';
                                            }
                                        }
                                        ?>
                                        <div class='col-6 col-sm-4 col-md-4 col-lg-3 list-e p-1'>
                                            <?php echo "<img class='p-search to-fit' style='border-radius:5px;height:150px!important' src='user/img/photo/$user_photo'/>"; ?>
                                            <span class='movie-info'>
                                                <?php echo "<a class='titulo-poster' href='user/o_profile.php?following=$following'>"; ?>
                                                    <?php echo "<h6 class='text-white'>$user_name</h6>"; ?>
                                                </a>
                                                <?php echo "<h6 id='s$following' style='color:$followBtn;cursor:pointer' onclick=\"followStatus('$following')\">$sfollowing</h6>"; ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php }
                        ?>
                    </div>
                <?php } else { ?>
                    <!-- Listas -->
                    <div class='pt-2 pr-3 pl-2 text-center'>
                        <h5>
                            Listas em Destaque 
                            <!-- <a href='' class="btn-toggle" data-element="#advanced-search">
                                <span style='font-size:15px'>
                                    <i class="fas fa-external-link-alt"></i>
                                <span>
                            </a>
                            <div id="advanced-search" style="display:none">
                                <a href='lista/novo.php'>
                                    <small class='mt-2'>
                                        CLIQUE AQUI E VEJA, EDITE OU CRIE SUAS LISTAS
                                    </small>
                                </a>
                            </div> -->
                        </h5>
                    </div><hr/>                
                    <!-- Lançamentos -->
                    <div>
                        <div class='pl-2 pr-3'>
                            <h5>Lançamentos<small class='to-right mt-2'><a href='#'>VER TODOS</a></small></h5>
                        </div>
                        <div class="owl-carousel owl-theme m-0 pt-2 pr-0 pb-0 pl-2">                        
                            <?php                        
                            $url = file_get_contents("https://api-content.ingresso.com/v0/templates/nowplaying");
                            $json = json_decode($url, true);
                            foreach ($json as $i){
                                $title = $i['title'];
                                $image = $j['url'];
                                foreach ($i as $j){
                                    
                                }
                                echo "<div class='list-e $border b$movieId'>";
                                    echo "<img class='poster to-fit' src='$image'/>"; ?>
                                    <span class='movie-info'>
                                        <?php echo "<a><h6 class='text-black mb-1'>$title</h6></a>"; ?>
                                        <?php echo "<a><h6 class='text-black mb-1'>$image</h6></a>"; ?>
                                    </span>
                                </div>
                            <? } ?>
                        </div>
                        <?php
                        $query = "SELECT * FROM movies WHERE CAST(debut AS DATE) BETWEEN '$cartaz' AND '$today' GROUP BY RAND() LIMIT 8";
                        $stm = $db -> prepare($query);
                        if ($stm -> execute()){ ?>
                            <div class='pl-2 pr-3'>
                                <h5>Lançamentos<small class='to-right mt-2'><a href='#'>VER TODOS</a></small></h5>
                            </div>
                            <div class="owl-carousel owl-theme m-0 pt-2 pr-0 pb-0 pl-2">
                                <?php
                                while ($row = $stm -> fetch()){
                                    $movieId = $row['movieId'];
                                    $title = $row['title'];
                                    $moviePoster = $row['moviePoster'];
                                    $classificacao = 0;

                                    $query_test = 'SELECT classificacao FROM statusmovie WHERE movieId = ? AND classificacao IS NOT NULL';
                                    $stm_test = $db -> prepare($query_test);
                                    $stm_test -> bindParam(1,$movieId);

                                    if ($stm_test -> execute()) {
                                        if ($row = $stm_test -> fetch()) {
                                            $movie_avg = "SELECT AVG(statusmovie.classificacao) AS media FROM movie INNER JOIN statusmovie ON (movie.movieId = ?) AND (movie.movieId = statusmovie.movieId) GROUP BY movie.title";
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
                        
                                    $testeStatus = "SELECT * FROM statusmovie WHERE movieId = ? AND user_account = '$user_account'";
                                    $tS = $db -> prepare($testeStatus);
                                    $tS -> bindParam(1, $movieId);
                                                
                                    if ($tS -> execute()) {
                                        if ($row = $tS -> fetch()) {
                                            $border = 'watched';
                                            $status = 'Assistido';
                                            $color = 'green';
                                            $classificacao = $row['classificacao'];
                                        }else{
                                            $border = 'n-watched';
                                            $status = 'Não Assistido';
                                            $color = 'red';
                                        }
                                    }

                                    ?>     
                                    <?php echo "<div class='list-e $border b$movieId'>"; ?>
                                        <?php echo "<img class='poster to-fit' src='https://gomoodie.com/adm/movie/img/$moviePoster'/>"; ?>
                                        <span class='movie-info'>
                                            <?php echo "<a href='adm/movie/profile.php?movieId=$movieId'><h6 class='text-white mb-1'>$title</h6></a>"; ?>
                                            <select class="example c<?php print $movieId ?>">
                                                <option value=""></option>
                                                <option value="1" <?php print $classificacao == 1? "selected": "" ?>><?php print $movieId ?></option>
                                                <option value="2" <?php print $classificacao == 2? "selected": "" ?>><?php print $movieId ?></option>
                                                <option value="3" <?php print $classificacao == 3? "selected": "" ?>><?php print $movieId ?></option>
                                                <option value="4" <?php print $classificacao == 4? "selected": "" ?>><?php print $movieId ?></option>
                                                <option value="5" <?php print $classificacao == 5? "selected": "" ?>><?php print $movieId ?></option>
                                            </select>
                                            <?php echo "<h6 class='s$movieId' style='color:$color; cursor:pointer' onclick='changeStatus($movieId)'>$status</h6>"; ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div><hr/>                
                    <!-- Queridos -->
                    <div>
                        <?php
                        $cont = 0;
                        $query = "SELECT AVG(statusmovie.classificacao) AS media, movie.movieId, movie.title, movie.original_title, movie.movieCountry, movie.movieGenre, movie.movieDirector, movie.moviePoster, movie.movieDuration, movie.year, statusmovie.statusMovie FROM statusmovie INNER JOIN movie ON (movie.movieId = statusmovie.movieId) GROUP BY movie.title HAVING count(statusmovie.classificacao) > 25 AND AVG(statusmovie.classificacao) > 2.5 ORDER BY media DESC LIMIT 100";
                        $stm = $db -> prepare($query);
                        if ($stm -> execute()){ ?>                                        
                            <div class='pl-2 pr-3'>
                                <h5>Queridos<small class='to-right mt-2'><a>VER TODOS</a></small></h5>
                            </div>
                            <div class="owl-carousel owl-theme m-0 pt-2 pr-0 pb-0 pl-2">
                                <?php
                                while ($row = $stm -> fetch()){
                                    $movieId = $row['movieId'];
                                    $title = $row['title'];
                                    $moviePoster = $row['moviePoster'];
                                    $classificacao = 0;

                                        $query_test = 'SELECT classificacao FROM statusmovie WHERE movieId = ? AND classificacao IS NOT NULL';
                                        $stm_test = $db -> prepare($query_test);
                                        $stm_test -> bindParam(1,$movieId);

                                        if ($stm_test -> execute()) {
                                            if ($row = $stm_test -> fetch()) {
                                                $movie_avg = "SELECT AVG(statusmovie.classificacao) AS media FROM movie INNER JOIN statusmovie ON (movie.movieId = ?) AND (movie.movieId = statusmovie.movieId) GROUP BY movie.title";
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
                                    
                                    $testeStatus = "SELECT * FROM statusmovie WHERE movieId = ? AND user_account = '$user_account'";
                                    $tS = $db -> prepare($testeStatus);
                                    $tS -> bindParam(1, $movieId);
                                                
                                    if ($tS -> execute()) {
                                        if ($row = $tS -> fetch()) {
                                            $border = 'watched';
                                            $status = 'Assistido';
									        $color = 'green';
									        $classificacao = $row['classificacao'];
                                        }else{
                                            $border = 'n-watched';
                                            $status = 'Não Assistido';
									        $color = 'red';
                                        }
                                    }

                                    if($border == 'n-watched' && $cont < 8){ 
                                        $cont ++;
                                        ?>
                                        <?php echo "<div class='list-e $border b$movieId'>"; ?>
                                            <?php echo "<img class='poster to-fit' src='https://gomoodie.com/adm/movie/img/$moviePoster'/>"; ?>                                    
                                            <span class='movie-info'>
                                                <?php echo "<a href='adm/movie/profile.php?movieId=$movieId'><h6 class='text-white mb-1'>$title</h6></a>"; ?>
                                                <select class="example c<?php print $movieId ?>">
                                                    <option value=""></option>
                                                    <option value="1" <?php print $classificacao == 1? "selected": "" ?>><?php print $movieId ?></option>
                                                    <option value="2" <?php print $classificacao == 2? "selected": "" ?>><?php print $movieId ?></option>
                                                    <option value="3" <?php print $classificacao == 3? "selected": "" ?>><?php print $movieId ?></option>
                                                    <option value="4" <?php print $classificacao == 4? "selected": "" ?>><?php print $movieId ?></option>
                                                    <option value="5" <?php print $classificacao == 5? "selected": "" ?>><?php print $movieId ?></option>
                                                </select>
                                                <?php echo "<h6 class='s$movieId' style='color:$color; cursor:pointer' onclick='changeStatus($movieId)'>$status</h6>"; ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div><hr/>
                    <!-- Populares -->
                    <div>
                        <?php
                        $cont = 0;
                        $query = "SELECT count(*) as NrVezes, statusmovie.movieId, movie.title, movie.original_title, movie.movieCountry, movie.movieGenre, movie.movieDirector, movie.moviePoster, movie.movieDuration, movie.year, statusmovie.statusMovie FROM statusmovie inner join movie ON statusmovie.movieId = movie.movieId GROUP BY movieId ORDER BY NrVezes DESC LIMIT 100";
                        $stm = $db -> prepare($query);
                        if ($stm -> execute()){ ?> 
                                            
                            <div class='pl-2 pr-3'>
                                <h5>Populares<small class='to-right mt-2'><a href='#'>VER TODOS</a></small></h5>
                            </div>
                            <div class="owl-carousel owl-theme m-0 pt-2 pr-0 pb-0 pl-2">
                                <?php
                                while ($row = $stm -> fetch()){
                                    $movieId = $row['movieId'];
                                    $title = $row['title'];
                                    $moviePoster = $row['moviePoster'];
                                    $classificacao = 0;

                                        $query_test = 'SELECT classificacao FROM statusmovie WHERE movieId = ? AND classificacao IS NOT NULL';
                                        $stm_test = $db -> prepare($query_test);
                                        $stm_test -> bindParam(1,$movieId);

                                        if ($stm_test -> execute()) {
                                            if ($row = $stm_test -> fetch()) {
                                                $movie_avg = "SELECT AVG(statusmovie.classificacao) AS media FROM movie INNER JOIN statusmovie ON (movie.movieId = ?) AND (movie.movieId = statusmovie.movieId) GROUP BY movie.title";
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
                                    
                                    $testeStatus = "SELECT * FROM statusmovie WHERE movieId = ? AND user_account = '$user_account'";
                                    $tS = $db -> prepare($testeStatus);
                                    $tS -> bindParam(1, $movieId);
                                                
                                    if ($tS -> execute()) {
                                        if ($row = $tS -> fetch()) {
                                            $border = 'watched';
                                            $status = 'Assistido';
									        $color = 'green';
									        $classificacao = $row['classificacao'];
                                        }else{
                                            $border = 'n-watched';
                                            $status = 'Não Assistido';
									        $color = 'red';
                                        }
                                    }

                                    if($border == 'n-watched' && $cont < 8){ 
                                        $cont ++;
                                        ?>
                                        <?php echo "<div class='list-e $border b$movieId'>"; ?>
                                            <?php echo "<img class='poster to-fit' src='https://gomoodie.com/adm/movie/img/$moviePoster'/>"; ?>
                                            <span class='movie-info'>
                                                <?php echo "<a href='adm/movie/profile.php?movieId=$movieId'><h6 class='text-white mb-1'>$title</h6></a>"; ?>
                                                <select class="example c<?php print $movieId ?>">
                                                    <option value=""></option>
                                                    <option value="1" <?php print $classificacao == 1? "selected": "" ?>><?php print $movieId ?></option>
                                                    <option value="2" <?php print $classificacao == 2? "selected": "" ?>><?php print $movieId ?></option>
                                                    <option value="3" <?php print $classificacao == 3? "selected": "" ?>><?php print $movieId ?></option>
                                                    <option value="4" <?php print $classificacao == 4? "selected": "" ?>><?php print $movieId ?></option>
                                                    <option value="5" <?php print $classificacao == 5? "selected": "" ?>><?php print $movieId ?></option>
                                                </select>
                                                <?php echo "<h6 class='s$movieId' style='color:$color; cursor:pointer' onclick='changeStatus($movieId)'>$status</h6>"; ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div><hr/>
                    <!-- Oscar 2019 -->
                    <!--<div>
                        <?php/*
                        $query = "SELECT * FROM nomination INNER JOIN movie ON nomination.movie_id = movie.movieId GROUP BY movie_id HAVING RAND() LIMIT 8";
                        $stm = $db -> prepare($query);
                        if ($stm -> execute()){ ?> 
                                            
                            <div class='pl-2 pr-3'>
                                <h5>Oscar 2019<small class='to-right mt-2'><a href='#'>VER TODOS</a></small></h5>
                            </div>
                            <div class="owl-carousel owl-theme m-0 pt-2 pr-0 pb-0 pl-2">
                                <?php
                                while ($row = $stm -> fetch()){
                                    $movieId = $row['movieId'];
                                    $title = $row['title'];
                                    $moviePoster = $row['moviePoster'];
                                    $nomination_category = $row['nomination_category'];
                                    $classificacao = 0;

                                    $query_test = 'SELECT classificacao FROM statusmovie WHERE movieId = ? AND classificacao IS NOT NULL';
                                    $stm_test = $db -> prepare($query_test);
                                    $stm_test -> bindParam(1,$movieId);

                                    if ($stm_test -> execute()) {
                                        if ($row = $stm_test -> fetch()) {
                                            $movie_avg = "SELECT AVG(statusmovie.classificacao) AS media FROM movie INNER JOIN statusmovie ON (movie.movieId = ?) AND (movie.movieId = statusmovie.movieId) GROUP BY movie.title";
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
                                                                        
                                    $testeStatus = "SELECT * FROM statusmovie WHERE movieId = ? AND user_account = '$user_account'";
                                    $tS = $db -> prepare($testeStatus);
                                    $tS -> bindParam(1, $movieId);
                                                
                                    if ($tS -> execute()) {
                                        if ($row = $tS -> fetch()) {
                                            $border = 'watched';
                                            $status = 'Assistido';
									        $color = 'green';
									        $classificacao = $row['classificacao'];
                                        }else{
                                            $border = 'n-watched';
                                            $status = 'Não Assistido';
									        $color = 'red';
                                        }
                                    }

                                    ?>     
                                    <?php echo "<div class='list-e $border b$movieId'>"; ?>                                        
                                        <?php echo "<img class='poster to-fit' src='https://gomoodie.com/adm/movie/img/$moviePoster'/>"; ?>
                                        <?php echo "<h6 class='text-center p-1 m-0 bg-light'>$nomination_category</h6>"; ?>
                                        <span class='movie-info' style='bottom:12%!important'>
                                            <?php echo "<a href='adm/movie/profile.php?movieId=$movieId'><h6 class='text-white mb-1'>$title</h6></a>"; ?>
                                            <select class="example c<?php print $movieId ?>">
                                                <option value=""></option>
                                                <option value="1" <?php print $classificacao == 1? "selected": "" ?>><?php print $movieId ?></option>
                                                <option value="2" <?php print $classificacao == 2? "selected": "" ?>><?php print $movieId ?></option>
                                                <option value="3" <?php print $classificacao == 3? "selected": "" ?>><?php print $movieId ?></option>
                                                <option value="4" <?php print $classificacao == 4? "selected": "" ?>><?php print $movieId ?></option>
                                                <option value="5" <?php print $classificacao == 5? "selected": "" ?>><?php print $movieId ?></option>
                                            </select>
                                            <?php echo "<h6 class='s$movieId' style='color:$color; cursor:pointer' onclick='changeStatus($movieId)'>$status</h6>"; ?>                                        
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } */?>
                    </div><hr/>-->
                    <!-- Em Breve -->
                    <div>
                        <?php
                        $query = "SELECT * FROM movies WHERE CAST(debut AS DATE) BETWEEN '$today' AND '2222-01-01' GROUP BY RAND() LIMIT 8";
                        $stm = $db -> prepare($query);
                        if ($stm -> execute()){ ?>                                        
                            <div class='pl-2 pr-3'>
                                <h5>Em Breve<small class='to-right mt-2'><a href='#'>VER TODOS</a></small></h5>
                            </div>
                            <div class="owl-carousel owl-theme m-0 pt-2 pr-0 pb-0 pl-2">
                                <?php
                                while ($row = $stm -> fetch()){
                                    $movieId = $row['movieId'];
                                    $title = $row['title'];
                                    $moviePoster = $row['moviePoster'];
                                    ?>
                                    <?php echo "<div class='list-e'>"; ?>                       
                                        <?php echo "<img class='poster to-fit' style='border-radius:5px' src='https://gomoodie.com/adm/movie/img/$moviePoster'/>"; ?>
                                        <span class='movie-info'>
                                            <?php echo "<a href='adm/movie/profile.php?movieId=$movieId'><h6 class='text-white mb-1'>$title</h6></a>"; ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </main>
    </div>

    <script src='local/library/owlcarousel/owl.carousel.min.js'></script>
    <script src='local/library/owlcarousel/jquery.mousewheel.min.js'></script>
    <script src='local/library/owlcarousel/file.js'></script>

    <script>
		$(function() {
			$(".btn-toggle").click(function(e) {
				e.preventDefault();
				el = $(this).data('element');
				$(el).toggle();
			});
		});
    </script>
    
    <!-- Star Rating -->
	<script src="js/rating/jquery.barrating.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$('.example').barrating({
				theme: 'bootstrap-stars', 
				onSelect: function(classificacao, movieId, event){
					$.post( "status/classifica.php", { "movieId": movieId, "classificacao": classificacao })
						.done(function( data ) {
							$('.s'+movieId).html('Assistido');
							$('.s'+movieId).css('color', 'green');
                            $('.b'+movieId).removeClass('n-watched');
                            $('.b'+movieId).addClass('watched');
						}
					);
				}
			});
		});
	</script>

    <!-- Change Status -->
	<script type="text/javascript">
		function changeStatus(movieId){
			$.post( "status/watched.php", { "movieId": movieId })
				.done(function( data ) {
					if (data == 'Assistido'){
						$('.s'+movieId).html('Assistido');
						$('.s'+movieId).css('color', 'green');
                        $('.b'+movieId).removeClass('n-watched');
                        $('.b'+movieId).addClass('watched');
					}
					else {
						$('.s'+movieId).html('Não assistido');
						$('.s'+movieId).css('color', 'red');
						$('.c'+movieId).barrating('set', '');
                        $('.b'+movieId).removeClass('watched');
                        $('.b'+movieId).addClass('n-watched');
					}
				}
			);	
		}
	</script>

	<!-- Follow -->
	<script type="text/javascript">
		function followStatus(following){	
			$.post( "status/follow.php", { "following": following })
				.done(function( data ) {
					if (data == 'Teste'){
						$('#s'+following).html('Seguir');
						$('#s'+following).css('color', 'red');	
					}
					else {
						$('#s'+following).html('Seguindo');
						$('#s'+following).css('color', 'green');
					}
				}
			);	
		}
	</script>	

	<!-- Progress Bar Loading -->
	<?php include_once "js/progress/import.php"; ?>
</body>
</html>