<?php
    session_start();
    include_once "../../bd.php";
    $celeb_admin = strtolower($_SESSION['user_account']);

    // Update datatime
    $fuso = new DateTimeZone('America/Sao_Paulo');
	$signup_date = new DateTime();
	$signup_date->setTimezone($fuso);
	$celeb_save = $signup_date->format('Y-m-d H:i:s');

    $celeb_name = $_POST['celeb_name'];
    $celeb_complete_name = $_POST['celeb_complete_name'];
    $celeb_sex = $_POST['celeb_sex'];
    $celeb_nationality = $_POST['celeb_nationality'];
    $celeb_country = $_POST['celeb_country'];
    $celeb_city = $_POST['celeb_city'];
    $celeb_birth = $_POST['celeb_birth'];
    $celeb_death = $_POST['celeb_death'];
    $celeb_icon = $_POST['celeb_icon'];
    $celeb_photos = $_POST['celeb_photos'];
    $celeb_instagram = $_POST['celeb_instagram'];
    $celeb_twitter = $_POST['celeb_twitter'];
    $celeb_apple = $_POST['celeb_apple'];

    $query = "INSERT INTO celeb (celeb_name, celeb_complete_name, celeb_sex, celeb_nationality, celeb_country, celeb_city, celeb_birth, celeb_death, celeb_icon, celeb_photos, celeb_instagram, celeb_twitter, celeb_apple, celeb_save, celeb_admin) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stm = $db->prepare($query);
    $stm->bindParam(1, $celeb_name);
    $stm->bindParam(2, $celeb_complete_name);
    $stm->bindParam(3, $celeb_sex);
    $stm->bindParam(4, $celeb_nationality);
    $stm->bindParam(5, $celeb_country);
    $stm->bindParam(6, $celeb_city);
	$stm->bindParam(7, $celeb_birth);
	$stm->bindParam(8, $celeb_death);
	$stm->bindParam(9, $celeb_icon);
	$stm->bindParam(10, $celeb_photos);
	$stm->bindParam(11, $celeb_instagram);
    $stm->bindParam(12, $celeb_twitter);
    $stm->bindParam(13, $celeb_apple);
    $stm->bindParam(14, $celeb_save);
    $stm->bindParam(15, $celeb_admin);
    
    if($stm->execute()) {
        $_SESSION['msg'] = "<div class='alert alert-success' role='success' style='margin:1rem 0;'>Celebridade cadastrada com sucesso!</div>";
        header("location:new.php");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='margin:1rem 0;>Erro ao cadastrar celebridade!</div>";
		echo "<p>Erro ao cadastrar Filme!</p>";
        header("location:new.php");  
	}
?>