<?php include"inc/functions.php";$page_title="Inscription";
session_start();
if(!isset($_SESSION['permis'])||$_SESSION['permis']!='²º¹³·ª·¹'){
	if(sessionExist('login')){redir('quizz.php');
	}elseif(sessionExist('staff')){unset($_SESSION['staff']);setcookie('staff');$_SESSION['permis']='²º¹³·ª·¹';
	}else{redir('nouveau.php');}
}
include"inc/opener-norc.php"?>
		<form name="add-sessiondb" method="post" action="req/add-sessiondb.php" enctype="multipart/form-data">
			<div id="addformbox">
				<div id="overlay"></div>
				<table><tr><td>
					<div id="bloc3">
						<a id="closeModal" onclick="modalDisplay('none')" title="Fermer"><img src="img/modalclose.png" alt="Fermer"/></a>
<?=contentTitle("Instructions").contentDesc("Un questionnaire à choix multiple va vous être soumis.</p><p>Après avoir cliqué sur le bouton COMMENCER vous aurez un temps imparti de XX minutes pour répondre aux XX questions qui vous seront posées.</p><p>Vous pourrez naviguer librement entre les questions et y répondre dans l'ordre que vous souhaitez.</p><p>Vous pourrez également valider vos réponses et quitter le test à tout moment.</p><p>Lorsque vous êtes prêt(e), cliquez sur le bouton COMMENCER ci-dessous pour débuter le test.")?>
						<!--[if IE 8]><div></div><![endif]-->
						<div id="btnmod"></div>
					</div>
				</td></tr></table>
			</div>
			<hr/>
			<div id='section'>
				<div id="bloc">
					<script type="text/javascript">
						function modalDisplay(d){
							if(d='block'){$.ajax({url:'bo/input-start.php',dataType:'html',success:function(input){$("#btnmod").html(input);}});}else{$.ajax({success:function(){$("#btnmod").html("");}});}
							document.getElementById('addformbox').style.display=d;
						}
						function toggleBtn(){var vnom=document.getElementById('nom').value, vpre=document.getElementById('prenom').value, vmail=document.getElementById('email').value;
						if(isAlpha(vnom)&&isAlpha(vpre)&&isEmail(vmail)){$.ajax({url:'bo/input-subs.php',dataType:'html',success:function(input){$("#btns").html(input);}});
						}else{$.ajax({success:function(){$("#btns").html("");}});}}
						
						var isAlpha=function(text){return(/^[A-Za-z\sàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ\'\.\-_]{2,128}$/.test(text));};
						var isEmail=function(emailStr){
							var checkTLD=1;var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum|fr|dev|web)$/;
							var atom="\[^\\s"+"\\(\\)><@,;:\\\\\\\"\\.\\[\\]"+"\]"+'+';var word="("+atom+"|"+"(\"[^\"]*\")"+")";var userPat=new RegExp("^"+word+"(\\."+word+")*$");var domainPat=new RegExp("^"+atom+"(\\."+atom+")*$");var matchArray=emailStr.match(/^(.+)@(.+)$/);
							if(matchArray==null){return false;}
							var user=matchArray[1];var domain=matchArray[2];
							for(i=0;i<user.length;i++){if(user.charCodeAt(i)>127){return false;}}
							for(i=0;i<domain.length;i++){if(domain.charCodeAt(i)>127){return false;}}
							if(user.match(userPat)==null){return false;}
							var IPArray=domain.match(/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/);
							if(IPArray!=null){for(var i=1;i<=4;i++){if(IPArray[i]>255){return false;}}return true;}
							var atomPat=new RegExp("^"+atom+"$");var domArr=domain.split(".");var len=domArr.length;
							for(i=0;i<len;i++){if(domArr[i].search(atomPat)== -1){return false;}}
							if(checkTLD && domArr[len-1].length!=2 && domArr[len-1].search(knownDomsPat)==-1){return false;}
							if(len<2){return false;}
							return true;
						};
					</script>
<?=contentTitle("3 : Inscription")?>
<?=contentDesc("Veuillez saisir votre nom, prénom et adresse email (de préférence identique à celle indiquée sur votre CV).</p>")?>
					<div></div>
					<div id="new">
						<label for="nom">NOM : </label><input id="nom" name="nom" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
						<div class="ie1em"></div>
						<label for="prenom">Prénom : </label><input id="prenom" name="prenom" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
					</div>
					<div id="misc">
						<label for="email">Adresse e-Mail : </label><input id="email" name="email" type="text" onkeyup="toggleBtn()" onchange="toggleBtn()"/>
					</div>
					<div id="btns"></div>
				</div>
			</div>
		</form>
		<hr/><script>(function(){document.getElementById('nom').focus();})()</script>
<?php include"inc/ender.php"?>