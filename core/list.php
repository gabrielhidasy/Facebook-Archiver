<?php 

$curl = curl_init("https://graph.facebook.com/me/home?access_token=AAAAAAITEghMBAMqohtqByzYgLLTAYgKH3tj4RiYZBKlXRR3KYx1ZCX7qxCuV0NUaBJ8ThiezAXAU44p6Mlb0E9UEMWpHe4ePbbgAdkPpgzPE8ZAZA72F");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$json = curl_exec($curl);
curl_close($curl);
$enconded = json_decode($json);

/*
 echo "<pre>";
print_r($enconded->data);
echo "</pre>";
*/

foreach ($enconded->data as $key => $value) {


	echo "<pre>";

	// echo $value->id . "\n";
	echo "<h2>" . $value->from->name . "</h2>\n";
	// echo $value->from->id . "\n";
		
	if(isset($value->message))
		echo "<h3> $value->message </h3>\n";

	echo $value->created_time . "\n";

	if(isset($value->picture))
		print "<img src = $value->picture />\n";

	if(isset($value->link))
		echo "<a href = $value->link> $value->link </a>";

	echo "</pre>";

}

?>
