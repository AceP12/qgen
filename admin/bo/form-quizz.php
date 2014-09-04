<?php 
require_once"../req/connect.php";
require_once"../inc/functions.php";

if(isset($_GET['id']) && $_GET['id'] > 0 && !empty($_GET['id'])) 
{
	// $candidat = $data->query('SELECT * FROM candidats WHERE ID_Candidat = ' . $_GET['id'])->fetchAll();

	$req = $data->query('SELECT * FROM v_scores v WHERE ID_Candidat = ' . $_GET['id'])->fetch();
	// $questions = explode(",", $req['questions_posees']);
	foreach ($questions = explode(",", $req['questions_posees']) as $key => $value) {
		$question = $data->query("SELECT question, rep_1, rep_2, rep_3, rep_4 FROM questions WHERE  ID_Question = $value")->fetchColumn();
	// var_dump($question);
	// var_dump($value);
		echo "<hr>";


		$req = $data->query('SELECT question, rep_1, rep_2');
	}
	foreach ($reponse_donnees = explode(",", $req['reponses_donnees']) as $key) {
		//var_dump($key);
		echo "<hr>";
	}

	$question = $data->query('SELECT `q`.`question`, `q`.`rep_1`, `q`.`rep_2`, `q`.`rep_3`, `q`.`rep_4`, `c`.`ID_Candidat`, `c`.`reponses_donnees`, `c`.`id_questionnaire` FROM questions as q JOIN candidats as c WHERE `c`.`ID_Candidat` = 186');

	foreach ($question as $key => $value) {
		var_dump($value);
		echo "<hr>";
	}



}else
{

}
?>

						<div id="btnval"><input type="button" value="VALIDER ET QUITTER" onclick="modalDisplay('block')"/></div>
						<input type="hidden" id="idcan" name="idcan" value=""/>
						<input type="hidden" id="ecoule" name="ecoule" value="0"/>
						<input type="hidden" id="liste_rep" name="liste_rep" value=""/>
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
