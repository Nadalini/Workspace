<?php
    $list_movie_id = $_GET['l'];
	
    include_once "../../../../controller/bd/connection.php";
    include_once "../../../../controller/general/url.php";
    
    $query = "SELECT * FROM list_movie WHERE list_movie_id = ?";
    $stm = $db -> prepare($query);
    $stm -> bindParam(1,$list_movie_id);
    if ($stm -> execute()) {
        if ($row = $stm -> fetch()) {
            $list_id = $row['list_id'];
        }
    } else{
		print "<p>Erro ao Pesquisar</p>";
		print_r($stm->errorInfo());
    }
	
	$query = "DELETE FROM list_movie WHERE list_movie_id = ?";
	$stm = $db->prepare($query);
    $stm-> bindParam(1,$list_movie_id);
	
	if($stm->execute()){
		header("location:$url/lista/editar.php?l=$list_id");
	} else{
		print "<p>Erro ao inserir</p>";
		print_r($stm->errorInfo());
	}
?>