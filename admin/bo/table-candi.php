<?php 
$urlrel=isset($_GET['tri'])?"../":"";

require_once $urlrel."req/connect.php";
require_once $urlrel."inc/functions.php";
	$AUCUN="Aucun candidat n'est enregistré dans la base de données.";
	$hall_class="";//($compact)?"compact":"";

	$count=$data->query("SELECT count(*) FROM candidats")->fetchColumn(); // on récupère le nombre de candidats en comptant le nombre de lignes dans la table 'candidats'
	
	$trieuse="";
	$hall="";

	$TOTALCOLS=7;$hall.="$t7<tr><th>Responsable</th> <th>eMail</th> <th>ID</th> <th>Candidat</th> <th>Questions</th> <th>Réponses</th> <th>Date de participation</th>";
	if($god){$TOTALCOLS++;$hall.="<th>Gérer</th>";}
	if($admin){$TOTALCOLS++;$hall.="<th>Voir</th>";}
	$hall.="</tr>\n$t7<tr class='tr-separ'></tr>\n";
	
	if($count){ // si le nombre de candidats est supérieur à 0...
		initIDs();
		
		/* génération de la trieuse */
		$asc=(isset($_GET['asc']) && $_GET['asc']==1)?"ASC":"DESC";
		if(isset($_GET['tri'])){
			switch($_GET['tri']){
				case 2:$orderby='nom';break;
				case 3:$orderby='date';break;
				case 4:$orderby='questions_posees';break;
				case 5:$orderby='email';break;
				case 6:$orderby='visible';break;
				case 7:$orderby='responsable';break;
				default:$orderby='ID_Candidat';
			}
		}else{$orderby='ID_Candidat';}
		$trieuse="
						<input class='add' type='button' value='Trier par' onclick='trier()'/>
						<select id='tri' name='tri'>
							<option value='1'>ID</option>
							<option value='2'>Nom</option>
							<option value='3'>Date</option>
							<option value='4'>Questions</option>
							<option value='5'>eMail</option>
							<option value='6'>Visibilité</option>
							<option value='7'>Responsable</option>
						</select>
						<label for='asc'> Asc <input type='checkbox' id='asc' name='asc' value='0' onclick='this.value=this.checked?1:0;'/></label>";
		/* fin trieuse */

		$req=$data->query("SELECT * FROM candidats ORDER BY $orderby $asc"); // ... récupère toutes les données de chaque candidat en fonction du tri
		for($n=1;$line_n=$req->fetch();$n++){ // fait une boucle par ligne pour générer le contenu du tableau
			$ID_can=$line_n['ID_Candidat'];
			$hall.="$t7<tr>"; // nouvelle ligne n
			$hall.="<td class='td'>".$line_n['responsable']."</td>"; // ligne n, colonne Responsable
			$hall.="<td class='td'>".$line_n['email']."</td>"; // ligne n, colonne eMail
			$hall.="<td class='td-id'>$ID_can</td>"; // ligne n, colonne ID
			$NOM_can=utf8_encode($line_n['nom'])." ".utf8_encode($line_n['prenom']); // ligne n, colonne Nom et prénom du candidat
			$hall.="<th class='th-main'>$NOM_can</th>"; // ligne n, colonne Nom et prénom du candidat
			$hall.="<td class='th-dom'><span>".utf8_encode($line_n['questions_posees'])."</span></td>"; // ligne n, colonne questions
			$hall.="<td class='th-cat'><span>".utf8_encode($line_n['reponses_donnees'])."</span></td>"; // ligne n, colonne réponses
			$hall.="<td class='td'>".formatDate($line_n['date'])."</td>"; // ligne n, colonne Date de participation
			
			if($god){$hall.="<td class='mng'><span class='btn-trash' title='Supprimer définitivement le candidat ".str_replace('<span>non inscrit...</span>','non inscrit...',infoReplace($NOM_can))." ($ID_can) ?!' onclick='deleteCandidat($ID_can,".'"'.str_replace('<span>non inscrit...</span>','non inscrit...',infoReplace($NOM_can)).'"'.")'></span></td>";}
			$hall.=checkbox($n,$ID_can)."</tr>\n"; // affiche ou non les case à cocher Voir, et fin de la ligne n
		}$req->closeCursor();
	}else{
		$hall.="$t7<tr><td class='td-none' colspan='$TOTALCOLS'>$AUCUN</td></tr>\n";
	}
	$hall.="$t7<tr class='tr-separ-dom'><td colspan='$TOTALCOLS'></td></tr>\n";
	$hall.="$t6</table>\n$t5</div>\n";
	
	$hallhead="$t5<div class='tableau'>\n$t6<table id='hall' class='$hall_class'><caption>$count candidats enregistrés dans la base de données :</caption>\n";
	$hallhead.="$t7<tr class='trans'><td class='trieuse trans' colspan='$TOTALCOLS'>$trieuse</td></tr>\n";
	
	$scripts="$t5<script type='text/javascript'>$t6"."function trier(){var tri=document.getElementById('tri').value, asc=document.getElementById('asc').value;\$.ajax({url:'bo/table-candi.php',dataType:'html',type:'get',data:'tri='+tri+'&asc='+asc,success:function(hallin){\$('#hallin').html(hallin);}});}\n";
	if($admin){$scripts.=$t6."function saveCheckState(chkid){\$.post('req/checker.php',{table:'candidats',id:document.getElementById(chkid).value,visible:(document.getElementById(chkid).checked)?'1':'0'});}\n";}
	if($god){$scripts.=$t6."function deleteCandidat(canid,canam){if(confirm('ATTENTION !\\n\\nVous êtes sur le point de SUPPRIMER DÉFINITIVEMENT\\nle candidat \"'+canam+'\" (id '+canid+') de la base de données !\\n\\nÊtes-vous sûr(e) de vouloir continuer ?')){\$.post('req/eraser.php',{table:'candidats',id:canid});trier();}}\n";}
	$scripts.="$t5</script>\n";
	
echo $scripts.$hallhead.$hall;
?>
