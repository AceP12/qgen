<?php include"options-dom.php"?>
			<div id="addformbox" >
				<div id="overlay"></div>
				<table><tr><td>
					<div id="bloc">
						<a id="closeModal" onclick="document.getElementById('addformbox').style.display='none'" title="Fermer"><img src="img/modalclose.png" alt="Fermer"/></a>
						<form id="formul1" method="post" action="req/request.php"><input id="formulaire" name="formulaire" type="hidden" value="form-cat"/><input id="pagename" name="pagename" type="hidden" value="<?=$page_name?>"/>
							<script type="text/javascript">
								function toggleBtn(){var vdom=document.getElementById('domaine').value, vcat=document.getElementById('categorie').value;
									if(vdom&&vcat){$.ajax({url:'bo/input-submit.php',dataType:'html',success:function(input_submit){$("#btns").html(input_submit);}});
									}else{$.ajax({success:function(){$("#btns").html("");}});}
								}
							</script>
<?=contentTitle("Création d'une Catégorie").contentDesc("Sélectionnez un Domaine existant puis saisissez un intitulé pour la nouvelle catégorie à y inclure.")?>
							<!--[if IE 8]><div></div><![endif]-->
							<div id="dom">
								<label for="domaine">Dans le Domaine : </label><input class="goto" type="button" value="gérer >" onclick="location.href='domaines.php';" alt="Gestion de Domaines"/>
								<select id="domaine" name="domaine" onchange="toggleBtn()"><?="\n$dom_options"?>
								</select>
							</div>
							<div id="new">
								<label for="categorie">Nouvelle Catégorie : </label><input id="categorie" name="categorie" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
							</div>
							<div id="btns"></div>
						</form>
					</div>
				</td></tr></table>
			</div>
