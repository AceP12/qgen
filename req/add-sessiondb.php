<?php require_once"connect.php";require_once"../inc/functions.php";
$email=safeData($_POST['email']);
if(sessionExist('login')){redir('quizz.php');
}elseif($_SESSION['permis']!='²º¹³·ª·¹'){unset($_SESSION['permis']);redir('../nouveau.php');
}else{$exist=$data->query("SELECT count(*) FROM candidats WHERE email='$email'")->fetchColumn();if($exist){redir('../inscription.php');}}

if((!isset($_POST['nom'])||empty($_POST['nom'])) || (!isset($_POST['prenom'])||empty($_POST['prenom'])) || (!isset($_POST['email'])||empty($_POST['email']))){redir('../inscription.php');}

$nom=safeData($_POST['nom']);
$prenom=safeData($_POST['prenom']);

$last=$data->query("SELECT ID_Candidat,id_questionnaire,assoc FROM candidats ORDER BY ID_Candidat DESC LIMIT 1")->fetch(); // récupère la dernière entrée crée dans la table candidats

$IDqcm=$last['id_questionnaire'];
$IDcan=$last['ID_Candidat'];
$assoc=utf8_encode($last['assoc']);

// var_dump($assoc);

if($assoc==NULL){

	$line_n=$data->query("SELECT liste_questions,temps_imparti FROM questionnaires WHERE ID_Questionnaire=$IDqcm")->fetch();

	$temps=$line_n['temps_imparti'];
	$liste=$line_n['liste_questions'];

	$array_quest=explode(",",$liste);
	$count=count($array_quest);

	$assoc="";$donnees="";
	for($i=1;$i<$count+1;$i++){ // tirage au sort et association question/value
		$array_rep=array('','','','');
		for($r=1;$r<5;$r++){
			$tirage=mt_rand(1,4);
			switch($tirage){
				case $array_rep[1]:;case $array_rep[2]:;case $array_rep[3]:;case $array_rep[4]:$r--;break;
				default:$array_rep[$r]=$tirage;
			}
		}
		$assoc.=$array_rep[1].$array_rep[2].$array_rep[3].$array_rep[4];
		$donnees.=($i==$count)?"0":"0,";
	}
	
	$sql=utf8_decode("UPDATE candidats SET nom='$nom',prenom='$prenom',email='$email',questions_posees='$liste',reponses_donnees='$donnees',date=CURRENT_TIMESTAMP,assoc='$assoc' WHERE ID_Candidat=$IDcan");
	try{$test_bdd_insert=$data->exec($sql) or die("Erreur d'insertion");}catch(Exception $e){die("Erreur d'enregistrement".$e->getMessage());}
	if($test_bdd_insert){
		setcookie('login','',time()-320000000,'/');
		setcookie('currq','',time()-320000000,'/');
		$_SESSION['login']=$email;
		$expire=time()+($temps*60);
		setcookie('login',$email,$expire,'/');
		setcookie('currq',1,0,'/');
		unset($_SESSION['permis']);
		redir('../quizz.php');
	}else{redir('../inscription.php');}
}
redir('../nouveau.php');
?>