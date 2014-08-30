<?php include"inc/functions.php";$page_title="Connexion";if(sessionExist('staff')){redir('accueil.php');}include"inc/opener-norc.php";include"inc/header.php" ?>
		<hr/>
		<div id='section'>
			<div id="bloc">
				<form name="auth-admin" method="post" action="req/auth-admin.php" enctype="multipart/form-data">
					<script type="text/javascript">
						function toggleBtn(){var vpsd=document.getElementById('pseudo').value, vmdp=document.getElementById('modpass').value;if(isAlpha(vpsd) && vmdp){$.ajax({url:'bo/input-connect.php',dataType:'html',success:function(input){$("#btns").html(input);}});}else{$.ajax({success:function(){$("#btns").html("");}});}}
						var isAlpha=function(text){return(/^[A-Za-z\sàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ\'\.\-_]{3,128}$/.test(text));}
					</script>
<?=contentTitle("Connexion à l'Administration")?>
<?=contentDesc("Veuillez vous authentifier pour accéder à l'interface d'administration")?>
					<div></div>
					<div id="new">
						<label for="pseudo">Identifiant : </label><input id="pseudo" name="pseudo" type="password" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
						<div class="ie1em"></div>
						<label for="modpass">Mot de passe : </label><input id="modpass" name="modpass" type="password" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
					</div>
					<div id="btns"></div>
				</form>
			</div>
		</div>
		<hr/><script>(function(){document.getElementById('pseudo').focus();})()</script>
<?php include"inc/ender.php"?>