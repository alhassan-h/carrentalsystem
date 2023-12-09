<?php
session_start();

$flag = (isset($_SESSION['loggedInAdmin'])) ? true : false;

session_unset();
session_destroy();

if ( $flag ){
	header('location: ./admin_login.php');exit;
}
else{
	header('location: ./login.php');exit;
}

?>