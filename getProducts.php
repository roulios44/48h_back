<?php 
include_once "header.php";
include_once "./dbHandler.php";
$encoded = file_get_contents("php://input");
$decode = json_decode($encoded, true);


?>