<?php require_once"req/connect.php";
	$dom_options="$t9<option value='' title='Sélectionnez le domaine...'>...[domaine]...</option>\n";
	$req=$data->query("SELECT * FROM domaines WHERE visible=1 ORDER BY label,ID_Domaine ASC");
	while($line_n=$req->fetch()){
		$info=$line_n['ID_Domaine'].": ".infoReplace(utf8_encode($line_n['label']));
		$dom_options.="$t9<option value='".$line_n['ID_Domaine']."' title='$info'>".utf8_encode($line_n['label'])."</option>\n";
	}$req->closeCursor();
?>