<?php 
require_once "dbHandler.php";
class User extends dbHandler{
    private string $name;
    private string $surname;
    private string $password;
    private string $mail;
    private DateTime $registrationDate;
    private string $address;
    private int $userType;


    function __construct(string $name, string $surname,string $password,string $mail,DateTime $registrationDate, string $address,int $userType)
    {
        parent::__construct();
        $this->mail = $mail;
        $this->name = $name;
        $this->surname = $surname;
        $this->address = $address;
        $this->password = password_hash($password,PASSWORD_BCRYPT);
        $this->registrationDate = $registrationDate;
        $this->userType = $userType;
    }
    function addEmployee(){
        $arrayData = [
            "name" => $this->name,
            "surname" => $this->surname,
            "email"=> $this->mail,
            "password" => $this->password,
            "address" => $this->address,
            "registrationDate" => date_format($this->registrationDate, 'Y-m-d'),
            "userType"=>$this->userType,
        ];
        $idUSer = $this->insert($arrayData,"user");
        return $idUSer;
    }
}

?>