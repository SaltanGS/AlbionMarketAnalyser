<?php

require_once("lib/phpnats/vendor/autoload.php");
require_once("../config/databaseConfig.php");

/**
 * Nats client, used to gather and process all data from the Albion Data Client
 */

$connectionOptions = new \Nats\ConnectionOptions();
$connectionOptions->setHost('192.241.250.27')->setPort(4222)->setUser('public')->setPass('thenewalbiondata');

// The connection is not supposed to be stop, but in this case, we relaunch it as often as necessary
while (1) {

	try {
		// New connection
		$client = new \Nats\Connection($connectionOptions);
		$client->setStreamTimeout(9000000);
		$client->connect();

		$client->subscribe(
		    'marketorders.ingest',
		    function ($results) {

		    	$locationsCode = [
					0 => "Thetford",
					1000 => "Lymhurst",
					2000 => "Bridgewatch",
					3004 => "Martlock",
					3005 => "Caerleon",
					4000 => "FortSterling",
				];

		    	$results = json_decode($results->getBody(), true);

		    	if(!empty($results['Orders'])) {
		    		$ordersList = $results['Orders'];

			        $prices = [];
				    $dbConnection = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_BASE, DB_USER, DB_PASSWORD);
				    $insertStatement = $dbConnection->prepare("INSERT INTO item_prices_history (item_id, city, price) VALUES(?, ?, ?)");

					// All orders from the list are processed in order to get, for each item, the cheaper one
				    foreach ($ordersList as $order) {
						if ($order['AuctionType'] == 'offer' && isset($locationsCode[$order['LocationId']])) {
					        if (empty($prices[$order['ItemTypeId']]) or $order['UnitPriceSilver'] < $prices[$order['ItemTypeId']]['price']) {

					            $prices[$order['ItemTypeId']] = [
					                'city' => $locationsCode[$order['LocationId']],
					                'price' => $order['UnitPriceSilver']
					            ];
					        }
					    }
			    	}

					// Once all prices are fixed, we update them into the database
				    foreach ($prices as $item => $price) {
				        $insertStatement->execute([$item, $price['city'], ($price['price']/10000)]);
				    }
			    }
		    }
		);

		$client->wait();	
	} catch (Exception $e) {
		print_r(date(DATE_ATOM).' - '.$e->getMessage().PHP_EOL);
	}
}