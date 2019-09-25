<?php
	$name = $_POST['name'];
	
	include_once "../../bd.php";
	
	$query = "INSERT INTO genre(name) VALUES (?)";
	$stm = $db->prepare($query);
	$stm->bindParam(1, $name);
	
	if($stm->execute()){
		header('location:index.php');
	}
	else{
		print "<p>Erro ao inserir</p>";
		print_r($stm->errorInfo());
	}
?>
