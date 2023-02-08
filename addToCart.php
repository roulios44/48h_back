<?php

try{
    include_once "header.php";
    include_once "cart.php";
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $productID = intval($decode["productID"]);
    $quantity = intval($decode["quantity"]);
    $unitPrice= ($decode["unitePrice"]);
    $userId= intval($decode["userId"]);

    $cart = new Cart($userId,$productID,$quantity,$unitPrice);
    $cart->addToCart();
}catch(ERROR $e){
    echo $e;
}catch(Exception $e){
    echo $e;
}

?>