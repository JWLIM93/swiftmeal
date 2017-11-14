<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Owner
 *
 * @author 'KL
 */
require_once 'user.php';
class owner extends user {
    //put your code here

    private $owner_id;
    private $active;
    
    public function Owner($user_id,$name,$email,$password,$phone_number,$status,$owner_id,$active){
        user::user($user_id,$name,$email,$password,$phone_number,$status);
        $this->owner_id = $owner_id;
        $this->active = $active;
        
    }
    public function setOwnerId($owner_id){
        $this->owner_id = $owner_id;
        
    }
    public function setActive($active){
        $this->active = $active;
    }
    public function getOwnerID(){
        return $this->owner_id;
        
    }
    public function isActive(){
        return $this->active;
    }
    public function registerOwnerAttempt($userObj){
        validateOwnerRegister($userObj);
    }
}
    
