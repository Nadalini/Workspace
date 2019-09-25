<?php
	$list_name = $_POST['list_name'];
	$list_description = $_POST['list_description'];
	$user_account = $_POST['user_account'];
	
    include_once "../../bd/connection.php";
    include_once "../../general/url.php";
	
	$query = "INSERT INTO list (list_name, list_description, user_account) VALUES (?,?,?)";
	$stm = $db->prepare($query);
    $stm->bindParam(1, $list_name);
	$stm->bindParam(2, $list_description);
	$stm->bindParam(3, $user_account);
	
	if($stm->execute()){
		$query = "SELECT * FROM list WHERE list_name = ? AND list_description = ? AND user_account = ?";
		$stm = $db -> prepare($query);
		$stm -> bindParam(1,$list_name);
		$stm -> bindParam(2,$list_description);
		$stm -> bindParam(3,$user_account);
		if ($stm -> execute()) {
			if ($row = $stm -> fetch()) {
				$list_id = $row['list_id'];
				header("location:$url/lista/novo.php");
			}
		} else{
			print "<p>Erro ao Pesquisar</p>";
			print_r($stm->errorInfo());
		}
	} else{
		print "<p>Erro ao inserir</p>";
		print_r($stm->errorInfo());
	}
?>
