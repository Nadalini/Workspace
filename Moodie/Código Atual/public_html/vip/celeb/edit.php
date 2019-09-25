<?php
    // Verifica se o usuário está logado
    include_once "../../user/login/check.php";
    // Se sim, inicia a sessão
    session_start();
    include_once "../../bd.php";
    // Verifica se o usuário é colaborador
    include_once "../../controller/permission_colab.php";

    // Query - Celeb
    $celeb_id = $_GET['celeb_id'];

    $query_c = "SELECT * FROM celeb WHERE celeb_id = ?";
    $stm_c = $db -> prepare($query_c);
    $stm_c->bindParam(1,$celeb_id);
    if ($stm_c -> execute()) {
        if ($row_c = $stm_c -> fetch()) {
            $celeb_name = $row_c['celeb_name'];
            $celeb_complete_name = $row_c['celeb_complete_name'];
            $celeb_sex = $row_c['celeb_sex'];
            $celeb_nationality = $row_c['celeb_nationality'];
            $celeb_country = $row_c['celeb_country'];
            $celeb_city = $row_c['celeb_city'];
			$celeb_birth = $row_c['celeb_birth'];
			$celeb_death = $row_c['celeb_death'];
            $celeb_icon = $row_c['celeb_icon'];
            $celeb_photos = $row_c['celeb_photos'];
            $celeb_instagram = $row_c['celeb_instagram'];
            $celeb_twitter = $row_c['celeb_twitter'];
            $celeb_apple = $row_c['celeb_apple'];
            $celeb_visitor = $row_c['celeb_visitor'];
            $celeb_save = $row_c['celeb_save'];
            $celeb_update = $row_c['celeb_update'];
            $celeb_admin = $row_c['celeb_admin'];
		}
    }    

    // Query - User Profile
	include_once "../../query/user_profile.php";
	// Query - User Library
    include_once "../../query/user_library.php";
?>

<!DOCTYPE html>
<html lang="pt-br" >
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo "<title>$celeb_name - Editar</title>"; ?>
    <link rel="stylesheet" type="text/css" href="../../css/main.css"/>
	<link rel="shortcut icon" type="image/png" href="../../image/favicon.ico"/>
    <!-- Library Imports -->
	<?php include_once "../../library/bootstrap.php"; ?>
    <!-- Importações  Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <!-- Google AdSense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-1375441582024377",
        enable_page_level_ads: true
      });
    </script>
    <style>
        #celeb_country{float:none}
        #celeb_sex{float:none}
        #celeb_apple{float:none}
        .required{color:red}
        .row{margin:0!important;}
    </style>
