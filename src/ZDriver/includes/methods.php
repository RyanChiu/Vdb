<?php 
/**
 * self defined functions below
 */
function callAPI($url) {
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

function getDBLink() {
	return mysqli_connect("localhost", "vdb", "cc123qwe", "vdb");
}
?>