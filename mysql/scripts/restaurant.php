<?php
include 'area.php';
class Restaurant{
    //private $area = new Area();
    private $placeID;
    private $block;
    private $building;
    private $floor;
    private $street;
    private $unit;
    private $geoX;
    private $geoY;
    private $geoLat;
    private $geoLong;
    private $dateAdded;
    private $timeAdded;
    private $restaurantID;
    private $restaurantName;
    private $countLikes;
    private $countDislikes;
    private $isValid;

    public function Restaurant($placeID,$block,$building,$floor,$street,$unit,$geoX,$geoY,
    $geoLat,$geoLong,$dateAdded,$timeAdded,$restaurantID,$restaurantName,$countLikes,$countDislikes,$isValid){
        $this->placeID = $placeID;
        $this->block = $block;
        $this->building = $building;
        $this->floor= $floor;
        $this->street=  $street;
        $this->unit = $unit;
        $this->geoX = $geoX;
        $this->geoY = $geoY;
        $this->geoLat = $geoLat;
        $this->geoLong = $geoLong;
        $this->dateAdded = $dateAdded;
        $this->timeAdded = $timeAdded;
        $this->restaurantID = $restaurantID;
        $this->restaurantName = $restaurantName;
        $this->countLikes = $countLikes;
        $this->countDislikes = $countDislikes;
        $this->isValid = $isValid;


    }
    public function getPlaceID(){
        return $this->placeID;
    }
    public function getBlock() {
        return $this->block;
    }
    public function getBuilding(){
        return $this->building;
    }
    public function getFloor(){
        return $this->floor;
    }
    public function getStreet(){
        return $this->street;
    }
    public function getUnit(){
        return $this->unit;
    }
    public function getGeoX(){
        return $this->geoX;
    }
    public function getGeoY(){
        return $this->geoY;
    }
    public function getGeoLat(){
        return $this->geoLat;
    }
    public function getGeoLong(){
        return $this->geoLong;
    }
    public function getDateAdded(){
        return $this->dateAdded;
    }
    public function getTimeAdded(){
        return $this->timeAdded;
    }
    public function getRestaurantID(){
        return $this->restaurantID;
    }
    public function getRestaurantName(){
        return $this->restaurantName;

    }
    public function getLikes(){
        return $this->countLikes;
    }
    public function getDislikes(){
        return $this->countDislikes;
    }
    public function isValid(){
        return $this->isValid;
    }
    
    public function setPlaceID($placeID){
        $this->placeID = $placeID;
    }
    public function setBlock($block) {
        $this->block = $block;
    }
    public function setBuilding($building){
         $this->building = $buliding;
    }
    public function setFloor($floor){
        $this->floor =$floor;
    }
    public function setStreet($street){
        $this->street = $street;
    }
    public function setUnit($unit){
         $this->unit = $unit;
    }
    public function setGeoX($geoX){
        $this->geoX = $geoX;
    }
    public function setGeoY($geoY){
        $this->geoY = $geoY;
    }
    public function setGeoLat($geoLat){
        $this->geoLat= $geoLat;
    }
    public function setGeoLong($geoLong){
        $this->geoLong = $geoLong;
    }
    public function setDateAdded($dateAdded){
        $this->dateAdded = $dateAdded;
    }
    public function setTimeAdded($timeAdded){
        $this->timeAdded = $timeAdded;
    }
    public function setRestaurantID($restaurantID){
        $this->restaurantID = $restaurantID;
    }
    public function setRestaurantName($restaurantName){
        $this->restaurantName = $restaurantName;

    }
    public function setLikes($countLikes){
       $this->countLikes = $countLikes;
    }
    public function setDislikes($countDislikes){
        $this->countDislikes = $countDislikes;
    }
    public function setValid($isValid){
        $this->isValid = $isValid;
    }

}

?>