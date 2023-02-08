<?php
try{
    include_once "header.php";
    include_once "dbHandler.php";
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $categoryName = $decode["categoryName"];
    $arrayData = array(
        "name"=>$categoryName,
    );
        $db = new dbHandler();
        $db->insert($arrayData,"category");

}catch(ERROR $e){
    echo $e;
}catch(Exception $e){
    echo $e;
}
?>