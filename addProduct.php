<?php

try{
    include_once "header.php";
    include_once "dbHandler.php";
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $name = $decode["name"];
    $description = $decode["description"];
    $price = $decode["price"];
    $stock = $decode["stock"];
    $image = $decode["image"];
    $categoryID = $decode["categoryID"];
    $sellerId = $decode["sellerId"];
    echo("SellerID   $sellerId");

    $arrayData = array(
        "name"=>$name,
        "description"=>$description,
        "price"=>$price,
        "stock"=>$stock,
        "image"=>$image,
        "sellerId"=>$sellerId,
        "categoryId"=>$categoryID
    );

    $db = new dbHandler();
    $db->insert($arrayData,"product");
}catch(ERROR $e){
    echo $e;
}catch(Exception $e){
    echo $e;
}

?>