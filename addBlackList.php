<?php
include_once "header.php";
include_once "dbHandler.php";
$encoded = file_get_contents("php://input");
$decode = json_decode($encoded, true);
$name = $decode["name"];
$ip = $decode["ip"];
$arrayData = array(
    "name"=>$name,
    "addressIp"=>$ip,
);
    $db = new dbHandler();
    $db->insert($arrayData,"`black-list`");

?>