<?php require_once"connect.php";require_once"../inc/functions.php";
$pseudo=safeData($_POST['pseudo']);
$modpass=safeData($_POST['modpass']);
if((!isset($_POST['pseudo'])||empty($_POST['pseudo']))||(!isset($_POST['modpass'])||empty($_POST['modpass']))){header("location:../connexion.php");exit();}
$sql=$data->query("SELECT count(*) FROM utilisateurs WHERE identifiant='$pseudo' AND mdp='$modpass' AND (permission='Administration + Recrutement' OR permission='Administration') AND identifiant IS NOT NULL AND NOT identifiant='' AND mdp IS NOT NULL AND NOT mdp=''")->fetchColumn();
if($sql==1){
	session_start();
	$_SESSION['staff']=$pseudo;
	setcookie('staff','',time()-320000000,'/');
	setcookie('staff',$pseudo,0,'/');
	redir('../accueil.php');
}else{redir('../connexion.php');}
?>