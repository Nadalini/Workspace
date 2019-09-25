<?php
    // Verifica se o usuário está logado
    include_once "../../user/login/check.php";
    // Se sim, inicia a sessão
    session_start();
    include_once "../../bd.php";
    // Verifica se o usuário é colaborador
    // include_once "../../controller/permission_colab.php";

    // Query - User Profile
	include_once "../../query/user_profile.php";
	// Query - User Library
    include_once "../../query/user_library.php";

    $fuso = new DateTimeZone('America/Sao_Paulo');
	$signup_date = new DateTime();
	$signup_date->setTimezone($fuso);
    $hoje = $signup_date->format('Y-m-d H:i:s');
    list($ano, $mes, $resto) = explode("-", $hoje);    

    $cont = 0;
    $query = "SELECT * from celeb WHERE celeb_admin = '$user_account' ORDER BY celeb_id DESC";
    $stm = $db -> prepare($query);
    if ($stm -> execute()){
        while ($row = $stm -> fetch()){
            $celeb_save = $row['celeb_save'];
            list($anov, $mesv, $restov) = explode("-", $celeb_save);
            if ($mesv == $mes){
                $cont ++;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br" >
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Celebridades</title>
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
        .table{margin:0px;}
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
        <div class="col-sm-12 col-lg-7">
            <div class='box' style='padding:15px'>
                <div class='row justify-content-center'>
                    <div class="col-sm-12 col-lg-7">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan='3'>Listagem de Celebs</th>
                                </tr>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                                              
                                <?php
                                    $query = "SELECT * FROM celeb ORDER BY celeb_id DESC";
                                    $stm = $db -> prepare($query);
                                    if ($stm -> execute()){
                                        while ($row = $stm -> fetch()){
                                            $celeb_id = $row['celeb_id'];
                                            $celeb_name = $row['celeb_name'];
                                            $celeb_photos = $row['celeb_photos'];
                                            if ($celeb_photos == ''){
                                                $color = 'red';
                                            } else{
                                                $color = '';
                                            }
                                            echo "<tr style='color:$color'><td>$celeb_id</td>";
                                            echo "<td><a href='profile.php?celeb_id=$celeb_id'>$celeb_name</a></td>";
                                            echo "<td><a href='edit.php?celeb_id=$celeb_id'>Editar</a></td></tr>";
                                        }
                                    }
                                ?>                                                   
                            </tbody>
                        </table>
                    </div>
                    <div class='col-sm-12 col-lg-5'>
                        <?php
                        if($cont >= 30){
                            echo "<div class='alert alert-success' role='alert' style='margin:1rem 0;'>Você já cadastrou as 30 celebs obrigatórias do mês. <strong>Parabéns!</strong></div>";
                        } else {
                            $r = 30 - $cont;
                            echo "<div class='alert alert-danger' role='alert' style='margin:1rem 0;'>Faltam <strong>$r</strong> celebs para você cumprir a meta do mês!</div>";
                        } ?>
                        <div class="form-group">
                            <?php echo "<img src='https://media.giphy.com/media/l2JJpfLOjyESkbAyc/giphy.gif' class='to_fit' style='width:100%;height:158px;border:1px solid #ced4da;'/>"; ?>
                        </div>
                        <label>Adicione novas celebridades:</label><br>
                        <a href='new.php'>Cadastro aqui!</a>
                        <table class="table table-bordered" style='margin-top:10px;'>
                            <thead>
                                <tr>
                                    <th>Feminino</th>
                                    <th>Masculino</th>                                    
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>                                              
                                <?php
                                    $query = "SELECT COUNT(celeb_id) as fem FROM celeb WHERE celeb_sex = 'Feminino'";
                                    $stm = $db -> prepare($query);
                                    if ($stm -> execute()){
                                        while ($row = $stm -> fetch()){
                                            $fem = $row['fem'];
                                            echo "<tr><td>$fem</td>";
                                        }
                                    }
                                    $query = "SELECT COUNT(celeb_id) as masc FROM celeb WHERE celeb_sex = 'Masculino'";
                                    $stm = $db -> prepare($query);
                                    if ($stm -> execute()){
                                        while ($row = $stm -> fetch()){
                                            $masc = $row['masc'];
                                            echo "<td>$masc</td>";
                                        }
                                    }                                    
                                    $query = "SELECT COUNT(celeb_id) as total FROM celeb";
                                    $stm = $db -> prepare($query);
                                    if ($stm -> execute()){
                                        while ($row = $stm -> fetch()){
                                            $total = $row['total'];
                                            echo "<td>$total</td></tr>";
                                        }
                                    }
                                ?>                                                   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>