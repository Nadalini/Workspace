<?php
	$list_id = $_GET['l'];
	
	include_once "../../../../controller/bd/connection.php";
    include_once "../../../../controller/general/url.php";
	
	$query = "DELETE FROM list WHERE list_id = ?";
	$stm = $db->prepare($query);
	$stm-> bindParam(1,$list_id);
	
	if($stm->execute()){
		header("location:$url/lista/novo.php");
	}
?>