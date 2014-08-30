<?php include"inc/functions.php";
authentification();
// récupère le nom de fichier courant
	$page_name=currentPageFile($_SERVER['PHP_SELF']);
// en-tête de page
	$page_title="Questions";
	include"inc/opener.php";
	// modalbox formulaire
		include"bo/form-quest.php";
	// header de page
		include"inc/header.php";
		include"inc/nav.php";
	// en-tête du contenu
		echo"<div id='section'>\n";
		echo contentTitle("Gestionnaire de Questions");
		echo contentDesc("Ajoutez de nouvelles questions ou gérez les questions enregistrées et leur visibilité dans vos listes de choix.");
		// contenu
		// tableau
			$hall_title="questions enregistrées dans la base de données :";
			$compact="";
			include"bo/table-quest.php";
	// fin du contenu
		echo"$t4<hr/>\n$t3</div>\n";
// fin de page
	include"inc/ender.php";
?>
