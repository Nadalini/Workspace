<?php
	include_once "../../bd.php";

	$altura_nova = 1500;

	$register_date = $_POST['register_date'];
	$user_account = $_POST['user_account'];

	$title = $_POST['title'];
	$original_title = $_POST['original_title'];
	$poster = $_POST['poster'];
	$debut = $_POST['debut'];
	$year = $_POST['year'];
	$runtime = $_POST['runtime'];
	$plot = $_POST['plot'];
	$language = $_POST['language'];
	$country_id = $_POST['country_id'];
	$genre_id = $_POST['genre_id'];
	$director = $_POST['director'];
	$trailer = $_POST['trailer'];
	
	$query = "INSERT INTO movies (title,original_title,year,runtime,plot,language,poster,debut,trailer,user_account,register_date) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
	$stm = $db->prepare($query);
	$stm->bindParam(1, $title);
	$stm->bindParam(2, $original_title);
	$stm->bindParam(3, $year);
	$stm->bindParam(4, $runtime);
	$stm->bindParam(5, $plot);
	$stm->bindParam(6, $language);
	$stm->bindParam(7, $poster);
	$stm->bindParam(8, $debut);
	$stm->bindParam(9, $trailer);
	$stm->bindParam(10, $user_account);
	$stm->bindParam(11, $register_date);

	if($stm->execute()) {
		$query = "SELECT * FROM movies ORDER BY id DESC limit 1";
		$stm = $db->prepare($query);
		$stm->execute();
		while ($row = $stm->fetch()){
			$movie_id = $row['id'];
		}

		for ($i=0; $i<count($genre_id); $i++){
			$query = "INSERT INTO m_g (movie_id, genre_id) VALUES (?,?)";
			$stm = $db->prepare($query);
			$stm->bindParam(1, $movie_id);
			$stm->bindParam(2, $genre_id[$i]);
			
			if($stm->execute()) {
			}
			else {
				print "<p>Erro ao cadastrar Filme!</p>";
				print_r($stm->errorInfo());
				print "<a href='index.php'>Voltar</a>";
			}	
		}

		$type = 1;
		for ($i=0; $i<count($director); $i++){
			$query = "INSERT INTO m_cel (movie_id, celeb_id, job_id) VALUES (?,?,?)";
			$stm = $db->prepare($query);
			$stm->bindParam(1, $movie_id);
			$stm->bindParam(2, $director[$i]);
			$stm->bindParam(3, $type);
			
			if($stm->execute()) {
			}
			else {
				print "<p>Erro ao cadastrar Filme!</p>";
				print_r($stm->errorInfo());
				print "<a href='index.php'>Voltar</a>";
			}	
		}

		$type = 2;
		for ($i=0; $i<count($cast); $i++){
			$query = "INSERT INTO m_cel (movie_id, celeb_id, job_id) VALUES (?,?,?)";
			$stm = $db->prepare($query);
			$stm->bindParam(1, $movie_id);
			$stm->bindParam(2, $cast[$i]);
			$stm->bindParam(3, $type);
			
			if($stm->execute()) {
			}
			else {
				print "<p>Erro ao cadastrar Filme!</p>";
				print_r($stm->errorInfo());
				print "<a href='index.php'>Voltar</a>";
			}	
		}

		for ($i=0; $i<count($country_id); $i++){
			$query = "INSERT INTO m_c (movie_id, country_id) VALUES (?,?)";
			$stm = $db->prepare($query);
			$stm->bindParam(1, $movie_id);
			$stm->bindParam(2, $country_id[$i]);
			
			if($stm->execute()) {
				header("location:index.php");	
			}
			else {
				print "<p>Erro ao cadastrar Filme!</p>";
				print_r($stm->errorInfo());
				print "<a href='index.php'>Voltar</a>";
			}	
		}
	}
	else {
		print "<p>Erro ao cadastrar Filme!</p>";
		print_r($stm->errorInfo());
		print "<a href='index.php'>Voltar</a>";
	}
?>