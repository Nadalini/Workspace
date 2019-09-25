<?php
	include_once "../../user/login/check.php";
	
	session_start();

	include_once "../../bd.php";
	include_once "../../controller/permission_colab.php"; 

	$movieId = $_GET['movieId'];

    $query_movie = "SELECT * FROM movie WHERE movieId = ?";
    $stm_movie = $db -> prepare($query_movie);
    $stm_movie->bindParam(1,$movieId);
    if ($stm_movie -> execute()) {
        if ($row_movie = $stm_movie -> fetch()) {
        	$movieId = $row_movie['movieId'];
			$movieName = $row_movie['movieName'];
			$movieOrigName = $row_movie['movieOrigName'];
			$movieCountry = $row_movie['movieCountry'];
			$movieGenre = $row_movie['movieGenre'];
            $movieDirector = $row_movie['movieDirector'];
            $moviePoster = $row_movie['moviePoster'];
            $movieTrailer = $row_movie['movieTrailer'];
			$movieDate = $row_movie['movieDate'];
			$movieDuration = $row_movie['movieDuration'];
			$movie_plot = $row_movie['movie_plot'];
			$movie_release = $row_movie['movie_release'];
			$movie_cast = $row_movie['movie_cast'];
		}
	}

	// Query - User Profile
	include_once "../../query/user_profile.php";
	// Query - User Library
	include_once "../../query/user_library.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
    <script src="../js/index.js" type="text/javascript"></script>
	<title>Moodie - Editar Filmes</title>
    <link rel="stylesheet" type="text/css" href="../../css/main.css"/>
	<link rel="shortcut icon" type="image/png" href="../../image/favicon.ico"/>
    <!-- Library Imports -->
	<?php include_once "../../library/bootstrap.php"; ?>
    <!-- Importações  Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
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
	<div class='container-cadast'>
		
		<?php include_once "../../bar/navbar.php"; ?>
		
		<div class='left-bar'>
			<?php include_once "../../bar/profile.php"; ?>	
		</div>

	    <div class="right-bar-cadast">

            <?php
				$nome = '';
				if (isset($_POST['nome']) && !empty($_POST['nome'])){
					print"
					<div class='box' style='padding: 20px 10px 20px 10px; margin-bottom:30px;'>
					<h2 class='titulo' style='margin-bottom:10px;'>Listagem de Filmes</h2>";	
					
					$nome = $_POST['nome'];

					$query = "SELECT * FROM movie WHERE (movieOrigName LIKE '%$nome%') OR (movieName LIKE '%$nome%')";
					$stm = $db -> prepare($query);
					if ($stm -> execute()){
					
						print"
						<div class='row' style='width:90%; margin:auto;'>
						";

						while ($row = $stm -> fetch()){
							$movieId = $row['movieId'];	
							$movieName = $row['movieName'];
							$movieOrigName = $row['movieOrigName'];	
							$moviePoster = $row['moviePoster'];	
							print"
							<div class='col-lg-4 listagem-especifica' style='padding:5px!important;'>
								<img class='image-list' src='img/$moviePoster'/>
								<span>$movieName</span>
							</div>";
						}

						print"</div>";

					}else{
						print"Erro!";
					}
				}
				?>
        
			<?php if (empty($_POST['nome'])){ ?>
            <div class='box' style='padding: 20px 48px 32px 48px;margin-bottom:30px;'>
                <p class="titulo">Editar</p>   
                <h6 class="descricao"><b>Edite filmes já existentes</b> no banco de dados<br>do nosso sistema.</h6>
                <form method="post" action="update.php" enctype="multipart/form-data">
                    <div class="row"> 
						<?php echo"<input name='movieId' type='text' value='$movieId' hidden/>";?>
                        <div class="input-group">
                            <?php echo"<input name='movieName' type='text' value='$movieName' placeholder='Nome do Filme' maxlength='50' required/>";?>
                        </div>
                        <div class="input-group">
							<?php echo"<input name='movieOrigName' type='text' value='$movieOrigName' placeholder='Nome Original' maxlength='50' required/>";?>
                        </div>
                        <div class="input-group">
							<?php echo"<input name='movieDate' type='text' value='$movieDate' placeholder='Ano do Filme' maxlength='4' required/>";?>
                        </div>
                        <div class="input-group">
                            <select class="form-control" name="movieCountry" id="sel1" required>
								<?php
									echo"<option value='$movieCountry'>$movieCountry</option>
									<option value=''></option>";
                                                                        
                        	        $query = "SELECT * FROM country ORDER BY countryName ASC";
                                    $stm = $db->prepare($query);
                            	    $stm->execute();

                                    while ($row = $stm->fetch()){
                                        $countryName = $row['countryName'];
                                        print "<option value='$countryName'>$countryName</option>";
                                    }							
                                ?>
                            </select>
                        </div>
						<div class="input-group">
							<?php echo"<input name='movieGenre' type='text' value='$movieGenre' placeholder='Gênero' required/>";?>
                        </div>
						<div class="input-group">
							<?php echo"<input name='movieDirector' type='text' value='$movieDirector' placeholder='Diretor'  required/>";?>
                        </div>
						<div class="input-group">
							<?php echo"<textarea name='movie_cast' class='form-control' type='text' placeholder='Principais Atores' maxlength='150' rows='4'>$movie_cast</textarea>";?>
						</div>
                        <div class="input-group">
							<?php echo"<input name='movieDuration' type='text' value='$movieDuration' maxlength='4'/>";?>
                        </div>
						<div class="input-group">
                            <input name="moviePoster" type="file"/>
						</div>
						<div class="input-group">
                            <?php echo "<input name='movieTrailer' type='text' value='$movieTrailer' maxlength='200'/>"; ?>
                        </div>
						<div class="input-group">
							<?php echo "<textarea name='movie_plot' class='form-control' placeholder='Sinopse' type='text' maxlength='2500' rows='8'>$movie_plot</textarea>"; ?>
                        </div>
						<div class="input-group">
                            <?php echo "<input name='movie_release' type='text' value='$movie_release' maxlength='2'/>"; ?>
                        </div>
                    </div>
                    <div class="final">
						<button class="btn btn-outline-danger but" type="submit">Atualizar</button><br>
						<?php echo "<a href='profile.php?movieId=$movieId'>Voltar</a>";?>	
                    </div>
                </form>
            </div>
    	</div>
			<?php } ?>
        </div>
</body>
</html>