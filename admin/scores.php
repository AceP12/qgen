<?php include"inc/functions.php";
authentification();
// en-tête de page
	$page_title="Tableau des Scores";
	include"inc/opener.php";
	// header de page
		include"inc/header.php";
		include"inc/nav.php";
	// en-tête du contenu
		echo"<div id='section'>\n";
		echo contentTitle("Tableau des Scores");
		echo contentDesc("Voici la liste des Candidats et de leurs scores détaillés.");
	// contenu
		// tableau
			echo"$t4<div id='hallin'>\n";
				include"bo/table-score.php";
			echo"$t4</div>\n";
	// fin du contenu
		echo"$t4<hr/>\n$t3</div>\n";
// fin de page
	include"inc/ender.php";
?>
