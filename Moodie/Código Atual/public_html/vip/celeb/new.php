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
    
?>

<!DOCTYPE html>
<html lang="pt-br" >
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Cadastro de Celebridades</title>
	<link rel="shortcut icon" type="image/png" href="../../image/favicon.ico"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
	<style>.caret{display:none!important}</style>

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
<body class='bg-secondary text-white'>
    <div class='container'>
        <div class='row justify-content-center'>
            <div class="col-sm-12 col-lg-9 p-4 m-4 bg-light text-dark rounded">
                <div class="row">
                    <div class="col-12 text-center">
                        <h3>Cadastro</h3>
                        <h5>Cadastre novas <b>celebridades</b> no banco de dados<br>do nosso sistema.</h5>
                    </div>
                </div>
                <form method="post" action="save.php" enctype="multipart/form-data">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-6'>
                            <!-- Nick -->
                            <div class="form-group w-100">
                                <label for="nick">Nome Conhecido *</label>
                                <input class="form-control" id="nick" name='nick' placeholder="Nome Conhecido" type="text" required>
                            </div>
                            <!-- Name -->
                            <div class="form-group w-100">
                                <label for="name">Nome Completo *</label>
                                <input class='form-control' id='name' name='name' placeholder='Nome Completo' type='text' required>
                            </div>
                            <!-- Sex -->
                            <div class="form-group w-100">
                                <label for="sex">Sexo *</label><br>
                                <select class="selectpicker" id='sex' name="sex" title='Selecione' required>
                                    <option value='Feminino'>Feminino</option>
                                    <option value='Masculino'>Masculino</option>
                                </select>
                            </div>
                            <!-- Country -->
                            <div class="form-group w-100">
                                <label for="country">Países *</label><br>
                                <select multiple class="w-100 selectpicker" name='country_id[]' id="country" data-live-search="true" data-actions-box="true" title="Selecione" data-size="10">
                                    <?php
                                        $query = "SELECT * FROM country ORDER BY name ASC";
                                        $stm = $db->prepare($query);
                                        $stm->execute();
                                        while ($row = $stm->fetch()){
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            print "<option class='w-100' value='$id'>$name</option>";
                                        }								
                                    ?>
                                </select>
                            </div>
                            <!-- Birth -->
                            <div class="form-group w-100">
                                <label for="birth">Data de Nascimento *</label>
                                <?php echo"<input class='form-control' name='birth' type='date' value='$birth'/>";?>
                            </div>
                            <!-- Death -->
                            <div class="form-group w-100">
                                <label for="death">Data de Óbito</label>
                                <?php echo"<input class='form-control' name='death' type='date' value='$death'/>";?>
                            </div>                          
                        </div>
                        <div class='col-sm-12 col-lg-6'>
                            <div class="form-group">
                                <label for="celeb_icon">Fotos:</label>
                                <input class='form-control' id='celeb_icon' name='celeb_icon' placeholder='Ícone (URL) *' maxlength='500' type='text'/>
                            </div>
                            <div class="form-group">
                                <textarea class='form-control' name='celeb_photos' placeholder='Outras' maxlength='5000' type='text' rows='5'></textarea>
                            </div>
                            <!-- Social Networks -->
                            <div class="form-group">
                                <label for="instagram">Redes Sociais</label>
                                <input class='form-control' id='instagram' name='instagram' placeholder='Instagram' maxlength='100' type='text'/>
                            </div>
                            <div class="form-group">
                                <input class='form-control' name='twitter' placeholder='Twitter' maxlength='100' type='text'/>
                            </div>
                            <!-- Apple -->
                            <div class="form-group w-100">
                                <label for="apple">Apple *</label><br>
                                <select class="selectpicker" id='apple' name="apple" title='Selecione uma opção' required>
                                    <option value='Indefinido'>Indefinido</option>
                                    <option value='Fresh'>Fresh</option>
                                    <option value='Rotten'>Rotten</option>
                                </select>
                            </div>
                            <?php
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                            ?>                            
                            <button class="btn btn-dark justify-content-center" type="submit">Cadastrar</button>
                            <br><br>
                            <a href='index.php'>Voltar</a>                                                       
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
	<script>
		$('.selectpicker').selectpicker();
	</script>
</body>
</html>