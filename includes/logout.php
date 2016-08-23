<?
define('TRO_ADS',true);
include('../init.php');
session_start();
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
header("Location:" . BASE_URL . "signin.php");
?>