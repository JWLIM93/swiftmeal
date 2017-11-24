<?php 
class Area{
    private $areaID;
    private $areaName;
    private $placeCount;
    private $areaLat;
    private $areaLong;



    public function Area($areaID,$areaName,$placeCount,$areaLat,$areaLong){
        $this->areaID= $areaID;
        $this->areaName = $areaName;
        $this->placeCount = $placeCount;
        $this->areaLat = $areaLat;
        $this->areaLong = $areaLong; 
    }
    

    public function getAreaID(){
        return $this->areaID;
    }
    
    public function getAreaName(){
        return $this->areaName;
    }
    
    public function getPlaceCount(){
        return $this->placeCount;
    }
    
    public function getAreaLat(){
        return $this->areaLat;
    }
    public function getAreaLong(){
        return $this->areaLong;
    }



} 
?>
