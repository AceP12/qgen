<?php include"options-qcm.php";
$quest_count=20 ; // nombre maximum de questions affichées dans le formulaire de création
?>
			<div id="addformbox" >
				<div id="overlay"></div>
				<table><tr><td>
					<div id="bloc2">
						<a id="closeModal" onclick="document.getElementById('addformbox').style.display='none'" title="Fermer"><img src="img/modalclose.png" alt="Fermer"/></a>
						<form id="formul1" method="post" action="req/request.php"><input id="formulaire" name="formulaire" type="hidden" value="form-qcm"/><input id="pagename" name="pagename" type="hidden" value="<?=$page_name?>"/><input id="liste_qcm" name="liste_qcm" type="hidden" value=""/>
							<script type="text/javascript">
								var valById=function(id){return document.getElementById(id).value;}; // alias valeur du champ
								var titleMe=function(id){e=document.getElementById(id);e.title=e.options[e.selectedIndex].title;}; // alias infobulle de la sélection
								var isNumeric=function(value){return (/(^\d+$)/.test(value));}; // alias teste si numérique
								
								function changeCat(lineid,iddom){ // màj la liste avec les catégories liées au domaine sélectionné
									var listeId=lineid.split('_');
									$.ajax({url:'bo/options-cat.php',dataType:'html',type:'GET',data:'d='+iddom,success:function(opts){$('#cat_'+listeId[1]).html(opts);}});
									titleMe(lineid);
									changeQst('cat_'+listeId[1],'');
								}
								function changeQst(lineid,idcat){ // màj la liste avec les questions liées à la catégorie sélectionnée
									var listeId=lineid.split('_');
									$.ajax({url:'bo/options-quest.php',dataType:'html',type:'GET',data:'d='+idcat,success:function(opts){$('#qst_'+listeId[1]).html(opts);}});
									titleMe(lineid);
									stockQst('qst_'+listeId[1]);
								}
								function stockQst(lineid){ // prépare l'envoi en stockant la liste des questions dans un champ masqué
									titleMe(lineid);
									var qstval,qcmlist='',quest_count=<?=$quest_count?>;
									for(var i=1;i<quest_count+1;i++){qstval=valById('qst_'+i);qcmlist+=qstval?qstval+',':'';}
									document.getElementById('liste_qcm').value=qcmlist.substring(0,qcmlist.length-1);
									toggleBtn();
								}
								function toggleBtn(){ // afficher ou masquer le bouton Enregistrer
									var vqcm=valById('qcm'),vliste=valById('liste_qcm'),vtime=valById('tps');
									if(vqcm&&vliste&&isNumeric(vtime)){if(vtime=="0"){document.getElementById('tps').value="1";}$.ajax({url:'bo/input-submit.php',dataType:'html',success:function(input_submit){$("#btns").html(input_submit);}}); // si tous les champs requis sont remplis, affiche le bouton
									}else{$.ajax({success:function(){$("#btns").html("");}});} //sinon masque le bouton
								}
							</script>
			<?=contentTitle("Création de Questionnaire").contentDesc("Remplissez le formulaire pour créer un nouveau questionnaire.</p>\n$t7<p>Pour être valide, il doit contenir un intitulé, une durée et au moins une question.")?>
							<div></div>
							<div id="new">
								<label for="qcm">Nouveau Questionnaire : </label><input id="qcm" name="qcm" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
								<span><label for="tps">Temps imparti : </label><input id="tps" name="tps" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/><span> minutes</span></span>
							</div>
<?php
	$qcmline="";
	for($i=1;$i<$quest_count+1;$i++){
		$qcmline.="$t7<div class='qcm-line'>\n";
		$qcmline.="$t8<select id='dom_$i' name='dom_$i' class='dom' onchange='changeCat(this.id,this.options[this.selectedIndex].value)'>\n$dom_options"."$t8</select>\n";
		$qcmline.="$t8<select id='cat_$i' name='cat_$i' class='cat' onchange='changeQst(this.id,this.options[this.selectedIndex].value)'>\n$cat_options"."$t8</select>\n";
		$qcmline.="$t8<select id='qst_$i' name='qst_$i' class='qst' onchange='stockQst(this.id)'>\n$qst_options"."$t8</select>\n";
		$qcmline.="$t8<label for='qst_$i'>#$i</label>\n$t7</div>\n";
	}echo $qcmline;
?>
							<div id="btns"></div>
						</form>
					</div>
				</td></tr></table>
			</div>
