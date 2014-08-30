<?php include"inc/functions.php";
authentification();
// en-tête de page
	$page_title="Accueil";
	include"inc/opener.php";
	// header de page
		include"inc/header.php";
		include"inc/nav.php";
	// en-tête du contenu
		echo"<div id='section'>\n";
		echo contentTitle("Bienvenue ".$_SESSION['staff']." !");
		echo contentDesc("Vous êtes ici sur l'interface d'administration de vos questionnaires de recrutement.</p><p>Vous pouvez créer vos domaines, catégories, questions et questionnaires, ainsi que voir les candidats ayant participé et consulter leurs scores.");
		// contenu
	// fin du contenu
		echo"$t4<hr/>\n$t3</div>\n";
	// pied de page
//		include"inc/footer.php";
// fin de page
	include"inc/ender.php";
?>
