<?php 
require_once "dbHandler.php";
class Sell extends dbHandler{
    private string $name;
    private int $sellerID;
    function __construct(string $name,int $sellerID)
    {
        parent::__construct();
        $this->name = $name;
        $this->sellerID = $sellerID;
    }

    function addSeller(){
        $arrayData = [
        "name" => $this->name,
        "userId" => $this->sellerID,
        ];
        $idUSer = $this->insert($arrayData,"seller");
    }
}
?>