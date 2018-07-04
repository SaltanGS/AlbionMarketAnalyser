<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="views/css/crafting.css">

		<title>Albion Market Manager</title>
	</head>
	<body>
		<h1><?= $data['title'] ?></h1>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#search").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#mostValuableItemsTable .dataline").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
			function setFilter() {
				var resource = $("input[name=resourceFilter]:checked").val();
				var tier = $("input[name=tierFilter]:checked").val();
				var rarity = $("input[name=rarityFilter]:checked").val();
				$("#mostValuableItemsTable .dataline").each(function() {
					if (   $(this).text().indexOf(resource) > -1
						&& $(this).text().indexOf(tier) > -1
						&& $(this).text().indexOf(rarity) > -1) {
						$(this).show();
					} else {
						$(this).hide();
					}
				});
			}
			$(document).ready(function(){
				$("input[name=resourceFilter]").on("change", function(event) {
				     setFilter();
				});
			});
			$(document).ready(function(){
				$("input[name=tierFilter]").on("change", function(event) {
				     setFilter();
				});
			});
			$(document).ready(function(){
				$("input[name=rarityFilter]").on("change", function(event) {
				     setFilter();
				});
			});
		</script>
		<p class="filter">
			Filter : <input type="text" id="search"> --
			<label>
			  <input type="radio" name="resourceFilter" value="" checked/>
			  <img name="TRASH" src="<?= Resources::getIcon('TRASH', 8, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="resourceFilter" value="PLANKS" />
			  <img name="PLANKS" src="<?= Resources::getIcon('PLANKS', 8, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="resourceFilter" value="CLOTH" />
			  <img name="CLOTH" src="<?= Resources::getIcon('CLOTH', 8, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="resourceFilter" value="LEATHER" />
			  <img name="LEATHER" src="<?= Resources::getIcon('LEATHER', 8, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="resourceFilter" value="METALBAR" />
			  <img name="METALBAR" src="<?= Resources::getIcon('METALBAR', 8, 0) ?>" />
			</label>
			--
			<label>
			  <input type="radio" name="tierFilter" value="" checked />
			  <img name="TRASH" src="<?= Resources::getIcon('TRASH', 8, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="tierFilter" value="T5" />
			  <img name="T5" src="<?= Items::getIcon('OFF_ORB_MORGANA', 5, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="tierFilter" value="T6" />
			  <img name="T6" src="<?= Items::getIcon('OFF_ORB_MORGANA', 6, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="tierFilter" value="T7" />
			  <img name="T7" src="<?= Items::getIcon('OFF_ORB_MORGANA', 7, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="tierFilter" value="T8" />
			  <img name="T8" src="<?= Items::getIcon('OFF_ORB_MORGANA', 8, 0) ?>" />
			</label>
			--
			<label>
			  <input type="radio" name="rarityFilter" value="" checked />
			  <img name="TRASH" src="<?= Resources::getIcon('TRASH', 8, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="rarityFilter" value="R0" />
			  <img name="R0" src="<?= Items::getIcon('OFF_ORB_MORGANA', 8, 0) ?>" />
			</label>
			<label>
			  <input type="radio" name="rarityFilter" value="R1" />
			  <img name="R1" src="<?= Items::getIcon('OFF_ORB_MORGANA', 8, 1) ?>" />
			</label>
		</p>

		<table id="mostValuableItemsTable" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr><th>Groupe</th><th>Type</th><th>1st Item</th><th>Price</th><th>2nd Item</th><th>Price</th><th>3rd Item</th><th>Price</th></tr>
			</thead>
			<tbody>
				<?php
					foreach ($data['mostValuableItems'] as $itemGroup => $tiers) {
						foreach ($tiers as $tier => $rarities) {
							foreach ($rarities as $rarity => $itemsType) {
								foreach ($itemsType as $itemType => $itemsInfos) {
									echo '
										<tr class="dataline">
											<td><img src="'.Resources::getIcon($itemGroup, $tier, $rarity).'"/>'.$itemGroup.'_T'.$tier.'_R'.$rarity.'</td>
											<td><img src="'.Items::getIcon($itemsInfos[0]['name'], $tier, $rarity).'"/></td>
											<td><strong>'.number_format($itemsInfos[0]['price'], 0, '.', ' ').'</strong></td>
											<td><img src="'.Items::getIcon($itemsInfos[1]['name'], $tier, $rarity).'"/></td>
											<td>'.number_format($itemsInfos[1]['price'], 0, '.', ' ').'</td>
											<td><img src="'.Items::getIcon($itemsInfos[2]['name'], $tier, $rarity).'"/></td>
											<td>'.number_format($itemsInfos[2]['price'], 0, '.', ' ').'</td>
										</tr>';
								}
							}
						}
					}
				?>
			</tbody>
		</table>
	</body>
</html>