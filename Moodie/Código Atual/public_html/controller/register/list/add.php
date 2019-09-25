<?php
    include_once "../../../../controller/bd/connection.php";
    include_once "../../../../controller/general/url.php";
    
    $list_id = $_POST['list_id'];
    $movie_name = $_POST['movie_name'];

    $query = "SELECT * FROM movie WHERE movieName = ?";
    $stm = $db -> prepare($query);
    $stm -> bindParam(1,$movie_name);
    if ($stm -> execute()) {
        if ($row = $stm -> fetch()) {
            $movie_id = $row['movieId'];
        }
    } else{
		print "<p>Erro ao Pesquisar</p>";
		print_r($stm->errorInfo());
    }
	
	$query = "INSERT INTO list_movie(list_id, movie_id) VALUES (?,?)";
	$stm = $db->prepare($query);
    $stm->bindParam(1, $list_id);
    $stm->bindParam(2, $movie_id);
	
	if($stm->execute()){
		header("location:$url/lista/editar.php?l=$list_id");
	} else{
		print "<p>Erro ao inserir</p>";
		print_r($stm->errorInfo());
	}
?>
