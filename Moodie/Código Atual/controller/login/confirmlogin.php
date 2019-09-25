<?php
    session_start();

    include_once "../bd/connection.php";
    include_once "../general/url.php";

    $user_account = $_POST['user_account'];
    $user_password = md5($_POST['user_password']);

    $query = "SELECT * FROM user WHERE user_email = ? AND user_password = ?";
    $stm = $db->prepare($query);
    $stm->bindParam(1, $user_account);
    $stm->bindParam(2, $user_password);
    $stm->execute();

    if ($row = $stm -> fetch()) { 
        $_SESSION['user_account'] = $row['user_account'];
        $_SESSION['user_type'] = $row['user_type'];
        
		header("location: $url");

    } else {
        
        $query_2 = "SELECT * FROM user WHERE user_account = ? AND user_password = ?";
        $stm_2 = $db->prepare($query_2);
        $stm_2->bindParam(1, $user_account);
        $stm_2->bindParam(2, $user_password);
        $stm_2->execute();

        if ($row_2 = $stm_2 -> fetch()) {
            $_SESSION['user_account'] = $row_2['user_account'];
            $_SESSION['user_type'] = $row_2['user_type'];
            
            header("location: $url");

        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Usuário ou Senha incorreto.</div>";
            $_SESSION['campo'] = $user_account;
            header("location:$url/login");
        }
    }
?>
