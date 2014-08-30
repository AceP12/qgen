<?php require_once"req/connect.php";
	$AUCUN="Aucune catégorie n'est enregistrée dans la base de données.";
	$hall_class=($compact)?"compact":"";

	$count=$data->query("SELECT count(*) FROM v_dom_cat WHERE ID_Categorie IS NOT NULL")->fetchColumn(); // récupère le nombre de sousdomaines en comptant le nombre de lignes dans la vue 'v_dom_sdom'
	
	$hall="$t4<div class='tableau'>\n$t5<table id='hall' class='$hall_class'><caption>$count $hall_title".addFormButton('Créer une nouvelle catégorie')."</caption>\n";

	$TOTALCOLS=4;$hall.="$t6<tr><th>Domaine</th> <th>ID</th> <th>Catégorie</th> <th>Dernière modification</th>";
	if($admin && !$compact){$TOTALCOLS++;$hall.="<th>Voir</th>";}
	$hall.="</tr>\n$t6<tr class='tr-separ'></tr>\n";
	
	if($count){
		initIDs();
		$req=$data->query("SELECT * FROM v_dom_cat WHERE ID_Categorie IS NOT NULL ORDER BY label_domaine,ID_Domaine,label_categorie,ID_Categorie ASC");
		for($n=1;$line_n=$req->fetch();$n++){
			$ID_cat=$line_n['ID_Categorie'];
			$hall.=separByID($line_n['ID_Domaine'],"dom");
			$hall.="$t6<tr>";
			$hall.="<th class='th-dom$class_dom'>".utf8_encode($line_n['label_domaine'])."</th>";
			$hall.="<td class='td-id$class_dom'>$ID_cat</td>";
			$hall.="<th class='th-main$class_dom'>".utf8_encode($line_n['label_categorie'])."</th>";
			$hall.="<td class='td$class_dom'>".formatDate($line_n['date'])."</td>";
			$class_cat=$class_dom;
			$hall.=checkbox($n,$ID_cat)."</tr>\n"; // affiche ou non les cases à cocher Voir, et fin de la ligne n
		}$req->closeCursor();
	}else{
		$hall.="$t6<tr><td class='td-none' colspan='$TOTALCOLS'>$AUCUN</td></tr>\n";
	}
	$hall.="$t6<tr class='tr-separ-dom'><td colspan='$TOTALCOLS'></td></tr>\n";
	$hall.="$t5</table>\n$t4</div>\n";
	if($admin && !$compact){echo"$t4<script type='text/javascript'>function saveCheckState(chkid){\$.post('req/checker.php',{table:'categories',id:document.getElementById(chkid).value,visible:(document.getElementById(chkid).checked)?'1':'0'});}</script>\n";}
echo $hall;
?>