<?php

/**
 * Class containing all crafting recipes
 * More recipes on https://www.albiononline2d.com/en/item
 * In ao2d.com, foods recipes craft 10 items, potions recipes craft 5 items
 */

Class CraftingRecipes {

	/**
	 * Return array of recipes
	 */
	public static function getRecipeList($itemGroup = 'all') {

		// Ressources : ['PLANKS', 'METALBAR', 'LEATHER', 'CLOTH', 'STONEBLOCK']
		$recipes = [
			'accessories' => [
				'bag' => [
					'BAG' => [0,0,8,8,0]
				],
				'cape' => [
					'CAPE' => [0,0,4,4,0]
				]
			],
			'armor' => [
				'cloth_helmet' => [
					'HEAD_CLOTH_SET1' => [0,0,0,8,0],
					'HEAD_CLOTH_SET2' => [0,0,0,8,0],
					'HEAD_CLOTH_SET3' => [0,0,0,8,0]
				],
				'cloth_armor' => [
					'ARMOR_CLOTH_SET1' => [0,0,0,16,0],
					'ARMOR_CLOTH_SET2' => [0,0,0,16,0],
					'ARMOR_CLOTH_SET3' => [0,0,0,16,0]
				],
				'cloth_shoes' => [
					'SHOES_CLOTH_SET1' => [0,0,0,8,0],
					'SHOES_CLOTH_SET2' => [0,0,0,8,0],
					'SHOES_CLOTH_SET3' => [0,0,0,8,0]
				],
				'leather_helmet' => [
					'HEAD_LEATHER_SET1' => [0,0,8,0,0],
					'HEAD_LEATHER_SET2' => [0,0,8,0,0],
					'HEAD_LEATHER_SET3' => [0,0,8,0,0]
				],
				'leather_armor' => [
					'ARMOR_LEATHER_SET1' => [0,0,16,0,0],
					'ARMOR_LEATHER_SET2' => [0,0,16,0,0],
					'ARMOR_LEATHER_SET3' => [0,0,16,0,0]
				],
				'leather_shoes' => [
					'SHOES_LEATHER_SET1' => [0,0,8,0,0],
					'SHOES_LEATHER_SET2' => [0,0,8,0,0],
					'SHOES_LEATHER_SET3' => [0,0,8,0,0]
				],
				'plate_helmet' => [
					'HEAD_PLATE_SET1' => [0,8,0,0,0],
					'HEAD_PLATE_SET2' => [0,8,0,0,0],
					'HEAD_PLATE_SET3' => [0,8,0,0,0]
				],
				'plate_armor' => [
					'ARMOR_PLATE_SET1' => [0,16,0,0,0],
					'ARMOR_PLATE_SET2' => [0,16,0,0,0],
					'ARMOR_PLATE_SET3' => [0,16,0,0,0]
				],
				'plate_shoes' => [
					'SHOES_PLATE_SET1' => [0,8,0,0,0],
					'SHOES_PLATE_SET2' => [0,8,0,0,0],
					'SHOES_PLATE_SET3' => [0,8,0,0,0]
				],
			],
			'ranged' => [
				'bow' => [
					'2H_BOW' => [32,0,0,0,0],
					'2H_LONGBOW' => [32,0,0,0,0],
					'2H_WARBOW' => [32,0,0,0,0]
				]
			],
		];

		if (isset($recipes[$itemGroup])) {
			return [$itemGroup => $recipes[$itemGroup]];
		} else {
			return $recipes;
		}
	}
}
