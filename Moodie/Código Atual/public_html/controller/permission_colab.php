<?php
	include_once "../url.php";

	$user_account = $_SESSION['user_account'];

	$query = "SELECT * FROM user WHERE user_account = ?";
	$stm = $db -> prepare($query);
	$stm -> bindParam(1,$user_account);
	if ($stm -> execute()) {
		if ($row = $stm -> fetch()) {
			$user_type = $row['user_type'];
		}
	}

	if($user_type < 2){
		header("Location:$URL");
	}
?>