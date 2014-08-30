<?php include"inc/functions.php";
authentification();
// récupère le nom de fichier courant
	$page_name=currentPageFile($_SERVER['PHP_SELF']);
// en-tête de page
	$page_title="Questionnaires";
	include"inc/opener.php";
	// modalbox formulaire
		include"bo/form-qcm.php";
	// header de page
		include"inc/header.php";
		include"inc/nav.php";
	// en-tête du contenu
		echo"<div id='section'>\n";
		echo contentTitle("Gestionnaire de Questionnaires");
		echo contentDesc("Ajoutez de nouveaux questionnaires ou gérez vos questionnaires enregistrés et leur visibilité dans vos listes de choix.");
		// contenu
		// tableau
			$hall_title="questionnaires enregistrés dans la base de données :";
			$compact="";
			include"bo/table-qcm.php";
	// fin du contenu
		echo"$t4<hr/>\n$t3</div>\n";
// fin de page
	include"inc/ender.php";
?>
