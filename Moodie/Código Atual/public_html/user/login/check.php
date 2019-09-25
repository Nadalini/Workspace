<?php
	include_once "../../url.php";

	session_start();

	if(empty($_SESSION["account"])){
		
		header("Location:$URL/user/login/login.php");
	}
?>