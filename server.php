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
$db = new wpdb('trainingSched', 'zStEY4ypRArQ5fs5', 'trainingSched', 'localhost');
$db->show_errors();

$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
// debug('clear');
switch($_GET['handler']) {
	case 'Check if Full':
		$confroom = $db->get_var("SELECT COUNT(*) FROM requests WHERE location = '3rd Floor Conference Room' AND date = '".$request_body."'");
		$fl = $db->get_var("SELECT COUNT(*) FROM requests WHERE location = 'Family Law' AND date = '".$request_body."'");		
		$result->confroom = $confroom;
		$result->fl = $fl;
		$result->date = $request_body;
	break;
	case 'Grab Requests For Date':
		// debug('clear');
		// debug($data, true);
		$result->results = $db->get_results("SELECT * FROM requests WHERE date =".$data->data);
	break;
	case 'Grab Requests':
		$result->results = $db->get_results("SELECT * FROM requests");
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