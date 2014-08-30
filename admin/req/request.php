<?php
if(isset($_POST['formulaire'])){
	$formulaire=$_POST['formulaire'];
	require_once"../inc/functions.php";
	switch($formulaire){
		case "form-quest":
			$question=scriptReplace($_POST['new_1']);
			$bonne=scriptReplace($_POST['good_1']);
			$fausse1=scriptReplace($_POST['bad_1']);
			$fausse2=scriptReplace($_POST['bad_2']);
			$fausse3=scriptReplace($_POST['bad_3']);
		case "form-cat":
			$categorie=scriptReplace($_POST['categorie']);
		case "form-dom":
			$domaine=scriptReplace($_POST['domaine']);break;
		case "form-qcm":
			$temps=scriptReplace($_POST['tps']);
			$label_qcm=scriptReplace($_POST['qcm']);
			$liste_qcm=scriptReplace($_POST['liste_qcm']);break;
		default:$formulaire="";
	}
	switch($formulaire){
		case "form-dom":$bdd=utf8_decode("INSERT INTO domaines(label) VALUES ('$domaine')");break;
		case "form-cat":$bdd=utf8_decode("INSERT INTO categories(id_domaine,label) VALUES ('$domaine','$categorie')");break;
		case "form-quest":$bdd=utf8_decode("INSERT INTO questions(id_categorie,question,rep_1,rep_2,rep_3,rep_4) VALUES ('$categorie','$question','$bonne','$fausse1','$fausse2','$fausse3')");break;
		case "form-qcm":$bdd=utf8_decode("INSERT INTO questionnaires(label,liste_questions,temps_imparti) VALUES ('$label_qcm','$liste_qcm','$temps')");break;
		default:$bdd="";
	}
	if($bdd){
		require_once"connect.php";
		try{$test_bdd_insert=$data->exec($bdd) or die("Erreur d'insertion");}catch(Exception $e){die("Erreur d'enregistrement".$e->getMessage());}
	}else{alert("Requête invalide !");};
}
$page_name=isset($_POST['pagename'])?$_POST['pagename']:'accueil.php';
header('location:../'.$page_name);
exit();
?>