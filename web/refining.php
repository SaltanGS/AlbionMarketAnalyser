<?php
/**
 * This page calculate all refining price and display all the informations used to calculed it.
 */

require_once(__DIR__."/../resources/Autoloader.php");

$rarities = (isset($_GET['rarity']) && $_GET['rarity'] >= 0 && $_GET['rarity'] <= 3) ? [$_GET['rarity']] : [0, 1, 2, 3] ;
$focus = isset($_GET['focus']) ? true : false ;
$taxe = isset($_GET['taxe']) ? $_GET['taxe'] : 22;
$city = isset($_GET['city']) ? $_GET['city'] : "Caerleon";

// In order to get T4.X refining profit, we always need T3.0 prices
$resourcesPrices = Resources::getResourcesLatestPrices($city, [2, 3, 4, 5, 6, 7, 8], array_merge([0], $rarities));
$refiningProfits = Resources::getResourcesRefiningProfit([2, 3, 4, 5, 6, 7, 8], $rarities, $resourcesPrices, $taxe, $focus);

if (isset($_GET['noJson'])) {
	echo 'Usage :<br/>
	noJson : Print this page<br/>
	rarity=X : Specifie a rarity.<br/>
	focus : With focus. Default is without<br/>
	taxe=XX : Refining building taxe. Default is 22%<br/>
	city=XXXX : XXXX can be : Thetford, Lymhurst, Bridgewatch, Martlock, Caerleon, FortSterling. Default is Caerleon<br/>
	Example : https://saltan.pouicou.fr/refining.php?noJson&rarity=2&focus&city=Martlock<br/>
	<br/>
	Data based on Albion Data Client : https://github.com/broderickhyman/albiondata-client';
	echo "<pre>".print_r($refiningProfits, true)."</pre>";
} else {
	print_r(json_encode($refiningProfits));
}