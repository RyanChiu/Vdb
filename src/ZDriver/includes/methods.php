<?php 
/**
 * self defined functions below
 */
function __getDBLink() {
	return mysqli_connect("localhost", "vdb", "cc123qwe", "vdb");
}

function __callAPI($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data ? $data : false;
}

function __getArticle($makenicename, $modelnicename, $year, $aipkey, $plain = false) {
	$content = __callAPI(
		"https://api.edmunds.com/api/editorial/v2/$makenicename/$modelnicename/$year"
		. "?api_key=$aipkey&fmt=json"
	);
	return $plain? $content : json_decode($content, false);
}

function __getStyles($makenicename, $modelnicename, $year, $aipkey, $plain = false) {
	$content = __callAPI(
		"https://api.edmunds.com/api/vehicle/v2/$makenicename/$modelnicename/$year"
		. "/styles?api_key=$aipkey&fmt=json"
	);
	return $plain? $content : json_decode($content, false);
}

function __getPrice($styleid, $zip, $apikey, $plain = false) {
	$content = __callAPI(
		"https://api.edmunds.com/v1/api/tmv/tmvservice/calculatenewtmv?"
		. "styleid=$styleid&zip=$zip"
		. "&api_key=$apikey&fmt=json"
	);
	return $plain? $content : json_decode($content, false);
}
?>