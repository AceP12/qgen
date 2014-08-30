<?php
	if(isset($_POST['temps'])){$temps=$_POST['temps'];}
	if(isset($_POST['rd'])){$rd=$_POST['rd'];}
	if(isset($_POST['id'])){$id=$_POST['id'];
		require_once"connect.php";
		$last=$data->query("SELECT assoc FROM candidats WHERE ID_Candidat=$id")->fetch(); // récupère l'association du candidat en cours
		$assoc=str_split($last['assoc'],4);

		$re="";
		$count=mb_strlen($rd);
		for($i=0;$i<$count;$i++){ // convertit la valeur du choix en la réponse associée
			$fin=($i==$count-1)?"":",";
			$rs=substr($rd,$i,1);
			switch($rs){
				case "0":;
				case "5":$re.=$rs.$fin;break;
				default:$re.=substr($assoc[$i],$rs-1,1).$fin;
			}
		}
		$score=substr_count($re,"1"); // compte le nombre de 1 (synonyme de bonne réponse) dans la liste de réponses
		$bdd="UPDATE candidats SET score=$score,temps=$temps,reponses_donnees='$re' WHERE ID_Candidat=$id";
		try{$test_bdd_insert=$data->exec($bdd) or die("Erreur d\'insertion");}catch(Exception $e){die("Erreur d\'enregistrement".$e->getMessage());}
	}
?>