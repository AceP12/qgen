<?php require_once"req/connect.php";
	$AUCUN="Aucun domaine n'est enregistré dans la base de données.";
	$hall_class=($compact)?"compact":"";

	$count=$data->query("SELECT count(*) FROM domaines")->fetchColumn(); // récupère le nombre de domaines'

	$hall="$t4<div class='tableau'>\n$t5<table id='hall' class='$hall_class'><caption>$count $hall_title".addFormButton('Créer un nouveau domaine')."</caption>\n";

	$TOTALCOLS=3;$hall.="$t6<tr><th>ID</th> <th>Domaine</th> <th>Dernière modification</th>";
	if($admin && !$compact){$TOTALCOLS++;$hall.="<th>Voir</th>";}
	$hall.="</tr>\n$t6<tr class='tr-separ'></tr>\n";

	if($count){
		initIDs();
		$req=$data->query("SELECT * FROM domaines ORDER BY label,ID_Domaine");
		for($n=1;$line_n=$req->fetch();$n++){
			$ID_dom=$line_n['ID_Domaine'];
			$hall.="$t6<tr>";
			$hall.="<td class='td-id'>$ID_dom</td>";
			$hall.="<th class='th-main'>".utf8_encode($line_n['label'])."</th>";
			$hall.="<td class='td'>".formatDate($line_n['date'])."</td>";
			$hall.=checkbox($n,$ID_dom)."</tr>\n"; // affiche ou non les case à cocher Voir, et fin de la ligne n
		}$req->closeCursor();
	}else{
		$hall.="$t6<tr><td class='td-none' colspan='$TOTALCOLS'>$AUCUN</td></tr>\n";
	}
	$hall.="$t6<tr class='tr-separ-dom'><td colspan='$TOTALCOLS'></td></tr>\n";
	$hall.="$t5</table>\n$t4</div>\n";
	if($admin && !$compact){echo"$t5<script type='text/javascript'>function saveCheckState(chkid){\$.post('req/checker.php',{table:'domaines',id:document.getElementById(chkid).value,visible:(document.getElementById(chkid).checked)?'1':'0'});}</script>\n";}
echo $hall;
?>
