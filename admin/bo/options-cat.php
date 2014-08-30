<?php require_once"../req/connect.php";require_once"../inc/functions.php";
	$id_dom=scriptReplace($_GET['d']);
	if($id_dom){
		$cate_options="$t9<option value='' title='Sélectionnez la catégorie...'>...[catégorie]...</option>\n";
		$req=$data->query("SELECT ID_Categorie,label_categorie FROM v_dom_cat WHERE (ID_Domaine=$id_dom AND visible=1) ORDER BY label_categorie,ID_Categorie ASC");
		while($line_n=$req->fetch()){
			$info=$line_n['ID_Categorie'].": ".infoReplace(utf8_encode($line_n['label_categorie']));
			$cate_options.="$t9<option value='".$line_n['ID_Categorie']."' title='$info'>".utf8_encode($line_n['label_categorie'])."</option>\n";
		}$req->closeCursor();
	}else{$cate_options="$t9<option value='' title='Sélection de catégorie...'></option>\n";}

echo $cate_options; // résultat à afficher par la fonction changeCat dans les formulaires
?>
