<?php include"options-dom.php"?>
			<div id="addformbox" >
				<div id="overlay"></div>
				<table><tr><td>
					<div id="bloc">
						<a id="closeModal" onclick="document.getElementById('addformbox').style.display='none'" title="Fermer"><img src="img/modalclose.png" alt="Fermer"/></a>
						<form id="formul1" method="post" action="req/request.php"><input id="formulaire" name="formulaire" type="hidden" value="form-dom"/><input id="pagename" name="pagename" type="hidden" value="<?=$page_name?>"/>
							<script type="text/javascript">
								function toggleBtn(){var vdom=document.getElementById('domaine').value;
									if(vdom){$.ajax({url:'bo/input-submit.php',dataType:'html',success:function(input_submit){$("#btns").html(input_submit);}});
									}else{$.ajax({success:function(){$("#btns").html("");}});}
								}
							</script>
<?=contentTitle("Création de Domaine").contentDesc("Saisissez un nouveau domaine de connaissances.")?>
							<!--[if IE 8]><div></div><![endif]-->
							<div id="new">
								<label for="domaine">Nouveau Domaine : </label><input id="domaine" name="domaine" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
							</div>
							<div id="btns"></div>
						</form>
					</div>
				</td></tr></table>
			</div>
