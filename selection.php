<?php require_once"req/connect.php";include"inc/functions.php";$page_title="Sélection du questionnaire";
if(sessionExist('login')){redir('quizz.php');}elseif(!sessionExist('staff')){redir('nouveau.php');}
include"inc/opener-norc.php";
include"inc/header.php";
include"inc/nav.php";
?>
		<hr/>
		<div id='section'>
			<div id="bloc">
				<form name="add-entrydb" method="post" action="req/add-entrydb.php" enctype="multipart/form-data">
					<script type="text/javascript">function toggleBtn(){var vqcm=document.getElementById('qcm').value;if(vqcm){$.ajax({url:'bo/input-next.php',dataType:'html',success:function(input){$("#btns").html(input);}});}else{$.ajax({success:function(){$("#btns").html("");}});}}</script>
<?=contentTitle("2 : Sélection du Questionnaire").contentDesc("Veuillez sélectionner le questionnaire à soumettre au candidat.")?>
							<div></div>
							<div id="dom">
								<label for="qcm">Questionnaire : </label>
								<select id="qcm" name="qcm" onchange="toggleBtn()">
<?php
$qcm_options="$t9<option value='' title='Sélectionnez un questionnaire...'>...</option>\n";
$req=$data->query("SELECT ID_Questionnaire,label,liste_questions,temps_imparti FROM questionnaires WHERE visible=1 ORDER BY label,ID_Questionnaire ASC");
while($line_n=$req->fetch()){
	$array_quest=explode(",",utf8_encode($line_n['liste_questions']));$quest_count=count($array_quest);
	$info=$line_n['ID_Questionnaire'].": ".infoReplace(utf8_encode($line_n['label']));
	$qcm_options.="$t9<option value='".$line_n['ID_Questionnaire']."' title='$info'>".utf8_encode($line_n['label'])." ( $quest_count"."qst ".$line_n['temps_imparti']."min )</option>\n";
}$req->closeCursor();
echo $qcm_options;
?>
								</select>
							</div>
					<div id="btns"></div>
				</form>
			</div>
		</div>
		<hr/><script>(function(){document.getElementById('qcm').focus();})()</script>
<?php include"inc/ender.php"?>