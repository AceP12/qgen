<?php require_once"req/connect.php";require_once"inc/functions.php";
if(session_id()==''){session_start();}
if(!sessionExist('login')){redir('nouveau.php');} // si la variable de session login n'existe pas cela siginifie que le visiteur n'a pas de session ouverte, il n'est donc pas logué ni autorisé à acceder au quizz

$email=$_SESSION['login'];

if($temps_imparti===0){$temps_imparti=1;}

$sql="SELECT * FROM candidats WHERE email='$email'";
$req=mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data=mysql_fetch_assoc($req);
$date=$data['date'];

$Dannee=date('Y',strtotime($data['date']));$Dmois=date('m',strtotime($data['date']));$Djour=date('d',strtotime($data['date']));$Heure=date('H:i:s',strtotime($data['date']));
$QQuand=explode(":",$Heure);$Dheure=$QQuand[0];$Dminute=$QQuand[1];$Dseconde=$QQuand[2];

$To=date("Y-m-d H:i:s",strtotime($date)+($temps_imparti*60));
$Fannee=date('Y',strtotime($To));$Fmois=date('m',strtotime($To));$Fjour=date('d',strtotime($To));$FFHeure=date('H:i:s',strtotime($To));
$FQuand=explode(":",$FFHeure);$Fheure=$FQuand[0];$Fminute=$FQuand[1];$Fseconde=$FQuand[2];  

$Date_serveur=date("Y-m-d H:i:s");$Mannee=date('Y',strtotime($Date_serveur));$Mmois=date('m',strtotime($Date_serveur));$Mjour=date('d',strtotime($Date_serveur));$MMHeure=date('H:i:s',strtotime($Date_serveur));
$MQuand=explode(":",$MMHeure);$Mheure=$MQuand[0];$Mminute=$MQuand[1];$Mseconde=$MQuand[2];

$diff=strtotime($To)-strtotime($Date_serveur);

if($diff<=0){ // détruit la session et les cookies
	session_unset();session_destroy();setcookie('expir');setcookie('login');setcookie('currq');
	redir('accueil.php');
}
?>
<script type="text/javascript">
	var compte=<?=$diff?>;

	function decompte(){

		var tps = compte;
		var m=Math.floor(tps/60);
		tps=tps % 60;
		var s=Math.floor(tps);

		var mm=(m<10)?"0"+m:m;
		var ss=(s<10)?"0"+s:s;

		var txt=mm+"m"+ss+""; 	
		document.getElementById('chrono').innerHTML=txt+"s";
		if(mm==0){document.getElementById('chrono').style.color='#f00';}
		if(ss==0){document.getElementById('ecoule').value=<?=$temps_imparti?>-mm;}

		if(compte==0||compte<0){
			compte=0;
			clearInterval(timer);
			document.formulq.submit();
		}
		compte--;
	}

	var timer = setInterval('decompte()',950);

	var dmaint = new Date(<?=$Mannee?>, <?=$Mmois?>, <?=$Mjour?>, <?=$Mheure?>, <?=$Mminute?>, <?=$Mseconde?>);
	var dfin = new Date(<?=$Fannee?>, <?=$Fmois?>, <?=$Fjour?>, <?=$Fheure?>, <?=$Fminute?>, <?=$Fseconde?>);


	function delai(annee,mois,jour,heure,min,sec) {
		var date_fin=new Date(annee,mois,jour,heure,min,sec)
		var date_jour=new Date(<?=$Mannee?>, <?=$Mmois?>, <?=$Mjour?>, <?=$Mheure?>, <?=$Mminute?>,<?=$Mseconde?>);

		var tps=(date_fin.getTime()-date_jour.getTime())/1000;
		var j=Math.floor(tps/3600/24);
		tps=tps % (3600*24);
		var h=Math.floor(tps / 3600);
		tps=tps % 3600;
		var m=Math.floor(tps/60);
		tps=tps % 60;
		var s=Math.floor(tps);

		var mm=(m<10)?"0"+m:m;
		var ss=(s<10)?"0"+s:s;

		if(h<0){h="0";mm="0";ss="0";
		}else{var mm=m;
		}

		var txt=(j>1)? j+" jours "+h+"h"+mm+"m"+ss+"":(j==1)? j+" jour "+h+"h"+mm+"m"+ss+"":h+"h"+mm+"m"+ss+"";

		txt="Restant "+txt;
		return txt;
	}
</script>