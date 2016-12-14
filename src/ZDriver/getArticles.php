<?php 
include_once './includes/constants.php';
include_once './includes/methods.php';

$dbLink = __getDBLink();
$rs = mysqli_query($dbLink,
	"select a.niceName as makenicename, b.niceName as modelnicename, b.year 
		from makes a, models b
		where a.id = b.makeid
		order by b.id"
);
$i = 1; $MAX = 1;
while ($r = mysqli_fetch_assoc($rs)) {
	//echo print_r($r, true) . "\n($i)\n";//for debug
	
	$json = __getArticle($r['makenicename'], $r['modelnicename'], $r['year'], EDMUNDS_API_KEY);
	
	//var_dump($json);//for debug
	
	$sql = "insert into articles values ";
	if (!empty($json)) {
		/*
		 * insert the values
		 */
		$sql .= sprintf(
			"(
				'%s',	/*makenicename*/
				'%s',	/*modelnicename*/
				%d, 	/*year*/
				'%s',	/*title*/
				'%s',	/*tags*/
				'%s',	/*nicenamedtags*/
				'%s',	/*description*/
				'%s',	/*introduction*/
				'%s',	/*link*/
				'%s',	/*edmundssays*/
				'%s',	/*pros*/
				'%s',	/*cons*/
				'%s',	/*whatsnew*/
				'%s',	/*body*/
				'%s',	/*powertrain*/
				'%s',	/*safety*/
				'%s',	/*interior*/
				'%s',	/*driving*/
			),",
			$json->make->niceName,
			$json->model->niceName,
			$json->year->year,
			$json->title,
			implode(JSON_SEPARATOR, $json->tags),
			implode(JSON_SEPARATOR, $json->niceNamedTags),
			isset($json->description) ? $json->description : null,
			isset($json->introduction) ? $json->introduction : null,
			isset($json->link->href) ? $json->link->href : null,
			isset($json->edmundsSays) ? $json->edmundsSays : null,
			implode(JSON_SEPARATOR, $json->pros),
			implode(JSON_SEPARATOR, $json->cons),
			isset($json->whatsNew) ? $json->whatsNew : null,
			isset($json->body) ? $json->body : null,
			isset($json->powertrain) ? $json->powertrain : null,
			isset($json->safety) ? $json->safety : null,
			isset($json->interior) ? $json->interior : null,
			isset($json->driving) ? $json->driving : null
		);
	};echo $sql . "\n";
	
	if ($i++ >= $MAX) break;
}
?>
