<?php
	//Configuration
	ini_set('memory_limit', '-1');
	$dbhost= 'localhost';
	$dbname= 'tripAdvisor';

	$m= new MongoClient();
	$db= $m->$dbname;
	$hotels= $db->hotels;
	$reviews= $db->reviews;

	$entries= explode("\n", file_get_contents("Data/offering.txt"));
	foreach($entries as $entry){
		// $hotels->save(json_decode($entry, true));
		echo "H";
	}

	// $handle= fopen("Data/review.txt", "r") or die("Couldn't get handle");
	// if($handle){
		// while(!feof($handle)){
			// $buffer= stream_get_line($handle, 400000, "\n");
			// if($buffer != null){ $reviews->save(json_decode($buffer, true)); }
		// }
		// fclose($handle);
	// }
?>