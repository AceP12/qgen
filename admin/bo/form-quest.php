<?php include"options-dom.php"?>
			<div id="addformbox" >
				<div id="overlay"></div>
				<table><tr><td>
					<div id="bloc">
						<a id="closeModal" onclick="document.getElementById('addformbox').style.display='none'" title="Fermer"><img src="img/modalclose.png" alt="Fermer"/></a>
						<form id="formul1" method="post" action="req/request.php"><input id="formulaire" name="formulaire" type="hidden" value="form-quest"/><input id="pagename" name="pagename" type="hidden" value="<?=$page_name?>"/>
							<script type="text/javascript">
								var valById=function(id){return document.getElementById(id).value}; // alias pour récupérer la valeur d'un champ
								function changeCat(iddom){ // afficher uniquement les catégories liées au domaine sélectionné
									$.ajax({url:'bo/options-cat.php',dataType:'html',type:'GET',data:'d='+iddom,success:function(opts){$("#categorie").html(opts);}});
									toggleBtn();
								}
								function toggleBtn(){ // afficher ou masquer les boutons Enregistrer et Prévisu
									var vdom=valById('domaine'),vcat=valById('categorie'),vnew=valById('new_1'),vgood=valById('good_1'),vbad1=valById('bad_1'),vbad2=valById('bad_2'),vbad3=valById('bad_3');
									if(vdom&&vcat&&vnew&&vgood&&vbad1&&vbad2&&vbad3){ // si tous les champs sont remplis...
										$.ajax({url:'bo/input-submit.php',dataType:'html',success:function(input_submit){$("#btns").html(input_submit);}}); // ... affiche le bouton
										document.getElementById('bloc').style.borderColor='#0f0'; // et colore la bordure
									}else{ // sinon...
										$.ajax({success:function(){$("#btns").html("");}}); // ... masque le bouton
										document.getElementById('bloc').style.borderColor='#fff'; // et colore la bordure
									}
								}
							</script>
<?=contentTitle("Création d'une Question").contentDesc("Sélectionnez un Domaine et une Catégorie existants puis saisissez un énoncé pour la nouvelle Question à y inclure et ses choix de réponses.</p><p>Tous les champs sont obligatoires.")?>
							<!--[if IE 8]><div></div><![endif]-->
							<div id="dom">
								<label for="domaine">Dans le Domaine : </label><input class="goto" type="button" value="gérer >" onclick="location.href='domaines.php';" alt="Gestion de Domaines"/>
								<select id="domaine" name="domaine" onchange="changeCat(this.options[this.selectedIndex].value)"><?="\n$dom_options"?>
								</select>
							</div>
							<div id="cat">
								<label for="categorie">Dans la Catégorie : </label><input class="goto" type="button" value="gérer >" onclick="location.href='categories.php';" alt="Gestion de Catégories"/>
								<select id="categorie" name="categorie" onchange="toggleBtn()">
								</select>
							</div>
							<div id="new">
								<label for="new_1">Nouvelle Question : </label><textarea id="new_1" name="new_1" rows="3" onkeyup="toggleBtn()" onchange="toggleBtn()"></textarea>
							</div>
							<div id="good">
								<label for="good_1">Bonne Réponse : </label><input id="good_1" name="good_1" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
							</div>
							<div id="bad">
								<label for="bad_1">Réponse fausse #1 : </label><input id="bad_1" name="bad_1" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
								<!--[if IE 8]><div class="ie1em"></div><![endif]-->
								<label for="bad_2">Réponse fausse #2 : </label><input id="bad_2" name="bad_2" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
								<!--[if IE 8]><div class="ie1em"></div><![endif]-->
								<label for="bad_3">Réponse fausse #3 : </label><input id="bad_3" name="bad_3" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
							</div>
							<div id="btns"></div>
						</form>
					</div>
				</td></tr></table>
			</div>
