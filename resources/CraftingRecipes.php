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

		$recipes = [
			'accessories' => [
				'bag' => [
					'BAG' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 8, 'STONEBLOCK' => 0]
				],
				'cape' => [
					'CAPE' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 4, 'CLOTH' => 4, 'STONEBLOCK' => 0]
				]
			],
			'armor' => [
				'cloth_helmet' => [
					'HEAD_CLOTH_SET1' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 8, 'STONEBLOCK' => 0],
					'HEAD_CLOTH_SET2' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 8, 'STONEBLOCK' => 0],
					'HEAD_CLOTH_SET3' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 8, 'STONEBLOCK' => 0]
				],
				'cloth_armor' => [
					'ARMOR_CLOTH_SET1' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 16, 'STONEBLOCK' => 0],
					'ARMOR_CLOTH_SET2' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 16, 'STONEBLOCK' => 0],
					'ARMOR_CLOTH_SET3' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 16, 'STONEBLOCK' => 0]
				],
				'cloth_shoes' => [
					'SHOES_CLOTH_SET1' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 8, 'STONEBLOCK' => 0],
					'SHOES_CLOTH_SET2' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 8, 'STONEBLOCK' => 0],
					'SHOES_CLOTH_SET3' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 8, 'STONEBLOCK' => 0]
				],
				'leather_helmet' => [
					'HEAD_LEATHER_SET1' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'HEAD_LEATHER_SET2' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'HEAD_LEATHER_SET3' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0]
				],
				'leather_armor' => [
					'ARMOR_LEATHER_SET1' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 16, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'ARMOR_LEATHER_SET2' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 16, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'ARMOR_LEATHER_SET3' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 16, 'CLOTH' => 0, 'STONEBLOCK' => 0]
				],
				'leather_shoes' => [
					'SHOES_LEATHER_SET1' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'SHOES_LEATHER_SET2' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'SHOES_LEATHER_SET3' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0]
				],
				'plate_helmet' => [
					'HEAD_PLATE_SET1' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'HEAD_PLATE_SET2' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'HEAD_PLATE_SET3' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0]
				],
				'plate_armor' => [
					'ARMOR_PLATE_SET1' => ['PLANKS' => 0, 'METALBAR' => 16, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'ARMOR_PLATE_SET2' => ['PLANKS' => 0, 'METALBAR' => 16, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'ARMOR_PLATE_SET3' => ['PLANKS' => 0, 'METALBAR' => 16, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0]
				],
				'plate_shoes' => [
					'SHOES_PLATE_SET1' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'SHOES_PLATE_SET2' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'SHOES_PLATE_SET3' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0]
				],
			],
			'gatherergear' => [
				'fiber' => [
					'HEAD_GATHERER_FIBER' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 8, 'STONEBLOCK' => 0],
					'ARMOR_GATHERER_FIBER' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 8, 'STONEBLOCK' => 0],
					'SHOES_GATHERER_FIBER' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 8, 'STONEBLOCK' => 0],
					'BACKPACK_GATHERER_FIBER' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 4, 'CLOTH' => 4, 'STONEBLOCK' => 0]
				],
				'hide' => [
					'HEAD_GATHERER_HIDE' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'ARMOR_GATHERER_HIDE' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'SHOES_GATHERER_HIDE' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'BACKPACK_GATHERER_HIDE' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 4, 'CLOTH' => 4, 'STONEBLOCK' => 0]
				],
				'wood' => [
					'HEAD_GATHERER_WOOD' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'ARMOR_GATHERER_WOOD' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'SHOES_GATHERER_WOOD' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'BACKPACK_GATHERER_WOOD' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 4, 'CLOTH' => 4, 'STONEBLOCK' => 0]
				],
				'fish' => [
					'HEAD_GATHERER_FISH' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'ARMOR_GATHERER_FISH' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'SHOES_GATHERER_FISH' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 8, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'BACKPACK_GATHERER_FISH' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 4, 'CLOTH' => 4, 'STONEBLOCK' => 0]
				],
				'rock' => [
					'HEAD_GATHERER_ROCK' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'ARMOR_GATHERER_ROCK' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'SHOES_GATHERER_ROCK' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'BACKPACK_GATHERER_ROCK' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 4, 'CLOTH' => 4, 'STONEBLOCK' => 0]
				],
				'ore' => [
					'HEAD_GATHERER_ORE' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'ARMOR_GATHERER_ORE' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'SHOES_GATHERER_ORE' => ['PLANKS' => 0, 'METALBAR' => 8, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'BACKPACK_GATHERER_ORE' => ['PLANKS' => 0, 'METALBAR' => 0, 'LEATHER' => 4, 'CLOTH' => 4, 'STONEBLOCK' => 0]
				],
			],
			'ranged' => [
				'bow' => [
					'2H_BOW' => ['PLANKS' => 32, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'2H_LONGBOW' => ['PLANKS' => 32, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'2H_WARBOW' => ['PLANKS' => 32, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0]
				]
			],
			'tools' => [
				'tools' => [
					'2H_TOOL_SIEGEHAMMER' => ['PLANKS' => 8, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 8],
					'2H_TOOL_AXE' => ['PLANKS' => 6, 'METALBAR' => 2, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'2H_TOOL_PICK' => ['PLANKS' => 6, 'METALBAR' => 2, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'2H_TOOL_KNIFE' => ['PLANKS' => 6, 'METALBAR' => 2, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'2H_TOOL_SICKLE' => ['PLANKS' => 6, 'METALBAR' => 2, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'2H_TOOL_HAMMER' => ['PLANKS' => 6, 'METALBAR' => 2, 'LEATHER' => 0, 'CLOTH' => 0, 'STONEBLOCK' => 0],
					'2H_TOOL_FISHINGROD' => ['PLANKS' => 6, 'METALBAR' => 0, 'LEATHER' => 0, 'CLOTH' => 2, 'STONEBLOCK' => 0],
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
