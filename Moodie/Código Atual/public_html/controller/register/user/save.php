<?php
	include_once "../../general/url.php";
	session_start();
	
	$signup_date = $_POST['signup_date'];
	$user_account = $_POST['user_account'];
	$user_password = md5($_POST['user_password']);
	$user_email = $_POST['user_email'];
	$user_name = $_POST['user_name'];
	$user_type = 1;
	
	include_once "../../bd/connection.php";
	
	$query = "SELECT * FROM user WHERE user_account = ?";
	$stm = $db -> prepare($query);
	$stm -> bindParam(1, $user_account);

	if ($stm -> execute()) {
		if ($row = $stm -> fetch()) {

			$_SESSION['msg'] = "<div style='width:100%;margin-top:10px;' class='alert alert-danger' role='alert'><button style='color:#721c24;' type='button' class='close' data-dismiss='alert'>&times;</button><strong>Erro!</strong> Nome de usuário já existente.</div>";
			header("location:$url/cadastro");
		
		} else {

			$query = "INSERT INTO user (user_account,user_password,user_email,user_name,user_type,signup_date) VALUES(?,?,?,?,?,?)";			
			$stm = $db->prepare($query);
			$stm->bindParam(1, $user_account);
			$stm->bindParam(2, $user_password);
			$stm->bindParam(3, $user_email);	
			$stm->bindParam(4, $user_name);
			$stm->bindParam(5, $user_type);
			$stm->bindParam(6, $signup_date);
				
			if($stm->execute()) {
				$_SESSION['user_account'] = $user_account;
				$_SESSION['user_type'] = $row['user_type'];

				header("location:$url");
			}
			else {
				$_SESSION['msg'] = "<div style='width:100%;' class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Erro!</strong> Problema na inserção de dados.</div>";
				header("location:$url/cadastro");
			}
		
		}
	}
?>