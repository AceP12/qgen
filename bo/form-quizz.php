<?php require_once"req/connect.php";require_once"inc/functions.php";
if(session_id()==''){session_start();}
$_SESSION['currq']=sessionExist('currq')?$_COOKIE['currq']:1;
$cq=$_SESSION['currq'];

$last=$data->query("SELECT ID_Candidat,id_questionnaire,reponses_donnees,assoc FROM candidats ORDER BY ID_Candidat DESC LIMIT 1")->fetch(); // récupère la dernière entrée crée dans la table candidats
$IDcan=$last['ID_Candidat'];
$liste_rep=utf8_encode($last['reponses_donnees']);
$liste_rep_sv=str_replace(",","",$liste_rep);
$assoc=str_split($last['assoc'],4);

$qcm=$data->query("SELECT label,liste_questions,temps_imparti FROM questionnaires WHERE ID_Questionnaire=".$last['id_questionnaire'])->fetch();
$labelquizz=utf8_encode($qcm['label']);
$temps_imparti=$qcm['temps_imparti'];
$array_quest=explode(",",utf8_encode($qcm['liste_questions']));
$quest_count=count($array_quest);

$quest_field="";$ariane="";$liste_rep_out=$liste_rep_sv;
$req=$data->prepare("SELECT label_domaine,label_categorie,question,rep_1,rep_2,rep_3,rep_4 FROM v_dom_cat_quest WHERE ID_Question=:id");
for($q=1;$q<$quest_count+1;$q++){
	$req->execute(array('id'=>$array_quest[$q-1]));
	$qst=$req->fetch();
	$quest_field.="$t6<fieldset id='f$q'>";
	
	$quest_field.="<div class='qnav clear'>";
	if($q>1){$quest_field.="<input type='button' value='< PRÉCÉDENTE' class='nav-prev' title='Question précédente' onclick='slider(this.parentNode.parentNode,-1)'/>";}
	if($q<$quest_count){$quest_field.="<input type='button' value='SUIVANTE >' class='nav-next' title='Question suivante' onclick='slider(this.parentNode.parentNode,+1)'/>";}
	$quest_field.="<hr/></div>";

	$quest_field.="<span>$q<p>/$quest_count </p></span>";
	$quest_field.="<h4> ".utf8_encode($qst['label_domaine'])." : ".utf8_encode($qst['label_categorie'])."</h4>";
	$quest_field.="<h3>".utf8_encode($qst['question'])."</h3><hr/>";
	
	$reponse=substr($liste_rep_sv,$q-1,1);$fil="";
	for($r=1;$r<5;$r++){
		$asso=substr($assoc[$q-1],$r-1,1);
		$checkme=($reponse==$asso)?"checked":"";
		if($checkme){$liste_rep_out=substr_replace($liste_rep_out,$r,$q-1,1);$fil="checked";}
		$quest_field.="<label for='f$q"."r$r' class='$checkme'><input $checkme type='radio'".($checkme?" disabled":"")." onclick='checkState(this)' id='f$q"."r$r' name='f$q' value='$r'/>".utf8_encode($qst['rep_'.$asso])."</label>";
	}$req->closeCursor();
	$checkme=($reponse==5)?"checked":"";if($checkme){$liste_rep_out=substr_replace($liste_rep_out,"5",$q-1,1);$fil="checked";}
	$quest_field.="<label for='f$q"."r5' class='$checkme'><input $checkme type='radio'".($checkme?" disabled":"")." onclick='checkState(this)' id='f$q"."r5' name='f$q' value='5'/>Je ne sais pas.</label>";

	$quest_field.="</fieldset>\n";
	
	$ariane.="$t7<li><label id='q$q' for='a$q' class='$fil'><input type='radio' id='a$q' name='a$q' value='$q' onclick='voyager(this)'/>$q</label></li>";
}
?>
				<!--[if IE 8]><style>#ariane input{display:inline;width:0}</style><![endif]-->
				<h2 id="labelquizz"><?=$labelquizz?></h2>
