<?php include"inc/functions.php";
authentification();
// récupère le nom de fichier courant
	$page_name=currentPageFile($_SERVER['PHP_SELF']);
// en-tête de page
	$page_title="Domaines";
	include"inc/opener.php";
	// modalbox formulaire
		include"bo/form-dom.php";
	// header de page
		include"inc/header.php";
		include"inc/nav.php";
	// en-tête du contenu
		echo"<div id='section'>\n";
		echo contentTitle("Gestionnaire de Domaines");
		echo contentDesc("Ajoutez ou gérez les domaines et leur visibilité dans le tableau des scores et vos listes de choix.</p><p>Vous devez créer au moins un domaine pour pouvoir créer une catégorie, elle-même nécessaire à la création d'une question.");
		// contenu
		// tableau
			$hall_title="domaines enregistrés dans la base de données :";
			$compact="";
			include"bo/table-dom.php";
	// fin du contenu
		echo"$t4<hr/>\n$t3</div>\n";
// fin de page
	include"inc/ender.php";
?>
