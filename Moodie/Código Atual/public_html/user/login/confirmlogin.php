<?php
    session_start();

    include_once "../../bd.php";

    $account = $_POST['account'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stm = $db->prepare($query);
    $stm->bindParam(1, $account);
    $stm->bindParam(2, $password);
    $stm->execute();

    if ($row = $stm -> fetch()) { 
        $_SESSION['account'] = $row['account'];
        // $_SESSION['user_type'] = $row['user_type'];
        
		header("location: ../../");
    } else {
        $query_2 = "SELECT * FROM user WHERE account = ? AND password = ?";
        $stm_2 = $db->prepare($query_2);
        $stm_2->bindParam(1, $account);
        $stm_2->bindParam(2, $password);
        $stm_2->execute();

        if ($row_2 = $stm_2 -> fetch()) {
            $_SESSION['account'] = $row_2['account'];
            // $_SESSION['user_type'] = $row_2['user_type'];
            
            header("location: ../../");

        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Usuário ou Senha incorreto.</div>";
            $_SESSION['campo'] = $account;
            header("location:login.php");
        }
    }
?>
