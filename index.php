<?
/*************************************************************************************
**												
** Script "EJP vers XML"
**
** Script qui retourne dans des donnn�es XML l'�tat des 4 zones EJP pour le jour courant
** et le lendemain
**												
** DjMomo - http://www.github.com/DjMomo/EJP_to_XML/
**
**************************************************************************************/

// URL de la page � parser
$URL = "http://particuliers.edf.com/gestion-de-mon-contrat/options-tempo-et-ejp/option-ejp/l-observatoire-2584.html";

// Ordre des zones sur la page
$zones = array("nord","paca","ouest","sud");

// Extraction des donn�es
$page = file_get_contents($URL);
preg_match_all("/(.*)FRONT\/NetExpress\/img\/ejp_(.*).png(.*)/", $page, $matches);
$ejp = $matches[2];

// Cr�ation donn�es XML
// Instance de la class DomDocument
$doc = new DOMDocument();

// Definition de la version et de l'encodage
$doc->version = '1.0';
$doc->encoding = 'UTF-8';
$doc->formatOutput = true;

// Ajout d'un commentaire a la racine
$comment_elt = $doc->createComment(utf8_encode('Etat des zones EJP pour aujourdhui et demain'));
$doc->appendChild($comment_elt);

// Cr�ation noeud principal
$racine = $doc->createElement('ejp');

// Ajout la balise 'update' a la racine
$version_elt = $doc->createElement('update',date("Y-m-d H:i"));
$racine->appendChild($version_elt);

for($i = 0;$i<sizeof($zones); $i++)
{
	$j = $i+7;
	// Zones
	$zone = $doc->createElement($zones[$i]);
	$aujourdhui = $doc->createElement('aujourdhui', $ejp[$i]);
	$demain = $doc->createElement('demain', $ejp[$j]);
	$zone->appendChild($aujourdhui);
	$zone->appendChild($demain);
	$racine->appendChild($zone);
}

// Fermeture noeud principal
$doc->appendChild($racine);

// Affichage XML
echo $doc->saveXML();

?>