<?php 
if (isset($models)) {
?>
	<option value="-1">Any Model</option>
<?php
	foreach ($models as $model) {
?>
		<option value="<?= $model['id'] ?>"><?= $model['name'] ?></option>
<?php 
	}
}
?>