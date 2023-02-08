<?php 
try{
    include_once "header.php";
    include_once "dbHandler.php";
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $commandeLigneId = $decode["commandeLigneId"];
    echo("commande ligne id    $commandeLigneId");
    $db = new dbHandler();
    $db->delete("commandeLigne","id",$commandeLigneId);
}catch(ERROR $e){
    echo $e;
}catch(Exception $e){
    echo $e;
}

?>