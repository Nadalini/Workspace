<?php
// Querys para saber o número de Assistidos, Seguidores e Seguindo
$user_library = "SELECT COUNT(statusId) AS watched FROM statusmovie WHERE user_account = ?";
$stm = $db -> prepare($user_library);
$stm->bindParam(1,$user_account);
if ($stm -> execute()) {
    if ($row = $stm -> fetch()) {
	    $watched = $row['watched'];
	}
}
$user_following = "SELECT COUNT(user_account) AS following FROM follow WHERE user_account = ?";
$stm = $db -> prepare($user_following);
$stm->bindParam(1,$user_account);
if ($stm -> execute()) {
	if ($row = $stm -> fetch()) {
		$following = $row['following'];
	}
}
$user_followed = "SELECT COUNT(following) AS followed FROM follow WHERE following = ?";
$stm = $db -> prepare($user_followed);
$stm->bindParam(1,$user_account);
if ($stm -> execute()) {
	if ($row = $stm -> fetch()) {
		$followed = $row['followed'];
	}
}
?>