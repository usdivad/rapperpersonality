<?php
	header('Access-Control-Allow-Origin: http://zumic.com');

	$data = $_POST['data'] . PHP_EOL;
	$file = fopen('./collected_data.txt', 'a');
	fwrite($file, $data.PHP_EOL);
	fclose($file);
	echo "hoho";
	//header("Content-Type: text/plain");
	exit();
?>