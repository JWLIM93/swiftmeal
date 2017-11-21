<?php
include "db-functions.php";
include "restaurant.php";
include "hawker.php";
include "customer.php";
session_start();

if(isset($_POST['areaID']) && !empty($_POST['areaID'])){
    $areaID = $_POST['areaID'];
    $customer = $_SESSION['Obj'];
    $custID = $customer->getCustID();
    //$areaID = "NS10";
    $recommendationArray = array();
    $placeArray = array();
    $randomRecommendation = "SELECT PlaceID FROM placearea pa WHERE AreaID = '".$areaID."' ORDER BY RAND () LIMIT 5";
    $resultRecommendation = connect_db()->query($randomRecommendation) or die(mysqli_error());
    if(mysqli_num_rows($resultRecommendation) > 0){
        while($row = mysqli_fetch_array($resultRecommendation)){
            $placeID = $row['PlaceID'];
            array_push($placeArray,$placeID);
           //echo  $row['PlaceID']."<br/>";
           

        }
    }
    
    for($i = 0 ; $i <count($placeArray); $i++){
     $randomRestaurantSQL = "SELECT * FROM place p, placearea pa,restaurant r
     WHERE p.PlaceID = pa.PlaceID 
     AND r.PlaceID = p.PlaceID
     AND r.PlaceID = '".$placeArray[$i]."'";
     $randomRestaurantResult = connect_db()->query($randomRestaurantSQL) or die(mysqli_error());
     if(mysqli_num_rows($randomRestaurantResult)>0){
         while($row = mysqli_fetch_array($randomRestaurantResult)){
            $restaurant = new Restaurant($row['PlaceID'],$row['Block'],$row['Building'],$row['Floor'],$row['Street'],
            $row['Unit'],$row['GeoX'],$row['GeoY'],$row['GeoLat'],$row['GeoLong'],$row['DateAdded'],$row['TimeAdded'],$row['RestaurantID'],$row['RestaurantName'],
          $row['CountLikes'],$row['CountDislikes'],$row['isValid']);
          array_push($recommendationArray,$restaurant);
    
         }

        }
  
   }
   
   for($i = 0 ; $i <count($placeArray); $i++){
    $randomHawkerSQL = "SELECT * FROM place p, placearea pa,hawkercenter h
    WHERE p.PlaceID = pa.PlaceID 
    AND h.PlaceID = p.PlaceID
    AND h.PlaceID = '".$placeArray[$i]."'";
    $randomHawkerResult = connect_db()->query($randomHawkerSQL) or die(mysqli_error());
    if(mysqli_num_rows($randomHawkerResult)>0){
        while($row = mysqli_fetch_array($randomHawkerResult)){
           $hawker = new hawker($row['PlaceID'],$row['Block'],$row['Building'],$row['Floor'],$row['Street'],
           $row['Unit'],$row['GeoX'],$row['GeoY'],$row['GeoLat'],$row['GeoLong'],$row['DateAdded'],$row['TimeAdded'],$row['HawkerCenterID'],"Hawker Center@".$row['Building'],
         $row['isValid']);
         array_push($recommendationArray,$hawker);
   
        }

       }
 
  }
if(count($recommendationArray) != 0){
       $date = date("Y-m-d");
       $time = date("h:i:s");
       $recommendationID = generateRandomID();
       $fiveRecommendationID ="";
       for($i=0;$i<count($recommendationArray);$i++){
         
           if($recommendationArray[$i] instanceof Restaurant){
           $fiveRecommendationID.=$recommendationArray[$i]->getRestaurantID().",";
           }else if ($recommendationArray[$i] instanceof hawker){
                $fiveRecommendationID.=$recommendationArray[$i]->getHawkerID().",";
           }
         
           //echo($addRecommendation);
       }
       $addRecommendation =  "INSERT INTO userrecommendation (RecommendationID,CustomerID,DateRecommended,TimeRecommended,RecommendedPlaces,AreaID) VALUES('".$recommendationID."','".$custID."','".$date."','".$time."','".$fiveRecommendationID."','".$areaID."')";
           //echo $addRecommendation ."<br/>";
       $addRecommendationResult = connect_db()->query($addRecommendation) or die(mysqli_error());
}
  if(count($recommendationArray)!= 0){
  for($j = 0 ;$j < count($recommendationArray);$j++){
      if($recommendationArray[$j] instanceof Restaurant){
        echo   "<li class='mdc-list-item' data-mdc-auto-init='MDCRipple' id='".$recommendationArray[$j]->getGeoLat().",".$recommendationArray[$j]->getGeoLong()."' value=".$j." name=".$recommendationArray[$j]->getRestaurantID().">".
        "<i class='mdc-list-item__start-detail material-icons' aria-hidden='true'>restaurant</i>".
       "<span id='selected-restaurant-name' class='mdc-list-item__text'>"
          .$recommendationArray[$j]->getRestaurantName().",".
         " <span class='mdc-list-item__text__secondary'>".$recommendationArray[$j]->getBuilding()." ".$recommendationArray[$j]->getBlock()." ".$recommendationArray[$j]->getStreet().
        " #".$recommendationArray[$j]->getFloor()."-"
        .$recommendationArray[$j]->getUnit().
        "</span>".
        "</span>
      </li><script>coordinates.push([".$recommendationArray[$j]->getGeoLong().",".$recommendationArray[$j]->getGeoLat()."]);</script>";

      }
      else if($recommendationArray[$j] instanceof hawker){
        echo   "<li class='mdc-list-item' data-mdc-auto-init='MDCRipple' id='".$recommendationArray[$j]->getGeoLat().",".$recommendationArray[$j]->getGeoLong()."' value=".$j." name=".$recommendationArray[$j]->getHawkerID().">".
        "<i class='mdc-list-item__start-detail material-icons' aria-hidden='true'>restaurant</i>".
       "<span id='selected-restaurant-name' class='mdc-list-item__text'>"
          .$recommendationArray[$j]->getHawkerName().",".
         " <span class='mdc-list-item__text__secondary'>".$recommendationArray[$j]->getBuilding()." ".$recommendationArray[$j]->getBlock()." ".$recommendationArray[$j]->getStreet().
        " #".$recommendationArray[$j]->getFloor()."-"
        .$recommendationArray[$j]->getUnit().
        "</span>".
        "</span>
      </li><script>coordinates.push([".$recommendationArray[$j]->getGeoLong().",".$recommendationArray[$j]->getGeoLat()."]);</script>";

      }
  }
  }
  else{
    echo   '<li id="recommended-place-1" class="mdc-list-item" data-mdc-auto-init="MDCRipple">
    <span class="mdc-list-item__text">
      No Restaurant!
      
    </span>
  </li>';
  }

        




}
?>