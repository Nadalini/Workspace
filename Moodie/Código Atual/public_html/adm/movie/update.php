<?php
	$altura_nova = 1500;

	$movieId = $_POST['movieId'];
	$movieName = $_POST['movieName'];
	$movieOrigName = $_POST['movieOrigName'];
	$movieCountry = $_POST['movieCountry'];
	$movieGenre = $_POST['movieGenre'];
	$movieDirector = $_POST['movieDirector'];
	$movieTrailer = $_POST['movieTrailer'];
	$movieDate = $_POST['movieDate'];
	$movieDuration = $_POST['movieDuration'];
	$movie_plot = $_POST['movie_plot'];
	$movie_release = $_POST['movie_release'];
	$movie_cast = $_POST['movie_cast'];
	
	include_once "../../bd.php";
	
	$query = "UPDATE movie SET movieName=?,movieOrigName=?,movieCountry=?,movieGenre=?,movieDirector=?,movieTrailer=?,movieDate=?, movieDuration=?, movie_plot=?, movie_release=?, movie_cast=? WHERE movieId=?";
			
	$stm = $db->prepare($query);
	$stm->bindParam(1, $movieName);
	$stm->bindParam(2, $movieOrigName);
	$stm->bindParam(3, $movieCountry);
	$stm->bindParam(4, $movieGenre);
	$stm->bindParam(5, $movieDirector);
	$stm->bindParam(6, $movieTrailer);
	$stm->bindParam(7, $movieDate);
	$stm->bindParam(8, $movieDuration);
	$stm->bindParam(9, $movie_plot);
	$stm->bindParam(10, $movie_release);
	$stm->bindParam(11, $movie_cast);
	$stm->bindParam(12, $movieId);
	
	if($stm->execute()) {

		if ( isset( $_FILES[ 'moviePoster' ][ 'name' ] ) && $_FILES[ 'moviePoster' ][ 'error' ] == 0 ) {
		    echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'moviePoster' ][ 'name' ] . '</strong><br />';
		    echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'moviePoster' ][ 'type' ] . ' </strong ><br />';
		    echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'moviePoster' ][ 'tmp_name' ] . '</strong><br />';
		    echo 'Seu tamanho é: <strong>' . $_FILES[ 'moviePoster' ][ 'size' ] . '</strong> Bytes<br /><br />';

			$query = "SELECT * FROM movie WHERE movieId = ?";
			$stm = $db -> prepare($query);
			$stm -> bindParam(1,$movieId);
			if ($stm -> execute()) {
				if ($row = $stm -> fetch()) {
					$moviePoster = $row['moviePoster'];
					unlink("/adm/movie/img/$moviePoster");
				}
			}

		    $arquivo_tmp = imagecreatefromjpeg($_FILES[ 'moviePoster' ][ 'tmp_name' ]);
			$nome = $_FILES[ 'moviePoster' ][ 'name' ];
			
			$largura_original = imagesx($arquivo_tmp);
			$altura_original = imagesy($arquivo_tmp);
			$largura_nova = intval( ( $largura_original * $altura_nova ) / $altura_original );
			$nova_imagem = imagecreatetruecolor( $largura_nova, $altura_nova );
			imagecopyresampled( $nova_imagem, $arquivo_tmp, 0, 0, 0, 0, $largura_nova, $altura_nova, $largura_original, $altura_original );
		 
		    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
		 
		    $extensao = strtolower ( $extensao );
		 
		    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {

		        $novoNome = uniqid ( time () ) . '.' . $extensao;
		 
		        // Concatena a pasta com o nome
		        $destino = 'img/' . $novoNome;
		 
				// tenta mover o arquivo para o destino
				
		        if ( @imagejpeg($nova_imagem, $destino)){
		            echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
					
					$query = "UPDATE movie SET moviePoster=? WHERE movieId=?";
			
					$stm = $db->prepare($query);
					$stm->bindParam(1, $novoNome);
					$stm->bindParam(2, $movieId);
					
					if($stm->execute()) {		
						header("location:profile.php?movieId=$movieId");		
					}
					else {
						 echo 'Erro ao salvar nome do arquivo.<br />';
					}
				}
		    }
		    else
		        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
		}

		header("location:profile.php?movieId=$movieId");

	} else {
		print "<p>Erro ao atualizar filme!</p>";
		print_r($stm->errorInfo());
		print "<a href='edit.php'>Voltar</a>";
	}	
?>