<?=contentDesc("Veuillez répondre aux questions suivantes dans le temps imparti !")?>
				<h4 id="imparti">Temps imparti : <?=$temps_imparti?> min</h4>
				<div id="bloc4">
					<form id="formulq" name="formulq" method="post" action="req/end-session.php">
					
						<div id="addformbox">
							<div id="overlay"></div>
							<table><tr><td>
								<div id="bloc3">
			<?=contentTitle("Confirmation").contentDesc("Êtes-vous sûr(e) de vouloir valider vos réponses et quitter ce questionnaire ?")?>
									<!--[if IE 8]><div></div><![endif]-->
									<div id="btnmod"></div>
								</div>
							</td></tr></table>
						</div>
						
						<h3 id="restant">Temps restant : <span id="chrono">00m00s</span></h3>
						<div id="ariane">
							<ul>
<?=$ariane?>
							</ul>
							<div class="clear"></div>
						</div>
<?=$quest_field?>
<?php include"inc/timer.php"; ?>
						<div id="btnval"><input type="button" value="VALIDER ET QUITTER" onclick="modalDisplay('block')"/></div>
						<input type="hidden" id="idcan" name="idcan" value="<?=$IDcan?>"/>
						<input type="hidden" id="ecoule" name="ecoule" value="0"/>
						<input type="hidden" id="liste_rep" name="liste_rep" value="<?=$liste_rep_out?>"/>
						<script type="text/javascript">
							var gebi=function(id){return document.getElementById(id);};
							function curq(cq){document.cookie="currq="+cq+"; path=/";}
							
							var oldq=gebi('f'+<?=$cq?>);oldq.style.display='block';gebi('q'+<?=$cq?>).style.color='#fff'; // attribue les valeurs de la question à afficher au (re)chargement de la page
							
							function voyager(q){ // gère la navigation par le fil d'ariane
								oldq.style.display='none';gebi(oldq.id.replace("f","q")).style.color='#7FC6BC';
								var newq=gebi("f"+q.value);newq.style.display='block';q.parentNode.style.color='#fff';
								oldq=newq;curq(q.value);
							}
							function slider(q,s){ // gère la navigation par les boutons
								q.style.display='none';gebi(q.id.replace("f","q")).style.color='#7FC6BC';
								var f=parseInt(q.id.replace("f",""))+s;
								var newq=gebi("f"+f);newq.style.display='block';gebi(newq.id.replace("f","q")).style.color='#fff';
								oldq=newq;curq(f);
							}

							function checkState(rad){ // gère l'état des radio
								try{var fset=rad.parentNode.parentNode.querySelector('.checked');fset.firstChild.disabled=false;fset.className='';}catch(e){}
								rad.parentNode.className=rad.checked?'checked':'';rad.disabled=rad.checked;
								gebi(rad.name.replace("f","q")).className=rad.checked?'checked':'';
								stockRep();
							}
							function stockRep(){ // stocke les réponses données dans le champs masqué list_rep
								var radval,replist='',quest_count=<?=$quest_count?>;
								for(var i=1;i<quest_count+1;i++){
									try{radval=gebi('f'+i).querySelector('.checked').firstChild.value;}catch(e){}
									replist+=radval?radval:'0';
									radval='';
								}
								gebi('liste_rep').value=replist;
								$.post('req/saver.php',{id:<?=$IDcan?>, rd:replist, temps:gebi('ecoule').value}); // enregistre les changements dans la base de données
							}
							
							function modalDisplay(d){ // affiche la boîte de dialogue de confirmation de fermeture
								if(d='block'){$.ajax({url:'bo/input-confirm.php',dataType:'html',success:function(input){$("#btnmod").html(input);}});}else{d='none';$.ajax({success:function(){$("#btnmod").html("");}});}
								document.getElementById('addformbox').style.display=d;
							}
						</script>
					</form>
				</div>
