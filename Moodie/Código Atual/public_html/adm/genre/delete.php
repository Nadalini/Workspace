<?php
	$name = $_GET['name'];
	
	include_once "../../bd.php";
	
	$query = "DELETE FROM genre WHERE name = ?";
	$stm = $db->prepare($query);
	$stm-> bindParam(1,$name);
	
	if($stm->execute()){
		header("location:index.php");
	}
	else{
		print "<p>Erro ao remover</p>";
		print_r($stm->errorInfo());
	}
?>