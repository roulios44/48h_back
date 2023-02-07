<?php 
$file = fopen("test.txt","w");
try{
    include_once "header.php";
    include_once "user.php";
    include_once "sell.php";
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $name = $decode["name"];
    $surname = $decode["surname"];
    $mail = $decode["email"];
    $password = $decode["password"];
    $address = $decode["address"];
    // $registrationDate = DateTime::createFromFormat("l dS F Y", $decode["registrationDate"]);
    // $registrationDate = $registrationDate->format('d/m/Y');
    $registrationDate = new DateTime($decode["registrationDate"]);
    $userType = $decode["userType"];
    $user = new User($name,$surname,$password,$mail,$registrationDate,$address,$userType);
    $idUser = $user->addEmployee();
    if($userType==2){
        $sellName = $decode["storeName"];
        $sell = new Sell($sellName,$idUser);
        $sell->addSeller();
    }
}catch(ERROR $e){
    fwrite($file,$e);
}catch(Exception $e){
    fwrite($file,$e);
}


?>