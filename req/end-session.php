<?php require_once"connect.php";require_once"../inc/functions.php";
if(!sessionExist('login')){redir('../nouveau.php');}
if(isset($_POST['ecoule'])){$temps=$_POST['ecoule'];}
if(isset($_POST['idcan'])){$id=$_POST['idcan'];
	$rd=$data->query("SELECT score FROM candidats WHERE ID_Candidat=$id")->fetch(); // récupère le score du candidat en cours
	$score=$rd['score']?$rd['score']:0; // si le score a été initialisé la variable prend sa valeur, sinon la valeur 0 lui est affectée
	
	$bdd="UPDATE candidats SET temps=$temps,score=$score,assoc='0' WHERE ID_Candidat=$id";
	try{$test_bdd_insert=$data->exec($bdd) or die("Erreur d'insertion");}catch(Exception $e){die("Erreur d'enregistrement".$e->getMessage());}
	
	session_unset();session_destroy();
	setcookie('login','',time()-320000000,'/');setcookie('currq','',time()-320000000,'/');
}
redir('../gameover.php');
?>