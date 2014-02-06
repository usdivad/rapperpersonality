<?php
/**
 * Plugin Name: Rapper Quiz Data Collection
 * Author: David Su
 * Version: 0.00
 */

	$data = $_POST['data'] . PHP_EOL;
	$file = fopen('/data/rapper-quiz.txt', 'a');
	fwrite($file, $data.PHP_EOL);
	fclose($file);
	//echo "hoho";
	//header("Content-Type: text/plain");
	exit();

?>