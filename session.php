<?php
	session_start();

	$session_login = false;
	$session_name = "";
	$session_userid = "";
	$session_email = "";
	$session_address = "";
	$session_homephone = "";
	$session_cellphone = "";
	$session_website = "";
	
	if (isset($_SESSION["session_login"]) && $_SESSION["session_login"] === true) {
	    $session_login = $_SESSION["session_login"];
	    $session_name = $_SESSION["session_name"];
	    $session_userid = $_SESSION["session_userid"];
    	$session_email = $_SESSION["session_email"];
		$session_address = $_SESSION["session_address"];
		$session_homephone = $_SESSION["session_homephone"];
		$session_cellphone = $_SESSION["session_cellphone"];
		$session_website = $_SESSION["session_website"];
	} else {
	    $_SESSION["session_login"] = false;
	    //die("You are not login. Access denied.");
	}
?>