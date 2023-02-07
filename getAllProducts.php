<?php 
include_once "dbHandler.php";
$db = new dbHandler();
echo(json_encode($db->getInDB("*","product",null,null)));

?>