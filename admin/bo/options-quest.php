<?php require_once"../req/connect.php";require_once"../inc/functions.php";
	$id_cat=scriptReplace($_GET['d']);
	if($id_cat){
		$quest_options="$t9<option value='' title='Sélectionnez la question...'>...[question]...</option>\n";
		$req=$data->query("SELECT ID_Question,question FROM v_dom_cat_quest WHERE (ID_Categorie=$id_cat AND visible=1) ORDER BY question,ID_Question ASC");
		while($line_n=$req->fetch()){
			$info=$line_n['ID_Question'].": ".infoReplace(utf8_encode($line_n['question']));
			$quest_options.="$t9<option value='".$line_n['ID_Question']."' title='$info'>".utf8_encode($line_n['question'])."</option>\n";
		}$req->closeCursor();
	}else{$quest_options="$t9<option value='' title='Sélection de question...'></option>\n";}
	
echo $quest_options; // résultat à afficher par la fonction changeQst dans les formulaires
?>
