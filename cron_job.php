<?php
include_once "./dbHandler.php";
$con = new dbHandler();
$con->connectDB();
$result = $con->getInDB("*","addressAvalaible",null,null);
$temp = $result;
$conDistant = new dbHandler();
$already = array();
$first = true; 
while(true){     
    $count = 0;     
    foreach($result as $row){         
        if(!in_array($row,$already) && $first){  
            $conDistant->init("challenge","root","root",$row['serverIp']);
            $conDistant->connectDB();
            $res = $conDistant->getInDB("addressIp","server",null,null);
            foreach($res as $r){
                $valuesNotInArray = array_diff($result,$r);
                array_push($result,$valuesNotInArray);
            }
            array_push($already,$row);             
            $first = false;         
        }
         $count++;     
    } 
    if($count == count($result))break; 
} 
$con->insert(array_diff($result,$temp),"addressAvalaible");
print_r(array_diff($result,$temp));
?>