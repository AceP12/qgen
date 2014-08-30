<?php require_once"connect.php";require_once"../inc/functions.php";
session_start();
$qcm=safeData($_POST['qcm']);
if(!isset($_POST['qcm'])||empty($_POST['qcm'])){redir('../selection.php');}
$pseudo=$_SESSION['staff'];
$bdd=utf8_decode("INSERT INTO candidats(responsable,prenom,id_questionnaire) VALUES ('$pseudo','<span>non inscrit...</span>',$qcm)");
try{$test_bdd_insert=$data->exec($bdd) or die("Erreur d'insertion");}catch(Exception $e){die("Erreur d'enregistrement".$e->getMessage());}
if($test_bdd_insert){redir('../inscription.php');}else{redir('../selection.php');}
?>