<?php
// require_once("/var/www/html/wp-load.php");
require_once("C:/xampp/htdocs/wp-load.php");
header('Content-Type: application/json');
$result = new stdClass();
$result->messages = array();
if (!is_user_logged_in()) {
	array_push($result->messages, status('error', 'You are not logged in! Please login to continue.'));
	die();
}
$current_user = wp_get_current_user();
$current_user = $current_user->data->user_login;
$db = new wpdb('trainingSched', 'test', 'trainingsched', 'localhost');
$db->show_errors();

$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
switch($_GET['handler']) {
	case 'Grab Requests':
		// $results->results = 
	break;
	case 'Submit Request':
		$insert = $db->insert(
			'requests', 
			array( 
				// 'date' => date("Y-m-d", strtotime($data->date)),
				'date' => $data->date,
				'name' => $data->name,
				'location' => $data->location,
				'submitted_by' => $current_user
			), 
			array( 
				'%s',
				'%s',
				'%s'
			) 
		);

		if (!$insert) {
			array_push($result->messages, status('error'));
		} else {
			array_push($result->messages, status('success', 'Request Submitted!'));
		}
	break;
}

echo json_encode($result, JSON_NUMERIC_CHECK);

function status($statVal, $textVal=false) {
	if ( !$textVal ) {
		switch ($statVal) {
			case 'success':
				$textVal = "Success!";
			break;
			case 'warning':
				$textVal = "Warning.";
			break;
			case 'error':
				$textVal = "An error has occurred.";
			break;
			case 'info':
				$textVal = "Info";
			break;
		}
	}
	
	return array(
		"text"		=>	$textVal,
		"severity"	=>	$statVal
	);
}

function debug($dbgVal, $printr = false, $label = false) {
	global $db;
	$table = 'debug';
	$bktrc = debug_backtrace();
	if($dbgVal === 'clear') {
		$db->query("DELETE FROM ".$table." WHERE 1");
	} else {
		if ($printr) {
			$dbgVal = print_r($dbgVal, true);
		}
		if (!$label) {
			$label = '';
		}
		$db->insert(
			$table,
			array(
				'val' => $dbgVal,
				'line' => $bktrc[0]['line'],
				'label' => $label,
				'backtrace' => print_r($bktrc, true)
			), 
			array(
				'%s',
				'%d',
				'%s',
				'%s'
			)
		);
	}
	return true;
}