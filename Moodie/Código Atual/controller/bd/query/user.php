<?php
    $account = strtolower($_SESSION['account']);

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

    // Querys para saber o número de Assistidos, Seguidores e Seguindo
    $user_library = "SELECT COUNT(statusId) AS watched FROM statusmovie WHERE account = ?";
    $stm = $db -> prepare($user_library);
    $stm->bindParam(1,$account);
    if ($stm -> execute()) {
        if ($row = $stm -> fetch()) {
            $watched = $row['watched'];
        }
    }
    $user_following = "SELECT COUNT(account) AS following FROM follow WHERE account = ?";
    $stm = $db -> prepare($user_following);
    $stm->bindParam(1,$account);
    if ($stm -> execute()) {
        if ($row = $stm -> fetch()) {
            $following = $row['following'];
        }
    }
    $user_followed = "SELECT COUNT(following) AS followed FROM follow WHERE following = ?";
    $stm = $db -> prepare($user_followed);
    $stm->bindParam(1,$account);
    if ($stm -> execute()) {
        if ($row = $stm -> fetch()) {
            $followed = $row['followed'];
        }
    }
?>