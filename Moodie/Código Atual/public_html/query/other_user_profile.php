<?php
// Query para pegar todos dados do Usuário

$query = "SELECT * FROM user WHERE user_account = ?";
$stm = $db -> prepare($query);
$stm -> bindParam(1,$following);
if ($stm -> execute()) {
	if ($row = $stm -> fetch()) {
	$other_user_name = $row['user_name'];
	$other_user_password = $row['user_password'];
	$other_user_email = $row['user_email'];
	$other_user_country = $row['user_country'];
	$other_user_date = $row['user_date'];
	$other_user_photo = $row['user_photo'];
	$other_user_cover = $row['user_cover'];
	$other_user_type = $row['user_type'];
	}
}
?>