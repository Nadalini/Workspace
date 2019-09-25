<?php
// Query para pegar todos dados do Usuário
$user_account = strtolower($_SESSION['account']);

$query = "SELECT * FROM user WHERE account = ?";
$stm = $db -> prepare($query);
$stm -> bindParam(1,$account);
if ($stm -> execute()) {
	if ($row = $stm -> fetch()) {
	$name = $row['name'];
	$password = $row['password'];
	$email = $row['email'];
	$user_country = $row['user_country'];
	$user_date = $row['user_date'];
	$user_photo = ($row['user_photo'] == null)? "user_padrao.jpg": $row['user_photo'];
	$user_cover = ($row['user_cover'] == null)? "cover_padrao.png": $row['user_cover'];
	$user_type = $row['user_type'];
	$user_notify = $row['user_notify'];
	}
}
?>