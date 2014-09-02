<?php 
// en-tête de page
	$page_title="Questionnaire";
	include"../inc/opener-quizz.php";
	// en-tête du contenu
		echo"<div id='section'>\n";
	// contenu
		// formulaire
			include"bo/form-quizz.php";
	// fin du contenu
		echo"$t4<hr/>\n$t3</div>\n";
// fin de page
	include"../inc/ender.php";
?>