<?php include"inc/functions.php";
authentification();
// récupère le nom de fichier courant
	$page_name=currentPageFile($_SERVER['PHP_SELF']);
// en-tête de page
	$page_title="Candidats";
	include"inc/opener.php";
	// modalbox formulaire
		include"bo/form-candi.php";
	// header de page
		include"inc/header.php";
		include"inc/nav.php";
	// en-tête du contenu
		echo"<div id='section'>\n";
		echo contentTitle("Gestionnaire de Candidats");
		echo contentDesc("Gérez les candidats soumis aux questionnaires, ainsi que leur visibilité dans le tableau des scores");
		// contenu
		// tableau
			echo"$t4<div id='hallin'>\n";
				include"bo/table-candi.php";
			echo"$t4</div>\n";
	// fin du contenu
		echo"$t4<hr/>\n$t3</div>\n";
// fin de page
	include"inc/ender.php";
?>
