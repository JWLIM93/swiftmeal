<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customer
 *
 * @author 'KL
 */
require_once 'User.php';
class customer extends user {
    private $cust_id;
    private $active;
    
    public function customer($user_id,$name,$email,$password,$phone_number,$status,$cust_id,$active){
        user::user($user_id,$name,$email,$password,$phone_number,$status);
        $this->cust_id = $cust_id;
        $this->active = $active;
        
    }
    public function setCustId($cust_id){
        $this->cust_id = $cust_id;
        
    }
    public function setActive($active){
        $this->active = $active;
    }
    public function getCustID(){
        return $this->cust_id;
        
    }
    public function isActive(){
        return $this->active;
    }
}
