<?php include"inc/functions.php";
session_start();
unset($_SESSION['staff']);setcookie('staff','',time()-320000000,'/');
if(sessionExist('login')){redir("quizz.php");}
// en-tête de page
	$page_title="Accueil";
	include"inc/opener-norc.php";
	// header de page
		include"inc/header.php";
		include"inc/nav.php";
	// en-tête du contenu
		echo"<div id='section'>\n";
		echo contentTitle("Bienvenue !");
		echo contentDesc("Cliquez sur Nouveau Recrutement pour sélectionner le questionnaire à soumettre.");
		// contenu
	// fin du contenu
		echo"$t4<hr/>\n$t3</div>\n";
// fin de page
	include"inc/ender.php";
?>
