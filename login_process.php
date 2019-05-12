<?php
	include_once('session.php');
	include_once('util.php');
	
	extract($_POST);

	$websites = getWebsites();
	foreach ($websites as $website){

		$user_info = getUserInfo($website['website'], $userID, md5($password));

		if ((!empty($user_info)) && (!empty($user_info[0]['userID']))) {
			foreach($user_info as $value){
			    $_SESSION["session_login"] = true;
			    $_SESSION["session_userid"] = $value['userID'];
			    $_SESSION["session_name"] = $value['first_name'].", ".$value['last_name'];
			    $_SESSION["session_email"] = $value['email'];
			    $_SESSION["session_address"] = $value['home_address'];
			    $_SESSION["session_homephone"] = $value['home_phone'];
			    $_SESSION["session_cellphone"] = $value['cellphone'];
			    $_SESSION["session_website"] = $value['website'];
	 		}
	 		header("Refresh:1;url=index.php");
	 		echo "<header class='major'><h2>Welcome ".$_SESSION["session_name"]."! From ".$_SESSION["session_website"].". Login Successful.</h2></header>";
	 		break;
		}
	}
	if($_SESSION["session_login"] != true){
		header("Refresh:1;url=login.php");
		echo "<header class='major'><h2>Login Failed.</h2></header>";
	}
?>
