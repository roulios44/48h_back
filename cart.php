<?php 
require_once "dbHandler.php";
class Cart extends dbHandler{
    private int $userId;
    private int $productID;
    private int $quantity;
    private float $unitePrice;
    function __construct(int $userId,int $productID,int $quantity,float $unitPrice)
    {
        parent::__construct();
        $this->userId = $userId;
        $this->productID = $productID;
        $this->quantity = $quantity;
        $this->unitePrice = $unitPrice;
    }

    function addToCart(){
        $arrayData = [
        "userId " => $this->userId,
        "productId " => $this->productID,
        "quantity" => $this->quantity,
        "unitePrice" => $this->unitePrice,
        ];
        $idUSer = $this->insert($arrayData,"commandeLigne");
    }
}
?>