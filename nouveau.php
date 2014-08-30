<?php include"inc/functions.php";$page_title="Nouveau recrutement";
if(sessionExist('login')){redir('quizz.php');}elseif(sessionExist('staff')){redir('selection.php');}
include"inc/opener-norc.php";
include"inc/header.php";
include"inc/nav.php";
?>
		<hr/>
		<div id='section'>
			<div id="bloc">
				<form name="auth-recrut" method="post" action="req/auth-recrut.php" enctype="multipart/form-data">
					<script type="text/javascript">
						function toggleBtn(){var vpsd=document.getElementById('pseudo').value, vmdp=document.getElementById('modpass').value;if(isAlphaNum(vpsd) && vmdp){$.ajax({url:'bo/input-next.php',dataType:'html',success:function(input){$("#btns").html(input);}});}else{$.ajax({success:function(){$("#btns").html("");}});}}
						var isAlphaNum=function(text){return(/^[A-Za-z\sàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ\d\'\.\-_]{3,30}$/.test(text));};
					</script>
<?=contentTitle("1 : Authentification du Responsable").contentDesc("Veuillez saisir votre identifiant et votre mot de passe pour vous authentifier et paramétrer une nouvelle session de recrutement.")?>
					<div></div>
					<div id="new">
						<label for="pseudo">Identifiant : </label><input id="pseudo" name="pseudo" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
						<div class="ie1em"></div>
						<label for="modpass">Mot de passe : </label><input id="modpass" name="modpass" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
					</div>
					<div id="btns"></div>
				</form>
			</div>
		</div>
		<hr/><script>(function(){document.getElementById('pseudo').focus();})()</script>
<?php include"inc/ender.php"?>