<?php
define('API_RUN',true);

require 'engine.php';

if(!isset($_SERVER['HTTP_REFERER']) && !isset($_GET['apikey'])) {
	exit('API cannot be direct accessed!');
}
if(check_apikey()) {
	if(isset($_GET['type']) && $_GET['type']=='url') {
		$result = url_handler();
	}else if(isset($_GET['type']) && $_GET['type']=='file') {
		list($result) = file_handler();
	}else {
		header('HTTP/1.1 400 Bad Request');
		exit('You must set "type" in the query string.');
	}
	header('Content-Type: application/json');
	echo json_encode($result);
}else {
	exit('API KEY ERROR');
}
?>