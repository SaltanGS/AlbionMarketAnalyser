<?php

require_once(__DIR__."/../resources/Autoloader.php");

/**
 * This page calculate the min / max price of all resources from the last X days
 */

$rarities = isset($_GET['rarity']) ? [$_GET['rarity']] : [0, 1] ;
$days = isset($_GET['days']) ? $_GET['days'] : 5;
$city = isset($_GET['city']) ? $_GET['city'] : "Caerleon";
$tiers = [3, 4, 5, 6, 7, 8];

$resourcesEnum = Resources::getResourcesEnumeration($tiers, $rarities);

// Get prices
$minMaxPrices = Items::getMinMaxPrices($resourcesEnum, $days, $city);
$stats = Items::getPricesStats($minMaxPrices);

if (isset($_GET['noJson'])) {
	SimpleFront::printRecursiveArray('Prices tracking on '.$days.' days', ['Item', 'Actual price', 'Min price', 'Max price', 'Range', 'action', 'Current level'], $stats);
} else {
	print_r(json_encode($stats));
}