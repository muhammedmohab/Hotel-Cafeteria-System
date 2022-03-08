<?php
// include 'Base.php';
class User{
    private $email;
    private $password;
    private $roomNumber;
    private $isAdmin;
    private $name;
    private $image;
    public function __construct($name, $email, $password, $roomNumber,$image, $isAdmin = false){
        // super($name, $image);
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->roomNumber = $roomNumber;
        $this->image = $image;
        $this->isAdmin = $isAdmin;
    }
    public function setName(String $name){
        $this->name = $name;
    }

    public function getName():String{
        return $this->name;
    }

    public function setImage(String $image){
        $this->image = $image;
    }

    public function getImage():String{
        return $this->image;
    }
    function setEmail(String $email){
        $this->email=$email;
    }
    function setPassword(String $password){
        $this->password=$password;
    }
    public function setRoomNumber(String $roomNumber)
    {
        $this->roomNumber = $roomNumber;
    }

    function setIsAdmin(bool $isAdmin)
    {
        $this->isAdmin=$isAdmin;
    }

    public function getEmail():String{
        return $this->email;
    }
    public function getPassword():String{
        return $this->password;
    }

    public function getRoomNumber():String
    {
       return $this->roomNumber;
    }
    public function getIsAdmin():bool{
        return $this->isAdmin;
    }
}