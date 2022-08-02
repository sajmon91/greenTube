<?php

//page redirect
function redirect($page){
  header('location:' . URLROOT . '/' . $page);
}

//////////////////////////////////////////////////////////////////

function setMessage($msg){

	if (!empty($msg)) {
		
		$_SESSION['message'] = $msg;

	}else{

		$msg = "";
	}
}

////////////////////////////////////////////////////////////////////

function displayMessage(){

	if (isset($_SESSION['message'])) {
		
		echo $_SESSION['message'];

		unset($_SESSION['message']);
	}
}

////////////////////////////////////////////////////////////////////

function isLoggedIn(){
		return (isset($_SESSION['user_id'])) ? true : false;
}

////////////////////////////////////////////////////////////////////

