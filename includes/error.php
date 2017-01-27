<?php
session_start();
include("../config.php");

if(!isset($_SESSION['shipment']))
    $_SESSION['shipment'] = 'html';

$error = preg_replace("/[^\d]/", "", $_GET['code']);
$errorCode = 400;

switch($error){
    
    case "403":
    case "405":
    case "500":
    case "501":
    case "503":
        $errorCode = $error;
        break;
        
    default:
        $errorCode = 404;
        break;
}

http_response_code($errorCode);

include($errorCode.'.php');