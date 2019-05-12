<?php
	header('Content-Type: application/json');

	include_once('util.php');

	extract($_POST);

	$websites = getWebsites();
	foreach ($websites as $website){
		$user_info = getUserInfo($website['website'],$userID, $password);

		if (($user_info != null) && (count($user_info) > 0)) {
			echo json_encode($user_info);
			break;
		}
	}
?>