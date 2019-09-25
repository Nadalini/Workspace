<?php
	include_once "../general/url.php";
	session_start();

	if (isset($_SESSION['user_account'])) {
		unset($_SESSION['user_account']);
	}
	header("location:$url");
?>
