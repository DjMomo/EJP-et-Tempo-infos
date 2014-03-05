EJP-et-Tempo-infos
==========

Un script PHP pour connaitre les jours EJP (jour courant, lendemain, nombre de jours restants) et les jours TEMPO (jour courant, lendemain, nombre de jours restants pour chaque couleur).

https://github.com/DjMomo/EJP-et-Tempo-infos

Evolutions :
------------
* 2014-03-05 - V1.3 - Fix dans le cas où aucun état EJP n'est renvoyé.
					- Amélioration du format XML dans les entêtes HTTP en sortie.
					- Projet renommé en EJP-et-Tempo-infos.
* 2014-01-23 - V1.2 - Retourne un booléen (1 ou 0) pour l'état EJP d'aujourd'hui et demain en plus du texte. Balises aujourdhui_bool et demain_bool.
* 2013-11-10 - V1.1 - Retourne désormais les couleurs TEMPO pour le jour courant et le lendemain et le nombre restant pour chacune d'elle.
* 2013-06-15 - V1.0 - Version initiale

Configuration :
---------------
Aucune

Utilisation :
-------------
Appeler index.php.
Retourne des données au format XML.
