<?php 
include_once "header.php";
include_once "dbHandler.php";
$db = new dbHandler();
echo(json_encode($db->getInDB("*","category",null,null)));

?>