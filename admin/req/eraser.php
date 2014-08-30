<?php
	if(isset($_POST['id'])){$id=$_POST['id'];}
	if(isset($_POST['table'])){$table=$_POST['table'];
		switch($table){
			case "candidats":$targetID="ID_Candidat";break;
			case "domaines":$targetID="ID_Domaine";break;
			case "categories":$targetID="ID_Categorie";break;
			case "questions":$targetID="ID_Question";break;
			case "questionnaires":$targetID="ID_Questionnaire";break;
			default:$table="";
		}
		if($table){
			$bdd="DELETE FROM $table WHERE $targetID=$id";
			require_once"connect.php";
			try{$test_bdd_insert=$data->exec($bdd) or die("Erreur d\'insertion");}catch(Exception $e){die("Erreur d\'enregistrement".$e->getMessage());}
		}
	}
?>
