<?php 
$file = fopen("test.txt","w");
try{
    include_once "header.php";
    include_once "./dbHandler.php";
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $email = $decode["email"];
    $password = $decode["password"];
    $db = new dbHandler();
    $data = $db->getInDB("password,userType,id","user","email",$email)[0];
    if(password_verify($password,$data["password"])){
        $infoConnect = [];
        if($data["userType"]==1){
            // Here we use 1 has argument because we check the value of TypeID jsut before
            foreach($db->getInfoConnect($data["id"],1) as $info){
                array_push($infoConnect,$info);
            }
            if($infoConnect==[]){
                $infoConnect = array("userType" => $data["userType"]);
            }
        }else{
            $infoConnect = array("userType" => $data["userType"]);
        }
        echo(json_encode($infoConnect));
    }else{
        echo("false");
    }
}catch(ERROR $e){
    fwrite($file,$e);
}catch(Exception $e){
    fwrite($file,$e);
}

?>