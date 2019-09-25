<?php
	session_start();

	include_once "../../bd.php";

	// Query - User Profile
	include_once "../../query/user_profile.php";
	// Query - User Library
	include_once "../../query/user_library.php";
?>

<!DOCTYPE HTML>
<html lang='pt-br'>
<head>
    <meta charset="UTF-8"/>
    <script src="../js/index.js" type="text/javascript"></script>
	<title>Moodie - Cadastro de Gêneros</title>
    <link rel="stylesheet" type="text/css" href="../../css/main.css"/>
	<link rel="shortcut icon" type="image/png" href="../../image/favicon.ico"/>
    <!-- Library Imports -->
	<?php include_once "../../library/bootstrap.php"; ?>
    <!-- Importações  Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
</head>
<body>
	<div class='container-cadast' style="margin-top:20px;">
		<?php include_once "../../bar/navbar.php"; ?>
		<div class='left-bar'>
			<?php include_once "../../bar/profile.php"; ?>	
		</div>
		<div class='right-bar-cadast'>	
			<div class="box" style='padding: 20px 48px 32px 48px;margin-bottom:30px;'>		
				<p class="titulo">Cadastro</p>
				<h6 class="descricao"><b>Cadastre gêneros novos</b> no banco de dados<br>do nosso sistema.</h6>
				<form action='save.php' method='post'>
					<div class="input-group">
						<input name="name" type="text" placeholder="Nome do Gênero" maxlength="20" required/>
					</div>
					<div class="final">
						<button class="btn btn-outline-danger but" type="submit">Cadastrar</button>
					</div>          
				</form>
				<br>
				<h2 class='titulo-row' style='text-align:center;'>Listagem de Gêneros</h2>
				<?php		
					$query = 'SELECT * FROM genre ORDER BY name ASC';
					$stm = $db->prepare($query);
					
					if ($stm->execute()){
						$result = $stm->fetchAll(PDO::FETCH_ASSOC);
						foreach ($result as $row){
							$name = $row['name'];
							print "<p>$name <a href='delete.php?name=$name'>Remover</a></p>";
						}
					}
					else{
						print"<p>Erro ao listar</p>";
					}
				?>
			</div>
		</div>
	</div>	
	<link rel="stylesheet" href="../../css/nprogress.css">
	<script src="../../js/nprogress.js"></script>
	<script>
		function fnProgressBarLoading(){
			NProgress.start();
			window.addEventListener("load",function(event){
				NProgress.done();
			});
		}
		fnProgressBarLoading();
	</script>
</body>
</html>