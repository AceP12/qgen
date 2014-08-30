			<div id="addformbox" >
				<div id="overlay"></div>
				<table><tr><td>
					<div id="bloc">
						<a id="closeModal" onclick="document.getElementById('addformbox').style.display='none'" title="Fermer"><img src="img/modalclose.png" alt="Fermer"/></a>
						<form id="formul1" method="post" action="req/request.php"><input id="formulaire" name="formulaire" type="hidden" value="form-candi"/><input id="pagename" name="pagename" type="hidden" value="<?=$page_name?>"/>
							<script type="text/javascript">
								function toggleBtn(){var vnom=document.getElementById('nom').value, vpre=document.getElementById('prenom').value;
									if(vnom&&vpre){$.ajax({url:'bo/input-submit.php',dataType:'html',success:function(input_submit){$("#btns").html(input_submit);}});
									}else{$.ajax({success:function(){$("#btns").html("");}});}
								}
							</script>
<?=contentTitle("Ajout de Candidat").contentDesc("Saisissez les noms et prénoms du nouveau candidat.")?>
							<!--[if IE 8]><div></div><![endif]-->
							<div id="new">
								<label for="nom">Nom du nouveau Candidat : </label><input id="nom" name="nom" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
								<!--[if IE 8]><div class="ie1em"></div><![endif]-->
								<label for="prenom">Prénom du nouveau Candidat : </label><input id="prenom" name="prenom" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
							</div>
							<div id="misc">
								<label for="email">Adresse e-Mail du nouveau Candidat : </label><input id="email" name="email" type="text"/>
							</div>
							<div id="btns"></div>
						</form>
					</div>
				</td></tr></table>
			</div>
