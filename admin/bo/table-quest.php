<?php require_once"req/connect.php";
	$AUCUN="Aucune question n'est enregistrée dans la base de données.";
	$hall_class=($compact)?"compact":"";

	$count=$data->query("SELECT count(*) FROM v_dom_cat_quest WHERE ID_Question IS NOT NULL")->fetchColumn(); // on récupère le nombre de questions en comptant le nombre de lignes dans la table 'questions'

	$hall="$t4<div class='tableau'>\n$t5<table id='hall' class='$hall_class'><caption>$count $hall_title".addFormButton('Créer une nouvelle question')."</caption>\n";

	$TOTALCOLS=9;$hall.="$t6<tr><th>Domaine</th> <th>Catégorie</th> <th>ID</th> <th>Question</th> <th>Bonne réponse</th> <th>Réponse fausse #1</th> <th>Réponse fausse #2</th> <th>Réponse fausse #3</th> <th>Dernière modification</th>";
	if($admin && !$compact){$TOTALCOLS++;$hall.="<th>Voir</th>";}
	$hall.="</tr>\n$t6<tr class='tr-separ'></tr>\n";
	
	if($count){
 		initIDs();
		$req=$data->query("SELECT * FROM v_dom_cat_quest WHERE ID_Question IS NOT NULL ORDER BY label_domaine,ID_Domaine,label_categorie,ID_Categorie,question,ID_Question ASC");
		for($n=1;$line_n=$req->fetch();$n++){
			$ID_qst=$line_n['ID_Question'];
			$hall.=separByID($line_n['ID_Categorie'],"cat").separByID($line_n['ID_Domaine'],"dom");
			$hall.="$t6<tr>";
			$hall.="<th class='th-dom$class_dom'>".utf8_encode($line_n['label_domaine'])."</th>";
			$hall.="<th class='th-cat$class_cat'>".utf8_encode($line_n['label_categorie'])."</th>";
			$hall.="<td class='td-id$class_cat'>$ID_qst</td>";
			$hall.="<th class='th-main$class_cat'>".utf8_encode($line_n['question'])."</th>";
			$hall.="<td class='good$class_cat'>".utf8_encode($line_n['rep_1'])."</td>";
			$hall.="<td class='bad$class_cat'>".utf8_encode($line_n['rep_2'])."</td>";
			$hall.="<td class='bad$class_cat'>".utf8_encode($line_n['rep_3'])."</td>";
			$hall.="<td class='bad$class_cat'>".utf8_encode($line_n['rep_4'])."</td>";
			$hall.="<td class='td$class_cat'>".formatDate($line_n['date'])."</td>";
			$hall.=checkbox($n,$ID_qst,$ID_qst)."</tr>\n"; // affiche ou non la case à cocher Voir et définit son état, et fin de la ligne n
		}$req->closeCursor();
	}else{
		$hall.="$t6<tr><td class='td-none' colspan='$TOTALCOLS'>$AUCUN</td></tr>\n"; // ... on affiche un message d'information
	}
	$hall.="$t6<tr class='tr-separ-dom'><td colspan='$TOTALCOLS'></td></tr>\n";
	$hall.="$t5</table>\n$t4</div>\n"; // on ferme le tableau
	if($admin && !$compact){echo"$t4<script type='text/javascript'>function saveCheckState(chkid){\$.post('req/checker.php',{table:'questions',id:document.getElementById(chkid).value,visible:(document.getElementById(chkid).checked)?'1':'0'});}</script>\n";}
echo $hall;
?>
