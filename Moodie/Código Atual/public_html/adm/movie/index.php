<?php
	include_once "../../user/login/check.php";
	
	session_start();

	include_once "../../bd.php";
	// include_once "../../controller/permission_colab.php";

	// Query - User Profile
	include_once "../../query/user_profile.php";
	// Query - User Library
	include_once "../../query/user_library.php";

	$fuso = new DateTimeZone('America/Sao_Paulo');
	$register_date = new DateTime();
	$register_date->setTimezone($fuso);
	$register_date = $register_date->format('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="pt-br" >
<head>
    <meta charset="UTF-8"/>
	<title>Moodie - Cadastro de Filmes</title>
	<link rel="shortcut icon" type="image/png" href="../../image/favicon.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Google AdSense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-1375441582024377",
        enable_page_level_ads: true
      });
    </script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
	<style>.caret{display:none!important}</style>
</head>
<body class='bg-secondary text-white'>
	<div class='container'>
		<?php // include_once "../../bar_und/navbar.php"; ?>
		<!-- <div class="row justify-content-center">
	  		<div class="col-sm-12 col-md-12 col-lg-10 p-4 m-1 bg-light text-dark rounded">
	  			<div class="row">
					<div class="col-6">
				  		<label for="exampleInputEmail1">Usuário: </label>
						<?php echo "<input class='form-control' type='text' placeholder='$user_account' disabled/>"; ?>
					</div>
					<div class="col-6">
						<?php
							$query = "SELECT COUNT(id) AS cont FROM movies WHERE user_account = '$user_account'";
							$stm = $db->prepare($query);
							$stm->execute();
							while ($row = $stm->fetch()){
								$cont = $row['cont'];
							}								
						?>
						<label for="exampleInputEmail1">Número de Filmes Cadastrados: </label>
						<?php echo "<input class='form-control' type='text' placeholder='$cont' disabled/>"; ?>
					</div>
				</div>			  	
			</div>
		</div> -->
		<div class="row justify-content-center">
			<div class='col-sm-12 col-md-12 col-lg-6 p-4 m-1 bg-light text-dark rounded'>
				<div class="m-5">
					<h3 class='text-center font-weight-bold'>Cadastro</h3>   
					<h5	class='text-center'><b>Cadastre filmes novos</b> no banco de dados<br>do nosso sistema.</h5>
					<?php
						$title = isset($_GET['title']) ? $_GET['title']: '';
						$year = isset($_GET['year']) ? $_GET['year']: '';
					?>
					<form method='get' action='index.php'>
						<div class='row justify-content-center'>
							<div class='col-8'>
								<div class="form-group">
									<?php echo "<input class='form-control' name='title' value='$title' type='text' placeholder='Nome'/>";?>
								</div>
							</div>
							<div class='col-4'>
								<div class="form-group">
									<?php echo "<input class='form-control' name='year' value='$year' type='number' placeholder='Ano'/>";?>
								</div>
							</div>
							<button class="btn btn-dark" type="submit">Completar</button>
						</div>					
					</form>
					<?php
						if ($title != ''){
							$array = explode(" ", $title);
							$n_palavras = count ($array);
							$title = '';
							for($i = 0; $i < $n_palavras; $i++){
								if($i != 0){
									$title = $title.'+'.$array[$i];
								}else{
									$title = $array[$i];
								}
							}
							$url = file_get_contents("http://www.omdbapi.com/?t=$title&plot=full&apikey=c3969011");
							if ($year != ''){
								$url = file_get_contents("http://www.omdbapi.com/?t=$title&y=$year&plot=full&apikey=c3969011");
							}
							$json = json_decode($url, true);

							$original_title = $json['Title'];
							$year = $json['Year'];
							$runtime = $json['Runtime'];
							$language = $json['Language'];
							$poster = $json['Poster'];
							$debut = $json['Released'];
							$plot = $json['Plot'];
							$director = $json['Director'];
							$genre = $json['Genre'];
							$country = $json['Country'];
							$cast = $json['Actors'];

							list($day, $month, $year) = explode(" ", $debut);
							switch($month){
								case "Jan":
									$month = '01';
									break;
								case "Feb":
									$month = '02';
									break;
								case "Mar":
									$month = '03';
									break;
								case "Apr":
									$month = '04';
									break;
								case "May":
									$month = '05';
									break;
								case "Jun":
									$month = '06';
									break;
								case "Jul":
									$month = '07';
									break;
								case "Aug":
									$month = '08';
									break;
								case "Sep":
									$month = '09';
									break;
								case "Oct":
									$month = '10';
									break;
								case "Nov":
									$month = '11';
									break;
								case "Dec":
									$month = '12';
									break;
							}

							$debut = $year."-".$month."-".$day;
							
							list($runtime) = explode(" ", $runtime);
					?>
				</div>
				<div class="m-5">
					<form method="post" action="save.php" enctype="multipart/form-data">
						<div class="row">
							<!-- Title -->
								<div class="form-group w-100">
									<label for="exampleInputEmail1">Título do Filme *</label>
									<input class='form-control' name='title' type='text' placeholder='Título em Português' maxlength='50' required/>
								</div>
							<!-- Original Title -->
								<div class="form-group w-100">
									<label for="exampleInputEmail1">Título Original *</label>
									<?php echo"<input value='$original_title' class='form-control' name='original_title' type='text' placeholder='Título Original' maxlength='50' required/>";?>
								</div>
							<!-- Direction -->
								<div class="form-group w-100">
									<label for="exampleFormControlSelect2">Diretor *</label><br>
									<select multiple class="selectpicker w-100" name='director[]' id="exampleFormControlSelect2" data-live-search="true" data-actions-box="true" title="Escolha o diretor">
										<?php
											$query = "SELECT * FROM celeb ORDER BY name ASC";
											$stm = $db->prepare($query);
											$stm->execute();
											while ($row = $stm->fetch()){
												$nick = $row['nick'];
												$id = $row['id'];
												print "<option class='w-100' value='$id'>$nick</option>";
											}								
										?>
									</select>
									<?php echo "<input class='form-control' type='text' placeholder='Sugestão: $director' disabled/>"; ?>
								</div>
							<!-- Year -->
								<div class="form-group w-100">
									<label for="exampleInputEmail1">Ano de Lançamento</label>
									<?php echo"<input class='form-control' name='year' type='number' value='$year' placeholder='Ano de Lançamento' required/>";?>
								</div>
							<!-- Debut -->
								<div class="form-group w-100">
									<label for="exampleInputEmail1">Lançamento</label>
									<?php echo"<input class='form-control' name='debut' type='date' value='$debut'/>";?>
								</div>
							<!-- Runtime -->
								<div class="form-group w-100">
									<label for="exampleInputEmail1">Duração</label>
									<?php echo"<input class='form-control' name='runtime' type='number' value='$runtime' placeholder='Duração do Filme' required/>";?>
								</div>
							<!-- Language -->
								<div class="form-group w-100">
									<label for="exampleInputEmail1">Idioma Original *</label>
									<?php echo"<input class='form-control' name='language' type='text' placeholder='$language' required/>";?>
								</div>
							<!-- Genre -->
								<div class="form-group w-100">
									<label for="exampleFormControlSelect1">Gêneros *</label><br>
									<select multiple class="w-100 selectpicker" name='genre_id[]' id="exampleFormControlSelect1" data-live-search="true" data-actions-box="true" title="Escolha o gênero" data-size="10">
										<?php
											$query = "SELECT * FROM genre ORDER BY name ASC";
											$stm = $db->prepare($query);
											$stm->execute();
											while ($row = $stm->fetch()){
												$name = $row['name'];
												$id = $row['id'];
												print "<option class='w-100' value='$id'>$name</option>";
											}								
										?>
									</select>
									<?php echo "<input class='form-control' type='text' placeholder='Sugestão: $genre' disabled/>"; ?>
								</div><br>
							<!-- Country -->
								<div class="form-group w-100">
									<label for="exampleFormControlSelect1">Países *</label><br>
									<select multiple class="w-100 selectpicker" name='country_id[]' id="exampleFormControlSelect1" data-live-search="true" data-actions-box="true" title="Escolha o país" data-size="10">
										<?php
											$query = "SELECT * FROM country ORDER BY name ASC";
											$stm = $db->prepare($query);
											$stm->execute();
											while ($row = $stm->fetch()){
												$id = $row['id'];
												$name = $row['name'];
												print "<option class='w-100' value='$id'>$name</option>";
											}								
										?>
									</select>
									<?php echo "<input class='form-control' type='text' placeholder='Sugestão: $country' disabled/>"; ?>
								</div>
							<!-- Poster e Plot -->
								<div class="row">
									<div class="col-sm-12 col-md-8 col-lg-8">									
										<!-- Plot -->
										<div class="form-group w-100">
											<label>Sinopse *</label><br>
											<?php echo "<textarea name='plot' class='form-control' placeholder='$plot' type='text' maxlength='2500' rows='5'></textarea>"; ?>
										</div>
										<!-- Poster -->
										<div class="form-group w-100">
											<label for="exampleInputEmail1">Poster *</label>
											<?php echo"<input class='form-control' name='poster' type='text' value='$poster' placeholder='Coloque o URL do poster em alta qualidade' required/>";?>										
										</div>
									</div>
									<div class="col-sm-12 col-md-4 col-lg-4">
										<label>Poster Preview</label><br>
										<?php echo "<img src='$poster' class='img-fluid' alt='Movie Poster'>";?>
									</div>													
								</div>							
							<!-- Cast -->
								<div class="form-group w-100">
									<label for="exampleFormControlSelect1">Cast</label><br>
									<select multiple class="selectpicker w-100" name='cast[]' id="exampleFormControlSelect1" data-live-search="true" data-actions-box="true" title="Escolha os atores">
										<?php
											$query = "SELECT * FROM celeb ORDER BY name ASC";
											$stm = $db->prepare($query);
											$stm->execute();
											while ($row = $stm->fetch()){
												$nick = $row['nick'];
												$id = $row['id'];
												print "<option value='$id'>$nick</option>";
											}								
										?>
									</select>
									<?php echo "<input class='form-control' type='text' placeholder='Sugestão: $cast' disabled/>"; ?>
								</div>
							<!-- Trailer -->
								<div class="form-group w-100">
									<label for="exampleInputEmail1">Trailer</label>
									<input class='form-control' name='trailer' placeholder="URL do vídeo após 'youtube.com/watch?v='" type='text'/>
								</div>
						</div>
						<?php } else {?>
							<form method="post" action="save.php" enctype="multipart/form-data">
								<div class="row justify-content-center">
									<!-- Title -->
									<div class="form-group w-100">
										<label for="exampleInputEmail1">Título do Filme *</label>
										<?php echo"<input class='form-control' name='title' type='text' placeholder='Título em Português' maxlength='50' required/>";?>
									</div>
									<!-- Original Title -->
									<div class="form-group w-100">
										<label for="exampleInputEmail1">Título Original *</label>
										<?php echo"<input class='form-control' name='original_title' type='text' placeholder='Título Original' maxlength='50' required/>";?>
									</div>
									<!-- Direction -->
									<div class="form-group w-100">
										<label for="exampleFormControlSelect2">Diretor *</label><br>
										<select multiple class="selectpicker w-100" name='director[]' id="exampleFormControlSelect2" data-live-search="true" data-actions-box="true" title="Escolha o diretor">
											<?php
												$query = "SELECT * FROM celeb INNER JOIN c_j WHERE c_j.job_id = 1 ORDER BY name ASC";
												$stm = $db->prepare($query);
												$stm->execute();
												while ($row = $stm->fetch()){
													$nick = $row['nick'];
													$id = $row['id'];
													print "<option class='w-100' value='$id'>$nick</option>";
												}								
											?>
										</select>
									</div>
									<!-- Year -->
									<div class="form-group w-100">
										<label for="exampleInputEmail1">Ano de Lançamento</label>
										<?php echo"<input class='form-control' name='year' type='number' value='$year' placeholder='Ano de Lançamento' required/>";?>
									</div>
									<!-- Debut -->
									<div class="form-group w-100">
										<label for="exampleInputEmail1">Lançamento</label>
										<?php echo"<input class='form-control' name='debut' type='date' value='$debut'/>";?>
									</div>
									<!-- Runtime -->
									<div class="form-group w-100">
										<label for="exampleInputEmail1">Duração</label>
										<?php echo"<input class='form-control' name='runtime' type='number' value='$runtime' placeholder='Duração do Filme' required/>";?>
									</div>
									<!-- Language -->
									<div class="form-group w-100">
										<label for="exampleInputEmail1">Idioma Original *</label>
										<?php echo"<input class='form-control' name='language' type='text' value='$language' placeholder='Idioma Original' required/>";?>
									</div>									
									<!-- Genre -->
									<div class="form-group w-100">
										<label for="exampleFormControlSelect1">Gêneros *</label><br>
										<select multiple class="w-100 selectpicker" name='genre_id[]' id="exampleFormControlSelect1" data-live-search="true" data-actions-box="true" title="Escolha o gênero" data-size="10">
											<?php
												$query = "SELECT * FROM genre ORDER BY name ASC";
												$stm = $db->prepare($query);
												$stm->execute();
												while ($row = $stm->fetch()){
													$name = $row['name'];
													$id = $row['id'];
													print "<option class='w-100' value='$id'>$name</option>";
												}								
											?>
										</select>
									</div><br>
									<!-- Country -->
									<div class="form-group w-100">
										<label for="exampleFormControlSelect1">Países *</label><br>
										<select multiple class="w-100 selectpicker" name='country_id[]' id="exampleFormControlSelect1" data-live-search="true" data-actions-box="true" title="Escolha o país" data-size="10">
											<?php
												$query = "SELECT * FROM country ORDER BY name ASC";
												$stm = $db->prepare($query);
												$stm->execute();
												while ($row = $stm->fetch()){
													$id = $row['id'];
													$name = $row['name'];
													print "<option class='w-100' value='$id'>$name</option>";
												}								
											?>
										</select>
									</div>
									<!-- Poster -->
									<div class="form-group w-100">
										<label for="exampleInputEmail1">Poster *</label>
										<?php echo"<input class='form-control' name='poster' type='text' value='$poster' placeholder='Coloque o URL do poster em alta qualidade' required/>";?>
									</div>
									<!-- Plot -->
									<div class="form-group w-100">
										<label>Sinopse *</label><br>
										<?php echo "<textarea name='movie_plot' class='form-control' placeholder='$plot' type='text' maxlength='2500' rows='5'></textarea>"; ?>
									</div>
									<!-- Cast -->
									<div class="form-group w-100">
										<label for="exampleFormControlSelect1">Cast</label><br>
										<select multiple class="selectpicker w-100" name='cast[]' id="exampleFormControlSelect1" data-live-search="true" data-actions-box="true" title="Escolha os atores">
											<?php
												$query = "SELECT * FROM celeb INNER JOIN c_j WHERE c_j.job_id = 2 ORDER BY name ASC";
												$stm = $db->prepare($query);
												$stm->execute();
												while ($row = $stm->fetch()){
													$nick = $row['nick'];
													$id = $row['id'];
													print "<option value='$id'>$nick</option>";
												}								
											?>
										</select>
									</div>
									<!-- Trailer -->
									<div class="form-group w-100">
										<label for="exampleInputEmail1">Trailer</label>
										<input class='form-control' name='trailer' type='text' placeholder="URL do vídeo após 'youtube.com/watch?v='"/>
									</div>
								</div>
						<?php } ?>
						<!-- Hidden -->
							<?php echo "<input type='text' name='user_account' value='$user_account' hidden/>"; ?>
							<?php echo "<input name='register_date' value='$register_date' hidden/>"; ?>
						<div class="row justify-content-center">
							<button class="btn btn-dark justify-content-center" type="submit">Cadastrar</button>
						</div>						
					</form>
				</div>
			</div>
			<div class="col-4 p-4 m-1 bg-light text-dark rounded text-center">
				<h3 class='font-weight-bold'>Sugestões de Cadastros</h3>
				<h4>Em Breve</h4>
				<div>
					<?php
						$url_sug = file_get_contents("https://api-content.ingresso.com/v0/templates/soon");
						$json_sug = json_decode($url_sug, true);
						$limit = count($var);
						foreach ($json_sug as $ar){;
							$t = $ar['title'];
							$o = $ar['originalTitle'];

							$query = "SELECT * FROM movies WHERE title = '$t' AND year = 2019";
							$stm = $db->prepare($query);
							$stm->execute();
							if ($row = $stm->fetch()){
							} else {
								$array = explode(" ", $o);
								$n_palavras = count ($array);
								$tit = '';
								for($i = 0; $i < $n_palavras; $i++){
									if($i != 0){
										$tit = $tit.'+'.$array[$i];
									}else{
										$tit = $array[$i];
									}
								}	
								echo "<a href='https://gomoodie.com/adm/movie/index.php?title=$tit&year=2019'>$t</a><br>";
							}
						}
					?>
				</div>
				<h4>Estreias</h4>
				<div>
					<?php
						$url_sug = file_get_contents("https://api-content.ingresso.com/v0/templates/nowplaying");
						$json_sug = json_decode($url_sug, true);
						foreach ($json_sug as $ar){
							$t = $ar['title'];
							$o = $ar['originalTitle'];
							$images = $ar['images'];

							$query = "SELECT * FROM movies WHERE title = '$t' AND year = 2019";
							$stm = $db->prepare($query);
							$stm->execute();
							if ($row = $stm->fetch()){
							} else {
								$array = explode(" ", $o);
								$n_palavras = count ($array);
								$tit = '';
								for($i = 0; $i < $n_palavras; $i++){
									if($i != 0){
										$tit = $tit.'+'.$array[$i];
									}else{
										$tit = $array[$i];
									}
								}	
								echo "<a href='https://gomoodie.com/adm/movie/index.php?title=$tit&year=2019'>$t</a><br>";
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
	<script>
		$('.selectpicker').selectpicker();
	</script>
</body>
</html>