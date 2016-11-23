<?php 
if (isset($models)) {
?>
	<option value="-1">Any Model</option>
<?php
	foreach ($models as $model) {
?>
		<option value="<?= $model['id'] . "," . $model['niceName'] ?>"><?= $model['name'] ?></option>
<?php 
	}
}
?>
/////////////////////////////////////////////////////////////////////////////////////////////////
<?php 
if (isset($model_years)) {
?>
	<option value="-1">Year</option>
<?php
	foreach ($model_years as $model) {
?>
		<option value="<?= $model['year'] ?>"><?= $model['year'] ?></option>
<?php 
	}
}
?>