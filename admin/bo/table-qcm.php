<?php require_once"req/connect.php";
	$AUCUN="Aucun questionnaire n'est enregistré dans la base de données.";
	$hall_class=($compact)?"compact":"";

	$count=$data->query("SELECT count(*) FROM questionnaires")->fetchColumn(); // récupère le nombre de questionnaires

	$hall="$t4<div class='tableau'>\n$t5<table id='hall' class='$hall_class'><caption>$count $hall_title".addFormButton('Créer un nouveau questionnaire')."</caption>\n";

	$TOTALCOLS=5;$hall.="$t6<tr><th>ID</th> <th>Questionnaire</th> <th>Temps imparti</th> <th>Liste des questions</th> <th>Dernière modification</th>";
	if($admin && !$compact){$TOTALCOLS++;$hall.="<th>Voir</th>";}
	$hall.="</tr>\n$t6<tr class='tr-separ'></tr>\n";
	
	if($count){
		initIDs();
		$req=$data->query("SELECT * FROM questionnaires ORDER BY label ASC");
		for($n=1;$line_n=$req->fetch();$n++){
			$ID_qcm=$line_n['ID_Questionnaire'];
			$hall.="$t6<tr>";
			$hall.="<td class='td-id'>$ID_qcm</td>";
			$hall.="<th class='th-main'>".utf8_encode($line_n['label'])."</th>";
			$hall.="<th class='th-dom th-lite'>".utf8_encode($line_n['temps_imparti'])."<span> min</span></th>";
			$hall.="<th class='th-cat'>".utf8_encode($line_n['liste_questions'])."</th>";
			$hall.="<td class='td'>".formatDate($line_n['date'])."</td>";
			$hall.=checkbox($n,$ID_qcm,$ID_qcm)."</tr>\n"; // affichage ou non des cases à cocher + fin de la ligne n
		}$req->closeCursor();
	}else{
		$hall.="$t6<tr><td class='td-none' colspan='$TOTALCOLS'>$AUCUN</td></tr>\n"; // ... on affiche un message d'information
	}
	$hall.="$t6<tr class='tr-separ-dom'><td colspan='$TOTALCOLS'></td></tr>\n";
	$hall.="$t5</table>\n$t4</div>\n"; // on ferme le tableau
	if($admin && !$compact){echo"$t4<script type='text/javascript'>function saveCheckState(chkid){\$.post('req/checker.php',{table:'questionnaires',id:document.getElementById(chkid).value,visible:(document.getElementById(chkid).checked)?'1':'0'});}</script>\n";}
echo $hall;
?>