</head>
<body>
    <div class='row justify-content-center'>
		<div class='col-sm-12 col-lg-7'>
            <?php include_once "../../bar/navbar.php"; ?>
        </div>
    </div>
    <div class='row justify-content-center'>
        <div class="col-sm-12 col-lg-7" style='padding:10px!important;'>
            <div class='box' style='padding:15px 30px;'>
                <p class="titulo">Cadastro</p>   
                <h6 class="descricao">Cadastre novas <b>celebridades</b> no banco de dados<br>do nosso sistema.</h6>
                <form method="post" action="update.php" enctype="multipart/form-data">
                    <div class='row'>                        
                        <div class='col-sm-12 col-lg-6'>                        
                            <div class='row' style='margin-right:-15px;margin-left:-15px;'>
                                <div class='col-lg-6' style='padding:0px;'>
                                    <div class="form-group">
                                        <?php echo "<img src='$celeb_icon' class='to_fit' style='width:100%;height:158px;border:1px solid #ced4da;'/>"; ?>
                                    </div>
                                </div>
                                <div class='col-lg-6' style='padding-right:0px;'>
                                    <div class="form-group">
                                        <label for="celeb_name">Celeb Id:</label>
                                        <?php echo "<input value='$celeb_id' class='form-control' id='celeb_id' name='celeb_id' type='text' readonly>";?>
                                    </div>
                                    <div class="form-group">
                                        <label for="celeb_name">Nome Conhecido: <b>*</b></label>
                                        <?php echo "<input value='$celeb_name' class='form-control' id='celeb_name' name='celeb_name' type='text'>";?>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="celeb_name">Nome Completo: <b>*</b></label>
                                <?php echo "<input value='$celeb_complete_name' class='form-control' id='celeb_complete_name' name='celeb_complete_name' placeholder='Nome Completo' type='text' required>";?>
                            </div>
                            <div class="form-group">
                                <label for="celeb_nationality">Nacionalidade: <b>*</b></label>
                                <?php echo "<input value='$celeb_nationality' class='form-control' id='celeb_nationality' name='celeb_nationality' placeholder='Nacionalidade' type='text' required>";?>
                            </div>
                            <div class="form-group">
                                <label for="celeb_sex">Sexo: <b>*</b></label>
                                <select class="form-control" id='celeb_sex' name="celeb_sex" required>                                    
                                    <?php echo "<option value='$celeb_sex' selected>$celeb_sex</option>";?>
                                    <option value='null' disabled></option>
                                    <option value='Feminino'>Feminino</option>
                                    <option value='Masculino'>Masculino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="celeb_country">País Natal: <b>*</b></label>
                                <select class="form-control" id='celeb_country' name="celeb_country" required>                                    
                                    <?php echo "<option value='$celeb_country' selected>$celeb_country</option>";?>
                                    <option value='' disabled></option>";
                                    <?php                                                                            
                                        $query = "SELECT * FROM country ORDER BY countryName ASC";
                                        $stm = $db->prepare($query);
                                        $stm->execute();

                                        while ($row = $stm->fetch()){
                                            $countryName = $row['countryName'];
                                            print "<option value='$countryName'>$countryName</option>";
                                        }							
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="celeb_city">Cidade Natal: <b>*</b></label>
                                <?php echo "<input value='$celeb_city' class='form-control' id='celeb_city' name='celeb_city' placeholder='Nacionalidade' type='text' required>";?>
                            </div>
                            <div class="form-group">
                                <label for="celeb_birth">Data de Nascimento: <b>*</b></label>
                                <?php echo "<input value='$celeb_birth' class='form-control' id='celeb_birth' name='celeb_birth' type='date' required/>";?>
                            </div>
                            <div class="form-group">
                                <label for="celeb_death">Data de Óbito:</label>
                                <?php echo "<input value='$celeb_death' class='form-control' id='celeb_death' name='celeb_death' type='date'/>";?>
                            </div>
                            <div class="form-group">
                                <label for="celeb_icon">Fotos:</label>
                                <?php echo "<input value='$celeb_icon' class='form-control' id='celeb_icon' name='celeb_icon' placeholder='Ícone (URL) *' maxlength='500' type='text'/>";?>
                            </div>
                            <div class="form-group">
                                <?php echo "<textarea class='form-control' name='celeb_photos' placeholder='Outras' maxlength='5000' type='text' rows='5'>$celeb_photos</textarea>";?>
                            </div>                      
                        </div>
                        <div class='col-sm-12 col-lg-6'>                                                       
                            <div class="form-group">
                                <label for="celeb_instagram">Redes Sociais:</label>
                                <?php echo "<input value='$celeb_instagram' class='form-control' id='celeb_instagram' name='celeb_instagram' placeholder='Instagram' maxlength='100' type='text'/>";?>
                            </div>
                            <div class="form-group">
                                <?php echo "<input value='$celeb_twitter' class='form-control' name='celeb_twitter' placeholder='Twitter' maxlength='100' type='text'/>";?>
                            </div>
                            <div class="form-group">
                                <label for="celeb_apple">Apple: <b>*</b></label>
                                <select class="form-control" id='celeb_apple' name="celeb_apple" required>                                    
                                    <?php echo "<option value='$celeb_apple' selected>$celeb_apple</option>";?>
                                    <option value='null' disabled></option>
                                    <option value='Indefinido'>Indefinido</option>
                                    <option value='Fresh'>Fresh</option>
                                    <option value='Rotten'>Rotten</option>
                                </select>
                            </div>                            
                            <?php  
                            //Query - Direção
                            $query = "SELECT * FROM movie WHERE movieDirector LIKE '%$celeb_name%' ORDER BY movieDate DESC";
                            $stm = $db -> prepare($query);
                            if ($stm -> execute()) {
                                if ($row = $stm -> fetch()) {
                                    echo "<div class='form-group'><label>Direção:</label><p>";
                                    $movieName = $row['movieName'];
                                    echo "$movieName<br>";
                                    while ($row = $stm -> fetch()){
                                        $movieName = $row['movieName'];
                                        echo "$movieName<br>";
                                    }
                                    echo "</p></div>";
                                }
                            }
                            ?>                              
                            <?php  
                            //Query - Atuação
                            $query = "SELECT * FROM movie WHERE movie_cast LIKE '%$celeb_name%' ORDER BY movieDate DESC";
                            $stm = $db -> prepare($query);
                            if ($stm -> execute()) {
                                if ($row = $stm -> fetch()) {
                                    echo "<div class='form-group'><label>Atuação:</label><p>";
                                    $movieName = $row['movieName'];
                                    echo "$movieName<br>";
                                    while ($row = $stm -> fetch()){
                                        $movieName = $row['movieName'];
                                        echo "$movieName<br>";
                                    }
                                    echo "</p></div>";
                                }
                            }
                            ?>
                            <div class="form-group">
                                <label for="celeb_save">Salvo em:</label>
                                <?php echo "<input value='$celeb_save' class='form-control' id='celeb_save' type='text' readonly>";?>
                            </div>
                            <div class="form-group">
                                <label for="celeb_update">Último update:</label>
                                <?php echo "<input value='$celeb_update' class='form-control' id='celeb_update' type='text' readonly>";?>
                            </div>
                            <div class="form-group">
                                <label for="celeb_visitor">Número de visitantes:</label>
                                <?php echo "<input value='$celeb_visitor' class='form-control' id='celeb_visitor' type='text' readonly>";?>
                            </div>
                            <div class="form-group">
                                <label for="celeb_admin">Administrador:</label>
                                <?php echo "<input value='$celeb_admin' class='form-control' id='celeb_admin' type='text' readonly>";?>
                            </div>
                            <?php
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                            ?>
                            <button class="btn btn-outline-danger but" type='submit'>Atualizar!</button>
                            <br><br>
                            <?php echo "<a href='profile.php?celeb_id=$celeb_id'>Perfil</a>"; ?>
                            <a href='index.php'>Voltar</a>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>