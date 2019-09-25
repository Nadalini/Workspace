<?php
	include_once "../general/url.php";
	session_start();
	if(empty($_SESSION["account"])){
		header("Location:$URL/user/login/login.php");
	}
?>