<?php $user_account = strtolower($user_account); ?>

<div class='box'>
	<?php echo "<a href='https://gomoodie.com/user/profile.php'><img class='personal-photo' src='https://gomoodie.com/user/img/photo/$user_photo'></a>"; ?>
	<?php echo "<a href='https://gomoodie.com/user/profile.php'><img class='personal-cover' src='https://gomoodie.com/user/img/cover/$user_cover'></a>"; ?>
	<div class='personal-inf'>
		<?php echo "<a class='personal-inf-name' href='https://gomoodie.com/user/profile.php'>".$user_name."</a><br>"; ?>
		<?php echo "<a class='personal-inf-account' href='https://gomoodie.com/user/profile.php'>@".$user_account."</a><br>"; ?>
		<div class='dados-bar'>
			<div class='row' style='font-size:15px;'>
				<a class='col-4' href='https://gomoodie.com/user/profile.php'>Assistidos</a>
				<a class='col-4' href='https://gomoodie.com/user/seguindo.php'>Seguindo</a>
				<a class='col-4' href='https://gomoodie.com/user/seguidores.php'>Seguidores</a>
			</div>
			<div class='row'>
				<a class='col-4' href='https://gomoodie.com/user/profile.php'><?php echo $watched;?></a>
				<a class='col-4' href='https://gomoodie.com/user/seguindo.php'><?php echo $following;?></a>
				<a class='col-4' href='https://gomoodie.com/user/seguidores.php'><?php echo $followed;?></a>
			</div>
		</div>
	</div>
</div>

<!-- <iframe style='margin-top:10px;' src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fgomoodie&tabs=timeline&width=300&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="350" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> -->