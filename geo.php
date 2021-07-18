<?php
header('Content-Type: application/json');
//header('Content-Type: text/javascript');
$json = file_get_contents("http://geo.stat.fi/geoserver/tilastointialueet/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=tilastointialueet:kunta4500k&maxFeatures=3500&outputFormat=application%2Fjson");
$decoded = json_decode($json);
$arr = array();
foreach ($decoded as $key => $value) {
   if (is_array($value)) {
	 $arr[] = $value;
   }
   
}

$names = array();

foreach ($arr[0] as $value) {
  	foreach ($value as $key => $value) {
		if ($key=="properties") {
			$names[] = $value;
		}
	}
}

$features['success'] = true;
$features['features'] = $names;
$features['totalCount'] = count($arr[0]);
$encoded = json_encode($features);
echo $encoded;
