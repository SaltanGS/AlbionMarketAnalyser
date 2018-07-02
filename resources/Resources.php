<?php

/**
 * Class with all functions about resources
 */
class Resources {

	const RESOURCES_RARITY_KEY = '_LEVEL';

	/**
	 * Return raw resources with their corresponding refining counterpart
	 */
	public static function getResourcesList() {

		$resourcesTypes = [
			"WOOD" => "PLANKS",
		 	"ORE" => "METALBAR",
		 	"HIDE" => "LEATHER",
		 	"FIBER" => "CLOTH",
		 	"ROCK" => "STONEBLOCK"
		];

		return $resourcesTypes;
	}

	/**
	 * Get resource icon
	 */
	public static function getIcon($resource, $tier, $rarity) {

		$baseUrl = 'https://s3-us-west-2.amazonaws.com/ao2d/images/items/';

		if ($rarity > 0 && $rarity <= 3) {
			$resource .= '_LEVEL'.$rarity;
		}

		return $baseUrl.'T'.$tier.'_'.$resource.'.png';
	}

	/**
	 * Return raw and refined resources
	 */
	public static function getResourcesFullList() {

		$resources = static::getResourcesList();

		$resourceList = array_merge(array_keys($resources), $resources);

		return $resourceList;
	}

	/**
	 * Return true if the item is a resource, false otherwise
	 */
	public static function isResource($resource) {

		return in_array($resource, static::getResourcesFullList());
	}

	/**
	 * Return raw or/and refined resources by tier and rarity
	 */
	public static function getResourcesEnumeration($tiers, $rarities, $refinedOnly) {

		$enumeration = [];

		if($refinedOnly) {
			$resourcesTypes = static::getResourcesList();
		} else {
			$resourcesTypes = static::getResourcesFullList();
		}

		foreach ($tiers as $tier) {
			foreach ($rarities as $rarity) {
				foreach ($resourcesTypes as $resourceType) {
					$resourceCode = 'T'.$tier.'_'.$resourceType;

					if ($rarity > 0 && $tier > 3 && $resourceType !== 'ROCK' && $resourceType !== "STONEBLOCK") {
						$resourceCode .= self::RESOURCES_RARITY_KEY.$rarity.'@'.$rarity;
					}

					$enumeration[] = $resourceCode;
				}
			}
		}

		return $enumeration;
	}

	/**
	 * Get the most recent prices of all resources, for all tiers and for all rarities if they are provided
	 */
	public static function getResourcesLatestPrices($city, $tiers = null, $rarities = null) {

	    return Items::getLatestPrices(static::getResourcesFullList(), $city, $tiers, $rarities);
	}

	/**
	* Calculate full refining profit assuming the resources returned after first refining are sold back to their buying price
	* $tiers = [1, 3, 5]
	* $rarities = [0, 1, 2, 3]
	* $resourcesPrices = based on getLatestPrices return
	* $taxe = taxe in %
	* $focus = (true|false) : is focus used ?
	* Return array with all needed informations
	*/
	public static function getResourcesRefiningProfit($tiers, $rarities, $resourcesPrices, $taxe, $focus) {

	   $return = [];

		// Special case : T3 doesn't have a rarity but we fake it to keep the algorithm simple
	   	// T1 is set to 0 to emulate the fact that T2 do not require T1 to be refined.
	   	foreach (static::getResourcesFullList() as $resourceType) {
			$resourcesPrices[$resourceType][1][0] = 0;
			$resourcesPrices[$resourceType][1][1] = 0;
			$resourcesPrices[$resourceType][1][2] = 0;
			$resourcesPrices[$resourceType][1][3] = 0;

			if (!empty($resourcesPrices[$resourceType][3][0])) {
				$resourcesPrices[$resourceType][3][1] = $resourcesPrices[$resourceType][3][0];
				$resourcesPrices[$resourceType][3][2] = $resourcesPrices[$resourceType][3][0];
				$resourcesPrices[$resourceType][3][3] = $resourcesPrices[$resourceType][3][0];
			}
		}

		// For tier $key you need $value raw ressources
		$rawResourcesNeeded = [
		   2 => 1,
		   3 => 2,
		   4 => 2,
		   5 => 3,
		   6 => 4,
		   7 => 5,
		   8 => 5
		];

		// Item value of all refined resources by tiers / rarity
		$refinedResourcesValues = [
		  2 => [0 => 0], // It's 2 in reality, but crafting fee is null for T2
		  3 => [0 => 6],
		  4 => [
					0 => 14,
					1 => 30,
					2 => 54,
					3 => 102
				],
		  5 => [
					0 => 30.02,
					1 => 61.98,
					2 => 118.02,
					3 => 229.98
				],
		  6 => [
					0 => 62.02,
					1 => 125.98,
					2 => 246.02,
					3 => 485.98
				],
		  7 => [
					0 => 126.02,
					1 => 253.98,
					2 => 502.02,
					3 => 997.98
				],
		  8 => [
					0 => 254.02,
					1 => 509.98,
					2 => 1014.02,
					3 => 2021.98
				]
		];

	   	foreach (static::getResourcesList() as $rawResourceType => $refinedResourceType) {
		   	foreach ($tiers as $tier) {
				foreach($rarities as $rarity) {
		   			if (isset($resourcesPrices[$rawResourceType][$tier][$rarity]) && isset($resourcesPrices[$refinedResourceType][$tier][$rarity]) && isset($resourcesPrices[$refinedResourceType][($tier-1)][$rarity])) {

						$refiningTaxe = ceil($refinedResourcesValues[$tier][$rarity] * 5 * $taxe / 100);
						// Profit = Selling price * return rate (base on 15% rr) * (1- selling taxes) - (resource cost + crafting taxes)
						// Selling taxe : 2% selling taxe + 1% per sale order, made 2 times if the first one fail
						// Return rate : 100%-45% with focus, 100% - 15% without.
						$resourcesUse = $focus ? 0.55 : 0.85 ;
						$resourcesCost = $resourcesPrices[$refinedResourceType][($tier-1)][$rarity] + $resourcesPrices[$rawResourceType][$tier][$rarity] * $rawResourcesNeeded[$tier];
						$profit = round($resourcesPrices[$refinedResourceType][$tier][$rarity]*0.96
							- ($resourcesCost*$resourcesUse + $refiningTaxe));

						$return[$refinedResourceType][$tier][$rarity] = [
							"unit_raw_resource_cost" => $resourcesPrices[$rawResourceType][$tier][$rarity],
							"unit_refined_resource_cost" => $resourcesPrices[$refinedResourceType][($tier-1)][$rarity],
							"refined_selling_price" => $resourcesPrices[$refinedResourceType][$tier][$rarity],
							"taxe" => $refiningTaxe,
							"profit" => $profit,
							"profitable" => ($profit > 0) ? 'YES' : 'NO'
						];
					}
				}
		   }
	   }

	   return $return;
	}
}