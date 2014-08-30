<?php
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
function currentPageFile($url){return substr($url,strrpos($url,'/')+1,strrpos($url,'.')-1);} // récupère le nom de fichier courant

function authentification(){if(!sessionExist('staff')){redir('connexion.php');}} // teste si un admin est connecté
function sessionExist($cs){ // si cs existe, place le cookie en session et renvoie la valeur true, sinon false
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
?>