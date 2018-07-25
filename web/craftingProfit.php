<?php

// Set error display
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once(__DIR__."/../resources/Autoloader.php");

/**
 * This page show crafting profit, ignoring crafting taxe and profit from journals
 */

$rarities = isset($_GET['rarity']) ? [$_GET['rarity']] : [0, 1] ;
$city = isset($_GET['city']) ? $_GET['city'] : "Caerleon";
$tiers = [4, 5, 6, 7, 8];

$data['title'] = "Crafting profit calculator";
$data['profitData'] = Items::getCraftingProfits('all', $city, $tiers, $rarities);

if (isset($_GET['json'])) {
	print_r(json_encode($data['profitData']));
} else {
	SimpleFront::printTemplate('craftingProfit', $data);
}