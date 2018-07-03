<?php

require_once(__DIR__."/../resources/Autoloader.php");

/**
 * This page calculate the min / max price of all resources from the last X days
 */

$rarities = isset($_GET['rarity']) ? [$_GET['rarity']] : [0, 1] ;
$days = isset($_GET['days']) ? $_GET['days'] : 5;
$city = isset($_GET['city']) ? $_GET['city'] : "Caerleon";
$tiers = [5, 6, 7, 8];

$items = [
	'PLANKS' => [
					'BOW' => ['2H_BOW', '2H_WARBOW', '2H_LONGBOW']
				],
	'CLOTH' => [
					'HELMET' => ['HEAD_CLOTH_SET1', 'HEAD_CLOTH_SET2', 'HEAD_CLOTH_SET3'],
					'ARMOR' => ['ARMOR_CLOTH_SET1', 'ARMOR_CLOTH_SET2', 'ARMOR_CLOTH_SET3'],
					'SHOES' => ['SHOES_CLOTH_SET1', 'SHOES_CLOTH_SET2', 'SHOES_CLOTH_SET3'],
					'FIBER' => ['HEAD_GATHERER_FIBER', 'ARMOR_GATHERER_FIBER', 'SHOES_GATHERER_FIBER'],
				],
	'LEATHER' => [
					'HELMET' => ['HEAD_LEATHER_SET1', 'HEAD_LEATHER_SET2', 'HEAD_LEATHER_SET3'],
					'ARMOR' => ['ARMOR_LEATHER_SET1', 'ARMOR_LEATHER_SET2', 'ARMOR_LEATHER_SET3'],
					'SHOES' => ['SHOES_LEATHER_SET1', 'SHOES_LEATHER_SET2', 'SHOES_LEATHER_SET3'],
					'HIDE' => ['HEAD_GATHERER_HIDE', 'ARMOR_GATHERER_HIDE', 'SHOES_GATHERER_HIDE'],
					'WOOD' => ['HEAD_GATHERER_WOOD', 'ARMOR_GATHERER_WOOD', 'SHOES_GATHERER_WOOD'],
				],
	'METALBAR' => [
					'HELMET' => ['HEAD_PLATE_SET1', 'HEAD_PLATE_SET2', 'HEAD_PLATE_SET3'],
					'ARMOR' => ['ARMOR_PLATE_SET1', 'ARMOR_PLATE_SET2', 'ARMOR_PLATE_SET3'],
					'SHOES' => ['SHOES_PLATE_SET1', 'SHOES_PLATE_SET2', 'SHOES_PLATE_SET3'],
					'ROCK' => ['HEAD_GATHERER_ROCK', 'ARMOR_GATHERER_ROCK', 'SHOES_GATHERER_ROCK'],
					'ORE' => ['HEAD_GATHERER_ORE', 'ARMOR_GATHERER_ORE', 'SHOES_GATHERER_ORE'],
				]
];

$data['title'] = "Crafting guide";
// Get prices
$data['mostValuableItems'] = Items::getMostValuableItem($items, $city, $tiers, $rarities);

if (isset($_GET['noJson'])) {
	SimpleFront::printTemplate('crafting', $data);
} else {
	print_r(json_encode($data['mostValuableItems']));
}