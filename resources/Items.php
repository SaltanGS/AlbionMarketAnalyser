<?php

require_once(__DIR__."/../config/databaseConfig.php");

/**
 * Class with all functions working with items
 */
class Items {

	/**
	 * Get item icon
	 */
	public static function getIcon($item, $tier, $rarity) {

		$baseUrl = 'https://gameinfo.albiononline.com/api/gameinfo/items/';

		if ($rarity > 0 && $rarity <= 3) {
			$item .= '@'.$rarity;
		}

		return $baseUrl.'T'.$tier.'_'.$item.'.png';
	}

	/**
	 * Get the most recent prices of all items, for all tiers and for all rarities if they are provided
	 */
	public static function getLatestPrices($items, $city, $tiers = null, $rarities = null) {

		$dbConnection = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_BASE, DB_USER, DB_PASSWORD);
		$selectStatement = $dbConnection->prepare("SELECT price FROM item_latest_price WHERE item_id = ? AND city = ?");

		$prices = [];

		foreach ($items as $item) {
			if (!empty($tiers)) {
				foreach ($tiers as $tier) {

					$itemId = "T".$tier."_".$item;
					$itemRarityString = '';

					if (!empty($rarities)) {
						foreach ($rarities as $rarity) {

							if ($rarity > 0) {
								if ($tier > 3) {
									// Special case : resources
									if (Resources::isResource($item)) {
										$itemRarityString = Resources::RESOURCES_RARITY_KEY.$rarity;
									}
									$itemRarityString .= '@'.$rarity;
								} else {
									continue;
								}
							}

							$selectStatement->execute([$itemId.$itemRarityString, $city]);
							if($price = $selectStatement->fetchColumn()) {
								$prices[$item][$tier][$rarity] = $price;
							}
						}
					} else {
						$selectStatement->execute([$itemId, $city]);
						if($price = $selectStatement->fetchColumn()) {
							$prices[$item][$tier] = $price;
						}
					}
				}
			} else {
				$selectStatement->execute([$item, $city]);
				if($price = $selectStatement->fetchColumn()) {
					$prices[$item] = $price;
				}
			}
		}

		return $prices;
	}

	/**
	 * Get the minimum and maximum price of a list of items over X days.
	 */
	public static function getMinMaxPrices($items, $days, $city) {

		$minDate = date(DATE_ATOM, mktime(date("H") - 24 * $days));

		$dbConnection = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_BASE, DB_USER, DB_PASSWORD);
		$minStatement = $dbConnection->prepare("SELECT min(price) FROM item_prices_history WHERE item_id = ? AND updated_at > ? AND city = ?");
		$maxStatement = $dbConnection->prepare("SELECT max(price) FROM item_prices_history WHERE item_id = ? AND updated_at > ? AND city = ?");

		$currentPrices = static::getLatestPrices($items, $city);

		$prices = [];
		foreach ($items as $itemCode) {
			if (!empty($currentPrices[$itemCode])) {
				$prices[$itemCode]['current'] = $currentPrices[$itemCode];
				$minStatement->execute([$itemCode, $minDate, $city]);
				$prices[$itemCode]['min'] = $minStatement->fetchColumn();
				$maxStatement->execute([$itemCode, $minDate, $city]);
				$prices[$itemCode]['max'] =  $maxStatement->fetchColumn();
			}
		}

		return $prices;
	}

	/**
	* Calculate stats about price of items from current, min and max prices
	* Return array with all needed informations
	*/
	public static function getPricesStats($prices, $buyRange = 20, $sellRange = 30) {

	   	$stats = [];

		foreach ($prices as $itemCode => $itemDatas) {

			if (!empty($itemDatas['min']) && !empty($itemDatas['max']) ) {
				$currentPrice = $itemDatas['current'];
				$minPrice = $itemDatas['min'];
				$maxPrice = $itemDatas['max'];

				$priceTotalRange = $maxPrice - $minPrice;
				$buyLevel = $buyRange;
				$sellLevel = (100 - $sellRange);
				$currentLevel = round(($currentPrice - $minPrice)*100 / $priceTotalRange);
				$maxBuyPrice = round($minPrice + $priceTotalRange*$buyRange/100);

				$variation = round($priceTotalRange * 100 / $minPrice);

				$action = ($variation > 10 && $currentLevel <= $buyLevel) ? 'Buy' : (($variation > 10 && $currentLevel >= $sellLevel) ? 'Sell' : 'Wait');

				$stats[$itemCode]['currentPrice'] = $currentPrice;
				$stats[$itemCode]['minPrice'] = $minPrice;
				$stats[$itemCode]['maxPrice'] = $maxPrice;
				$stats[$itemCode]['variation'] = $variation.'%';
				$stats[$itemCode]['currentLevel'] = $currentLevel.'%';
				$stats[$itemCode]['maxBuyPrice'] = $maxBuyPrice;
				$stats[$itemCode]['action'] = $action;
			}
	   }

	   return $stats;
	}

	/**
	 * Get the prices of all items for each itemGroups, order by prices
	 */
	public static function getMostValuableItem($itemGroups, $city, $tiers, $rarities) {

		$return = [];

		foreach ($itemGroups as $itemGroup => $itemsType) {
			foreach ($itemsType as $itemsType => $itemsList) {
				$prices = static::getLatestPrices($itemsList, $city, $tiers, $rarities);

				foreach ($tiers as $tier) {
					foreach ($rarities as $rarity) {
						$return[$itemGroup][$tier][$rarity][$itemsType] = [];
						foreach ($itemsList as $item) {
							$itemPrice = $prices[$item][$tier][$rarity];
							if ($itemsType === 'ARMOR' ) {
								$itemPrice = round($itemPrice/2);
							}
							// Add the item at the begining of the array
							array_unshift($return[$itemGroup][$tier][$rarity][$itemsType], ['name' => $item, 'price' => $itemPrice]);
							// Sort array by price desc
							foreach ($return[$itemGroup][$tier][$rarity][$itemsType] as $key => $itemData) {
								if (isset($return[$itemGroup][$tier][$rarity][$itemsType][$key+1]) and
									$return[$itemGroup][$tier][$rarity][$itemsType][$key+1]['price'] > $itemPrice) {
									// Swap both value
									$tmp = $return[$itemGroup][$tier][$rarity][$itemsType][$key];
									$return[$itemGroup][$tier][$rarity][$itemsType][$key] = $return[$itemGroup][$tier][$rarity][$itemsType][$key+1];
									$return[$itemGroup][$tier][$rarity][$itemsType][$key+1] = $tmp;
								}
							}
						}
					}
				}
			}
		}
		return $return;
	}
}