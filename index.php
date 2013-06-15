<?
/*************************************************************************************
**												
** Script "EJP vers XML"
**
** Script qui retourne dans des donnnées XML l'état des 4 zones EJP pour le jour courant
** et le lendemain
**												
** DjMomo - http://www.github.com/DjMomo/EJP_to_XML/
**
**************************************************************************************/

// URL des pages à parser
$URL_obs = "http://particuliers.edf.com/gestion-de-mon-contrat/options-tempo-et-ejp/option-ejp/l-observatoire-2584.html";
$URL_histo = "http://edf-ejp-tempo.sfr-sh.fr/index.php?m=eh";

// Ordre des zones sur la page
$zones = array("nord","paca","ouest","sud");

// Extraction des données
// Etat EJP
$page = file_get_contents($URL_obs);
preg_match_all("/(.*)FRONT\/NetExpress\/img\/ejp_(.*).png(.*)/", $page, $matches);
$ejp = $matches[2];
// Nombre de jours restants
$page = file_get_contents($URL_histo);
preg_match_all("/(.*)<td(.*)>(.*)<\/td>(.*)/", $page, $matches);
$ejp_jours = $matches[3];

// Création données XML
// Instance de la class DomDocument
$doc = new DOMDocument();

// Definition de la version et de l'encodage
$doc->version = '1.0';
$doc->encoding = 'UTF-8';
$doc->formatOutput = true;

// Ajout d'un commentaire a la racine
$comment_elt = $doc->createComment(utf8_encode('Etat des zones EJP pour aujourdhui, demain et nombre de jours restants'));
$doc->appendChild($comment_elt);

// Création noeud principal
$racine = $doc->createElement('ejp');

// Ajout la balise 'update' a la racine
$version_elt = $doc->createElement('update',date("Y-m-d H:i"));
$racine->appendChild($version_elt);

for($i = 0;$i<sizeof($zones); $i++)
{
	$j = $i+7;
	$n = $i+1;
	// Zones
	$zone = $doc->createElement($zones[$i]);
	$aujourdhui = $doc->createElement('aujourdhui', $ejp[$i]);
	$demain = $doc->createElement('demain', $ejp[$j]);
	$jours_restants = $doc->createElement('jours_restants', $ejp_jours[$n]);
	$zone->appendChild($aujourdhui);
	$zone->appendChild($demain);
	$zone->appendChild($jours_restants);
	$racine->appendChild($zone);
}

// Fermeture noeud principal
$doc->appendChild($racine);

// Affichage XML
echo $doc->saveXML();

?>