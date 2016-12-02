<?php 
include_once './includes/constants.php';
include_once './includes/methods.php';

$content = __callAPI("http://api.edmunds.com/api/vehicle/v2/makes?fmt=json&api_key=" . EDMUNDS_API_KEY);

$jdata = json_decode($content, false);

$dbLink = __getDBLink();
mysqli_query($dbLink, "insert into pre_makes (id, name, niceName, updateTime) select *, now() from makes");
echo mysqli_affected_rows($dbLink) . " make(s) copied into pre_makes with timestamps.\n";
mysqli_query($dbLink, "TRUNCATE `makes`");
echo mysqli_affected_rows($dbLink) . " make(s) removed from makes.\n";
mysqli_query($dbLink, "insert into `pre_models`(`id`, `makeid`, `name`, `niceName`, `year`, `updateTime`) select *, now() from models");
echo mysqli_affected_rows($dbLink) . " model(s) copied into pre_models with timestamps.\n";
mysqli_query($dbLink, "TRUNCATE `models`");
echo mysqli_affected_rows($dbLink) . " model(s) removed from models.\n";
if ($jdata !== null) {
	$sql = "insert into makes (id, name, niceName) values ";
	$sqlm = "insert into models (id, makeid, name, niceName, year) values ";
	$mvs = array();
	$mvsi = 0;
	for($i = 0, $n = count($jdata->makes); $i < $n; $i++) {
		$sql .= sprintf(
			"(%d, '%s', '%s')",
			$jdata->makes[$i]->id, 
			$jdata->makes[$i]->name, 
			$jdata->makes[$i]->niceName
		);
		if ($i < $n - 1) $sql .= ", ";
		
		for($j = 0, $m = count($jdata->makes[$i]->models); $j < $m; $j++) {
			for($x = 0, $y = count($jdata->makes[$i]->models[$j]->years); $x < $y; $x++) {
				$mvs[$mvsi] = sprintf(
					"('%s', %d, '%s', '%s', '%s')",
					$jdata->makes[$i]->models[$j]->id, 
					$jdata->makes[$i]->id, 
					$jdata->makes[$i]->models[$j]->name, 
					$jdata->makes[$i]->models[$j]->niceName, 
					$jdata->makes[$i]->models[$j]->years[$x]->year
				);
				$mvsi++;
			}
		}
	}
	mysqli_query($dbLink, $sql);
	echo mysqli_affected_rows($dbLink) . " make(s) inserted.\n";
	//echo "$sql\n";//for debug
	$mvss = array_chunk($mvs, 200);
	$inserted_rows = 0;
	foreach ($mvss as $v) {
		mysqli_query($dbLink, $sqlm . implode(',', $v));
		$inserted_rows += mysqli_affected_rows($dbLink);
		//echo $sqlm . implode(',', $v) . "\n";//for debug
	}
	echo $inserted_rows . " model(s) inserted.\n";
}
?>