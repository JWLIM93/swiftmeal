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
require_once 'user.php';
class customer extends user {
    private $cust_id;
    private $active;
    private $Place;
    private $RestID;
    private $BookingNum;
    private $BookingDate;
    private $BookingTime;
    private $ReservationTime;
    private $ReservationDate;
    private $Pax;
    
    public function customer($user_id,$name,$email,$password,$phone_number,$status,$cust_id,$active){
        user::user($user_id,$name,$email,$password,$phone_number,$status);
        $this->cust_id = $cust_id;
        $this->active = $active;
        
    }
    public function setPlaceID($PlaceID){
        $this->Place = $PlaceID;
    }
    public function getPlaceID(){
        return $this->Place;
        
    }
    public function setRestID($RestID){
        $this->RestID = $RestID;
    }
    public function getRestID(){
        return $this->RestID;
    }
    
    public function setBookingNum($BookingNum){
        $this->BookingNum = $BookingNum;
    }
    public function getBookingNum(){
        return $this->BookingNum;
    }
    
    public function setBookingDate($BookingDate){
        $this->BookingDate = $BookingDate;
    }
    public function getBookingDate(){
        return $this->BookingDate;
    }
    
    public function setBookingTime($BookingTime){
        $this->BookingTime = $BookingTime;
    }
    public function getBookingTime(){
        return $this->BookingTime;
    }
    
    public function setReservationTime($ReservationTime){
        $this->ReservationTime = $ReservationTime;
    }
    public function getReservationTime(){
        return $this->ReservationTime;
    }
    
    public function setReservationDate($ReservationDate){
        $this->ReservationDate = $ReservationDate;
    }
    public function getReservationDate(){
        return $this->ReservationDate;
    }
    
    public function setPax($Pax){
        $this->Pax = $Pax;
    }
    public function getPax(){
        return $this->Pax;
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
