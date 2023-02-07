<?php 
class dbHandler{
    private $name;
    private $user;
    private $password;
    private $host;

    public function __construct(){
        $this->name = "challenge";
        $this->user = "root";
        $this->password = "root";
        $this->host = "localhost";
    }
    public function init(string $name,string $user,string $password,string $host){
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
    }

    public function connectDB(){
        try {
            $link = mysqli_connect($this->host, $this->user, $this->password, $this->name);
        } catch (Exception $e) {
            echo $e;
            die("Can't connect to db");
        }
        return $link;
    }
    public function insert(array $toinsert, string $table){
        $con = $this->connectDB();
        if ($con == false) {
            die("ERROR : couldn't connect properly to database : " . mysqli_connect_error());
        }
        $col = array_keys($toinsert);
        $val = array_values($toinsert);
        $sql = "INSERT INTO $table (" . implode(',', $col) . ") VALUES (\"" . implode("\", \"", $val) . "\" )";
        $stmt = $con->prepare($sql);
        if (($stmt = $con->prepare($sql))) {
            $stmt->execute();
        } else {
            echo "there has been an issue with : " . $sql . " " . mysqli_error($con);
        }
        $idInsert =$con->insert_id;
        mysqli_close($con);
        return $idInsert;
    }
    public function getInDB(string $toSelect, string $table, string|null $rowToSearch, string|int|null $condition){
        $db = $this->connectDB();
        $query = "";
        if(is_null($rowToSearch))$query = "SELECT $toSelect FROM `$table`";
        else $query = "SELECT $toSelect FROM `$table` WHERE $rowToSearch = ?";
        $sql = $db->prepare($query);
        if(is_null($rowToSearch))$sql->execute();
        else $sql->execute([$condition]);
        $resultQuery = $sql->get_result();
        $arrayData = [];
        while($row = mysqli_fetch_assoc($resultQuery))array_push($arrayData,$row);
        mysqli_close($db) ;
        return $arrayData ;
    }
    public function getInDBWithInner(string $toSelect, string $table,string $tableInner,string $champInner,string $champ, string|int|null $condition,){
        $db = $this->connectDB();
        $query = "";
        $query = "SELECT $toSelect FROM `$table` INNER JOIN `$tableInner` ON $table.$champ = $tableInner.$champInner";
        $sql = $db->prepare($query);
        $file = fopen("test.txt","w");
        fwrite($file,$query);
        fwrite($file,$condition);
        $sql->execute();
        $resultQuery = $sql->get_result();
        $arrayData = [];
        while($row = mysqli_fetch_assoc($resultQuery))array_push($arrayData,$row);
        mysqli_close($db) ;
        return $arrayData ;
    }
    public function updateInDB(string $table, string $rowToUpdate,mixed $newValue, string $tableCondition ,string $condition){
        $db = $this->connectDB();
        $sql = $db->prepare("UPDATE `$table` SET `$rowToUpdate` = ? WHERE $tableCondition = ?;");
        $sql->execute([$newValue,$condition]);
        mysqli_close($db) ;
    }
    public function delete(string $table, string $rowToSearch,string $condition){
        $db = $this->connectDB();
        $stmt = $db->prepare("DELETE FROM $table WHERE $rowToSearch = ?");
        $stmt->execute([$condition]);
        mysqli_close($db) ;
    }
    public function getInfoConnect(int $userID,int $userType){
        $db = $this->connectDB();
        $query = "
        SELECT commandeLigne.id AS commandeId,productId,quantity,unitePrice,userId,type.id AS typeID,type.libelle 
        FROM commandeLigne 
        INNER JOIN type 
        ON commandeLigne.userId = $userID WHERE $userType = type.id;";
        $sql = $db->prepare($query);
        $sql->execute();
        $resultQuery = $sql->get_result();
        $arrayData = [];
        while($row = mysqli_fetch_assoc($resultQuery))array_push($arrayData,$row);
        mysqli_close($db) ;
        return $arrayData ;
    }
}
?>