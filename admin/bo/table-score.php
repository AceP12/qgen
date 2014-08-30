<?php
$urlrel=(isset($_GET['tri'])||isset($_GET['dtri'])||isset($_GET['ctri']))?"../":"";
require_once $urlrel."req/connect.php";
require_once $urlrel."inc/functions.php";


	$AUCUN="Aucun participant enregistré ou visible."; // message affiché en l'absence de donnée
	$hall_class="";
	$trieuse="";
	$hall="";

	$count=$data->query("SELECT count(*) FROM candidats WHERE visible=1")->fetchColumn(); // récupère le nombre de candidats visibles en comptant le nombre de lignes dans la table 'candidats'

/* génération des colonnes et intitulés du tableau */
	$TOTALCOLS=5;$hall.="$t6<tr><th class='th-lite'>Questionnaire soumis</th>  <th>ID</th> <th>Candidat</th> <th>Score</th>"; // (3 col) crée une ligne et on ajoute les colonnes et les intitulés, 
	if($count){ // si le nombre de candidats visibles est supérieur à 0...
		$count=0; // réinitialise compteur pour afficher le nombre exact de candidats dans le tableau

		/* génération de la trieuse */
		$ascchk=(isset($_GET['asc']) && $_GET['asc']==0)?0:1;
		$dascchk=(isset($_GET['dasc']) && $_GET['dasc']==1)?1:0;
		$cascchk=(isset($_GET['casc']) && $_GET['casc']==1)?1:0;
		
		$asc=($ascchk==1)?"ASC":"DESC";
		$desc=($ascchk==1)?"DESC":"ASC";
		$dasc=($dascchk==1)?"ASC":"DESC";
		$casc=($cascchk==1)?"ASC":"DESC";
		
		if(isset($_GET['tri'])){
				$sel=$_GET['tri'];
			switch($_GET['tri']){
				case 2:$orderby="id_questionnaire $asc";break;
				case 3:$orderby="score $desc,id_questionnaire $asc,temps $asc,date $desc";break;
				case 4:$orderby="temps $asc,id_questionnaire $asc,score $desc,date $desc";break;
				case 5:$orderby="nom $asc";break;
				case 6:$orderby="date $asc";break;
				case 7:$orderby="ID_Candidat $asc";break;
				default:$orderby="id_questionnaire $asc,score $desc,temps $asc,date $desc";$sel=1;
			}
		}else{$orderby="id_questionnaire $asc,score $desc,temps $asc,date $desc";$sel=1;}
		
		$dsel=(isset($_GET['dtri']) && $_GET['dtri']==2)?2:1;
		$csel=(isset($_GET['ctri']) && $_GET['ctri']==2)?2:1;
		$domorderby=($dsel==2)?"label":"ID_Domaine";
		$catorderby=($csel==2)?"label":"ID_Categorie";
		
		$trieuse="
						<input class='add' type='button' value='Trier' onclick='trier()'/>
						<label for='tri'>Général par </label>
						<select id='tri' name='tri'>
							<option value='1'>Défaut</option>
							<option value='2'".($sel==2?" selected":"").">Questionnaire</option>
							<option value='3'".($sel==3?" selected":"").">Score</option>
							<option value='4'".($sel==4?" selected":"").">Temps</option>
							<option value='5'".($sel==5?" selected":"").">Nom</option>
							<option value='6'".($sel==6?" selected":"").">Date</option>
							<option value='7'".($sel==7?" selected":"").">ID</option>
						</select>
						<label for='asc'> Asc <input".($ascchk==1?" checked":"")." type='checkbox' id='asc' name='asc' value='$ascchk' onclick='this.value=this.checked?1:0;'/></label> | 
						
						<label for='dtri'>Domaines par </label>
						<select id='dtri' name='dtri'>
							<option value='1'>Intitulé</option>
							<option value='2'".($dsel==2?" selected":"").">ID</option>
						</select>
						<label for='dasc'> Asc <input".($dascchk==1?" checked":"")." type='checkbox' id='dasc' name='dasc' value='$dascchk' onclick='this.value=this.checked?1:0;'/></label> | 

						<label for='ctri'>Catégories par </label>
						<select id='ctri' name='ctri'>
							<option value='1'>Intitulé</option>
							<option value='2'".($csel==2?" selected":"").">ID</option>
						</select>
						<label for='casc'> Asc <input".($cascchk==1?" checked":"")." type='checkbox' id='casc' name='casc' value='$cascchk' onclick='this.value=this.checked?1:0;'/></label>";
		/* fin trieuse */
		
		
		$req=$data->query("SELECT label,ID_Domaine FROM domaines WHERE visible=1 ORDER BY $domorderby $dasc"); // récupère les données de chaque domaine visible,
		for($i=0;$line_n=$req->fetch();$i++){ // boucle pour générer les colonnes des domaines et catégories
			$array_dom[$line_n['ID_Domaine']]=$i; // associe le numéro de colonne i (débute à 0) au domaine en cours
			$array_score[$i]="-"; // crée un array compteur de bonne réponse d'index i pour l'associer au numéro de colonne i, et donc au domaine par array_dom d'index ID_domaine et de valeur i (si un domaine n'a pas été soumis à un candidat, un tiret "-" remplacera le score)
			$TOTALCOLS++;$hall.="<th class='th-lite'>".utf8_encode($line_n['label'])."</th>"; // (+1 col) crée une colonne pour le domaine en cours et son intitulé

			$countcat[$line_n['ID_Domaine']]=$data->query("SELECT count(*) FROM categories WHERE visible=1 AND id_domaine=".$line_n['ID_Domaine'])->fetchColumn(); // crée un array compteur de catégories par domaines
			$reqcat=$data->query("SELECT label,ID_Categorie FROM categories WHERE visible=1 AND id_domaine=".$line_n['ID_Domaine']." ORDER BY $catorderby $casc"); // récupère les données de chaque domaine visible,
			for($c=0;$line_c=$reqcat->fetch();$c++){ // boucle pour générer les colonnes des domaines
				$array_cat[$line_c['ID_Categorie']]=$c; // associe le numéro de colonne i (débute à 0) à la catégorie en cours
				$array_scorecat[$line_n['ID_Domaine']][$c]="-"; // crée un array compteur de bonne réponse par catégorie (si une catégorie n'a pas été soumise à un candidat, un tiret "-" remplacera le score afin de le différencier d'une catégorie pour laquelle le candidat obtiendrait un score de 0 bonne réponse)
				$TOTALCOLS++;$hall.="<td class='th-lite'>".utf8_encode($line_c['label'])."</td>"; // (+1 col) crée une colonne pour la catégorie en cours et son intitulé
			}$reqcat->closeCursor(); // réinitialise le curseur de ligne de la requête reqcat
		}$req->closeCursor();

		$TOTALCOLS+=3;$hall.="<th class='' title='Nombre d'erreurs'>Err.</th> <th class='' title='Ne sait pas'>NSP</th> <th class='' title='Questions restées sans réponse'>SR</th>"; // (+3 col) crée des colonnes et les intitulés,
		$TOTALCOLS++;$hall.="<th>Temps</th> <th>Date de participation</th>"; // (+1 col) crée la colonne pour la date et ferme la ligne des intitulés.
		if($admin){$TOTALCOLS++;$hall.="<th>Ø</th>";}
		$hall.="</tr>\n$t6<tr class='tr-separ'></tr>\n"; // ligne d'espacement
/* génération et remplissage des lignes du tableau */

		$sansreponse=0; // initialise compteur de réponses manquantes (par manque de temps, oubli ou ignorance)
		$fausses=0; // initialise compteur de mauvaises réponses
		$ignore=0; // initialise compteur de réponses ignorées "Je ne sais pas."

		initIDs();

		$reqqcm=$data->prepare("SELECT label,temps_imparti FROM questionnaires WHERE ID_Questionnaire= ?"); // récupèrera le nom du qcm en fonction de l'id du qcm
		$reqid=$data->prepare("SELECT ID_Domaine,ID_Categorie FROM v_dom_cat_quest WHERE ID_Question= ?"); // récupèrera l'id du domaine et de la catégorie en fonction de l'id de la question i
		$reqdom=$data->prepare("SELECT ID_Domaine FROM domaines WHERE visible=1 ORDER BY $domorderby $dasc"); // récupèrera l'id des domaines visibles en fonction du tri
		$reqcat=$data->prepare("SELECT ID_Categorie,visible FROM categories WHERE id_domaine= ? ORDER BY $catorderby $casc"); // récupèrera l'id et la visibilité des catégories du domaine choisi en fonction du tri

		$bdd="SELECT ID_Candidat,nom,prenom,id_questionnaire,score,temps,questions_posees,reponses_donnees,date FROM candidats WHERE visible=1 AND assoc IS NOT NULL AND score IS NOT NULL ORDER BY $orderby"; // récupère les données de chaque candidat visible et non-null
		$req=$data->query($bdd); // récupère toutes les données de chaque candidat visible, non-null uniquement

		while($line_n=$req->fetch()){ // boucle pour générer le contenu du tableau
			$count++;
			$id_qcm=$line_n['id_questionnaire'];

			$hall.=separByID($id_qcm,"cat");

			if($line_n['score']!=NULL){ // si 'score' est non-NULL (si le candidat a déjà participé)...
				$array_quest=explode(",",utf8_encode($line_n['questions_posees'])); // segmente la chaîne des 'questions_posees' pour extraire les ID des questions posées, et stocke le array généré
				$array_repns=explode(",",utf8_encode($line_n['reponses_donnees'])); // comme précédemment mais avec les 'reponses_donnees' pour extraire le # des réponses données

				$reqqcm->execute(array($id_qcm));$line_qcm=$reqqcm->fetch(); // récupère le nom du qcm en fonction de l'id du qcm
					$hall.="$t6<tr><td class='th-cat$class_cat'>".utf8_encode($line_qcm['label'])."</td>"; // case le nom du QCM
					$hall.="<td class='td-id$class_cat'>".$line_n['ID_Candidat']."</td>"; // nouvelle ligne n, case l'ID du candidat
					$hall.="<th class='th-main$class_cat'>".utf8_encode($line_n['nom'])." ".utf8_encode($line_n['prenom'])."</th>"; // ligne n, case Nom et prénom du candidat
					$hall.="<th class='th-main$class_cat'>".$line_n['score']."<span> /".count($array_quest)."</span></th>"; // case le score global
					
					$laptime="<th class='th-main$class_cat'>".$line_n['temps']."<span> min/".$line_qcm['temps_imparti']."</span></th>"; // case le temps
				$reqqcm->closeCursor();
				
				$countqstbycat=array(0); // initialise compteur de questions par catégories
				for($i=0;$i<count($array_quest);$i++){ // boucle pour lister les questions posées
					$reqid->execute(array($array_quest[$i]));$line_id=$reqid->fetch();
					
					if(!isset($countqstbycat[$line_id['ID_Categorie']])){$countqstbycat[$line_id['ID_Categorie']]=0;}
					$countqstbycat[$line_id['ID_Categorie']]++; // incrémente le compteur de questions pour la catégorie en cours
					
					$dom=$line_id['ID_Domaine'];
					$domdom=$array_dom[$dom];
					$catcat=$array_cat[$line_id['ID_Categorie']];
					if($array_score[$domdom]=="-"){$array_score[$domdom]=0;} // le domaine est inclus dans ceux soumis au candidat n, on initialise alors le compteur à 0
					if(!isset($array_scorecat[$dom][$catcat])){$array_scorecat[$dom][$catcat]='-';}
					$scat=$array_scorecat[$dom][$catcat];
					if($scat=="-"){$array_scorecat[$dom][$catcat]=0;} // la catégorie est incluse dans celles soumises au candidat n, on initialise alors le compteur à 0
					
					switch($array_repns[$i]){ // si la réponse à la i-ème question posée est égale à :
						case 0:$sansreponse++;break;// 0= incrémente le compteur de questions restées sans réponse
						case 1: // si la réponse à la i-ème question posée est égale à 1 :
							$array_score[$domdom]++; // incrémente le compteur de bonnes réponses pour le domaine en cours
							$array_scorecat[$dom][$catcat]++; // incrémente le compteur de bonnes réponses pour la catégorie en cours du domaine en cours
							break;
						case 5:$ignore++;break; // 5= incrémente compteur ignore
						default:$fausses++; // autres= incrémente le compteur fausses
					}
				}$reqid->closeCursor();

				$reqdom->execute();
				while($line_dom=$reqdom->fetch()){ // boucle pour créer les cases et afficher les scores par domaines
					$dom=$line_dom['ID_Domaine'];
					$countqstbydom=0;$halltemp="";
					$reqcat->execute(array($dom));
					while($line_cat=$reqcat->fetch()){ // boucle pour créer les cases et afficher les scores par catégories
						$cat=$line_cat['ID_Categorie'];
						$cqbc=isset($countqstbycat[$cat])?$countqstbycat[$cat]:0;
						$countqstbydom+=$cqbc;
						if($line_cat['visible']){
							$cattemp=isset($array_scorecat[$dom][$array_cat[$cat]])?$array_scorecat[$dom][$array_cat[$cat]]:"0";
							$halltemp.="<td class='th-cat$class_cat'>".($cqbc>0?"$cattemp<span> /$cqbc</span>":"-")."</td>"; // case le score associé au numéro de colonne i
						}
					}$reqcat->closeCursor();
					$hall.="<td class='th-dom$class_cat'>".($countqstbydom>0?"</span>".$array_score[$array_dom[$dom]]."<span> /$countqstbydom":"-")."</td>"; // case le score associé au numéro de colonne i
					$hall.=$halltemp;
				}$reqdom->closeCursor();
				
				$hall.="<td class='td$class_cat'>$fausses</td> <td class='td$class_cat'>$ignore</td> <td class='td$class_cat'>$sansreponse</td>"; // case les scores autres que les bonnes réponses
				$hall.="$laptime<td class='td$class_cat'>".formatDate($line_n['date'])."</td>"; // case la date de dernière modification

				$sansreponse=0; $fausses=0; $ignore=0; // réinitialise les compteurs pour le candidat suivant
				foreach($array_score as $i=>$value){$array_score[$i]="-";} // réinitialise compteurs de bonne réponse
				foreach($array_scorecat as $i=>$value){$array_scorecat[$i]=array("-");} // réinitialise compteurs de bonne réponse
			}
			$hall.=masquer($n,$line_n['ID_Candidat'])."</tr>\n"; // affiche ou non les case à cocher Voir, et fin de la ligne n
		}$req->closeCursor();
	}else{ // sinon (si aucun candidat n'est présent dans la base de données)...
		$hall.="$t6<tr><td class='td-none' colspan='$TOTALCOLS'>$AUCUN</td></tr>\n"; // affiche un message d'information
	}
	$hall.="$t6<tr class='tr-separ-dom'><td colspan='$TOTALCOLS'></td></tr>\n";
	$hall.="$t5</table>\n$t4</div>\n"; // fin du tableau
	
	$hallhead="$t5<div class='tableau'>\n$t6<table id='hall' class='$hall_class'><caption>$count ".($count==0?"candidat listé":"candidats listés")." :</caption>\n";
	$hallhead.="$t7<tr class='trans'><td class='trieuse trans' colspan='$TOTALCOLS'>$trieuse</td></tr>\n";

	$scripts="$t5<script type='text/javascript'>$t6"."function trier(){var tri=document.getElementById('tri').value,asc=document.getElementById('asc').value, dtri=document.getElementById('dtri').value,dasc=document.getElementById('dasc').value, ctri=document.getElementById('ctri').value,casc=document.getElementById('casc').value;\$.ajax({url:'bo/table-score.php',dataType:'html',type:'get',data:'tri='+tri+'&asc='+asc+'&dtri='+dtri+'&dasc='+dasc+'&ctri='+ctri+'&casc='+casc,success:function(hallin){\$('#hallin').html(hallin);}});}\n";
	$scripts.="$t6"."function maskID(mskid){\$.post('req/checker.php',{table:'candidats',id:mskid,visible:0});}\n";
	$scripts.="$t5</script>\n";

echo $scripts.$hallhead.$hall;
?>
