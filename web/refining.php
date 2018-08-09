<?php

// Set error display
error_reporting(E_ALL);
ini_set('display_errors', 'On');

/**
 * This page calculate all refining price and display all the informations used to calculed it.
 */

require_once(__DIR__."/../resources/Autoloader.php");

$rarities = (isset($_GET['rarity']) && $_GET['rarity'] >= 0 && $_GET['rarity'] <= 3) ? [$_GET['rarity']] : [0, 1, 2, 3] ;
$focus = isset($_GET['focus']) ? true : false ;
$taxe = isset($_GET['taxe']) ? $_GET['taxe'] : 22;

// In order to get T4.X refining profit, we always need T3.0 prices
$resourcesPrices = Resources::getResourcesLatestPrices("Caerleon", [2, 3, 4, 5, 6, 7, 8], array_merge([0], $rarities));
$refiningProfits = Resources::getResourcesRefiningProfit([2, 3, 4, 5, 6, 7, 8], $rarities, $resourcesPrices, $taxe, $focus);

if (isset($_GET['json'])) {
	print_r(json_encode($refiningProfits));
} else {
	echo 'Usage :<br/>
	rarity=X : Specifie a rarity.<br/>
	focus : With focus. Default is without<br/>
	taxe=XX : Refining building taxe. Default is 22%<br/>
	Example : https://saltan.pouicou.fr/refining.php?rarity=2&focus&taxe=12<br/>
	<br/>
	Prices and refining bonus based on Caerleon city<br/>
	<br/>
	Data based on Albion Data Client : https://github.com/broderickhyman/albiondata-client';
	SimpleFront::printRecursiveArray('Refining profit finder', ['Item', 'Tier', 'Rarity', 'Raw resource', 'T-1 refined resource', 'Selling price', 'Taxe', 'Profit', 'Profitable ?'], $refiningProfits);
}