<?php
// prototype de gestion de niveau de permissions
$god=false;
$supadmin=false;
$admin=false;
$crea=false;
$guest=false;

$level=50;

switch($level){
	case 50:$god=true;
	case 40:$supadmin=true;
	case 30:$admin=true;
	case 20:$crea=true;
	case 10:$guest=true;break;
}

// variables globales d'indentation du code source
$t3="\t\t\t";
$t4="\t\t\t\t";
$t5="\t\t\t\t\t";
$t6="\t\t\t\t\t\t";
$t7="\t\t\t\t\t\t\t";
$t8="\t\t\t\t\t\t\t\t";
$t9="\t\t\t\t\t\t\t\t\t";

// fonctions
function redir($page){header("location:$page");exit();} // redirige la page
function currentPageFile($url){return substr($url,strrpos($url,'/')+1,strrpos($url,'.')-1);} // renvoie le nom de fichier de l'url

function authentification(){if(!sessionExist('staff')){redir('connexion.php');}} // teste si un admin est connecté
function sessionExist($cs){ // s'il existe, place le cookie en session et renvoie la valeur true, sinon false
	if(session_id()==''){session_start();}
	if(!isset($_SESSION[$cs])||empty($_SESSION[$cs])){
		if(empty($_COOKIE[$cs])){$r=false;}else{$s=$_COOKIE[$cs];$_SESSION[$cs]=$s;$r=true;}
	}else{$r=true;}
	return $r;
}

function contentTitle($title){global $t4;return"$t4<h2>$title</h2>\n";} // retourne titre
function contentTitleMin($title){global $t4;return"$t4<h4>$title</h4>\n";} // retourne titre réduit
function contentDesc($description){global $t4;return"$t4<hr>\n$t4<p>$description</p>\n";}// retourne description du contenu

function safeData($str){return str_replace('</script>','',str_replace('<script','',str_replace("=","",mysql_real_escape_string($str))));}// retourne une chaîne sans <script>,sans = et echappée
function scriptReplace($str){return str_replace('</script>','',str_replace('<script','',mysql_real_escape_string($str)));}// retourne une chaîne sans <script> et echappée
function infoReplace($str){return str_replace("'",'&#39;',$str);}// retourne une chaîne formatée pour attribut title

function formatDate($date){if($date){$date=explode(" ",$date);$heure=$date[1];$date=explode("-",$date[0]);return"$date[2]/$date[1]/$date[0] $heure";}}// retourne la date au format jj/mm/aaaa

function checkbox($id,$ID_main){ // case à cocher Voir selon le niveau de permissions (admin) et si le tableau n'est pas en mode compact
	global $admin,$compact,$line_n,$class_cat;
	return ($admin && !$compact)? "<td class='td$class_cat'><input ".(($line_n['visible'])?"checked ":"")."type='checkbox' id='chk_"."$id' class='chk' name='d' value='$ID_main' onchange='saveCheckState(this.id)'/></td>":"";
}
function masquer($id,$ID_main){ // case à cocher Voir selon le niveau de permissions (admin) et si le tableau n'est pas en mode compact
	global $admin,$compact,$class_cat;
	return ($admin && !$compact)? "<td class='td$class_cat'><span class='btn-view' title='Retirer le candidat $ID_main du tableau des scores' onmousedown='maskID($ID_main)' onmouseup='window.location.reload()'></span></td>":"";
}
function viewQuestions($id,$ID_main){ // case à cocher Voir selon le niveau de permissions (admin) et si le tableau n'est pas en mode compact
	global $admin,$compact,$class_cat;
	return ($admin && !$compact)? "$t6<tr><td class='td$class_cat'><span class='btn-view visualiser-questionnaire' title='Voir le questionnaire du candidat $ID_main' onmousedown='redirAnswers($ID_Candidat)' onmouseup='window.location.reload()'></span></td>":"";
}
function addFormButton($title){ // bouton Ajouter visible selon le niveau de permissions (crea) et si le tableau n'est pas en mode compact
	global $crea,$compact;
	return ($crea && !$compact)? " <input value='ajouter >' title='$title' alt='$title' class='add' type='button' onclick='".'document.getElementById("addformbox").style.display="block";'."'/>":"";
}

// gestion de séparation et couleurs alternatives entre domaines et catégories différents dans les tableaux
$old_ID_dom=0;$class_dom="";$old_ID_cat=0;$class_cat="";
function initIDs(){global $old_ID_dom,$old_ID_cat,$class_dom,$class_cat; $old_ID_dom=0;$old_ID_cat=0;$class_dom="";$class_cat="";} // initialise les anciens ID pour la fonction separByID()
function separByID($current_id,$target){global $old_ID_dom,$old_ID_cat,$class_dom,$class_cat,$t5,$TOTALCOLS;
	if($target!="cat"){$target="dom";}
	$old=${'old_ID_'.$target}; $separ="";// $class=;
	if($old){ // si l'ancien ID a déjà été actualisé (alors l'en-tête des colonnes est déjà passé)
		if($current_id!=$old){ // si le nouvel ID est différent de l'ancien alors on insère une ligne séparatrice dans le tableau
			${'class_'.$target}=(${'class_'.$target})?"":"-alt";
			$separ=($target=="dom")?"$t5<tr class='tr-separ-dom'><td colspan='".($TOTALCOLS-1)."'></td></tr>\n":"";
		}
	}
	${'old_ID_'.$target}=$current_id; // on actualise l'ancien ID du domaine
	return $separ;
}
?>