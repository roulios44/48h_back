<?php

try{
    include_once "header.php";
    include_once "cart.php";
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $userId = intval($decode["userId"]);
    $db = new dbHandler();
    echo(json_encode($db->getInfoCart($userId)));
}catch(ERROR $e){
    echo $e;
}catch(Exception $e){
    echo $e;
}

?>