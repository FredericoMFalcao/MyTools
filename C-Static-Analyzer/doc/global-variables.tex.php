#!/usr/bin/php
<?php
$raw_data = file_get_contents("php://stdin");

/* 1. Split rows */
$data     = explode("\n", $raw_data);
/* 2. Split cells */
foreach($data as $k=>$v) {
	$t = explode("\t", $v);
	$data[$k] = [
		"name"        => $t[0],
		"type"        => $t[1],
		"description" => $t[2],
		];
}
?>

<?php foreach($data as $variable) : ?>
<?php extract($variable); ?>
{\bf <?=$name?>} (<?=$type?>) - <?=$description?> \\

<?php endforeach; ?>

