<?php

/**
 * Class used to generate a basic front
 */

class SimpleFront {

	/**
	* Call template
	*/
	public static function printTemplate($name, $data) {
		ob_start();
		include(__DIR__."/../web/views/".$name.'.php');
		ob_end_flush();
	}

	/**
	* Generate a basic front from an array
	*/
	public static function printRecursiveArray($title, $headers, $datas) {

		echo '
		   	<!doctype html>
			<html lang="en">
				<head>
					<!-- Required meta tags -->
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

					<!-- Bootstrap CSS -->
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

					<title>Albion Market Manager</title>
				</head>
				<body>
				    <h1>'.$title.'</h1>

				    <!-- Optional JavaScript -->
				    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
				    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
				    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
				    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
				    <script type="text/javascript">
						$(document).ready(function(){
							$("#search").on("keyup", function() {
								var value = $(this).val().toLowerCase();
								$("#datatable .dataline").filter(function() {
									$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
								});
							});
						});
					</script>

					<p>Filter : <input type="text" id="search"></p>

					<table id="datatable" class="table table-striped table-bordered" style="width:100%">
				        <thead>
				            <tr>';
					            foreach ($headers as $header) {
					            	echo "<th>".$header."</th>";
					            }
				            echo '</tr>
				        </thead>
			        	<tbody>
							'.static::getLines($datas).'
						</tbody>
					</table>
				</body>
			</html>
		';
	}

	/**
	* return a table line for each $datas line, with the key as first coll
	*/
	protected static function getLines($datas, $lineStart = '') {

		$return = '';

		foreach ($datas as $key => $line) {
			$lineContent = "<td>".$key."</td>";

			if (!is_array(current($line))) {
				$return .= "<tr class=\"dataline\">".$lineStart.$lineContent;
				foreach ($line as $lineValue) {
					$return .= "<td>".$lineValue."</td>";
				}
				$return .= "</tr>";
			} else {
				$return .= static::getLines($line, $lineStart.$lineContent);
			}
		}

		return $return;
	}
}
