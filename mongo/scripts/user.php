<?php

class user {
    private $user_id;
    private $fullName;
    private $email;
    private $phone_number;
    private $password;
    
public function user($user_id,$name,$email,$password,$phone_number,$status){
    if ($status == "register"){
    $this->user_id = $user_id;
    $this->fullName = $name;
    $this->email = $email;
    $this->password = $password;
    $this->phone_number = $phone_number;
    }else{
    $this->user_id = $user_id;
    $this->fullName = $name;
    $this->email = $email;
    $this->password ='0';
    $this->phone_number = $phone_number;
        
    }
    
        
}

    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }
        
    public function setFullName($fullName){
        $this->fullName = $fullName;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setPhone_number($phone_number){
        $this->phone_number = $phone_number;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
   
    
    //Get methods
    public function getUser_id() {
        $user_id = $this->user_id;
        return $user_id;
    }
    
    public function getFullName() {
        $fullName = $this->fullName;
        return $fullName;
    }
    
    public function getEmail() {
        $email = $this->email;
        return $email;
    }
    
        public function getPassword() {
        $password = $this->password;
        return $password;
    }
    
    public function getPhone_number(){
        $phone_number = $this->phone_number;
        return $phone_number;
    }
}
