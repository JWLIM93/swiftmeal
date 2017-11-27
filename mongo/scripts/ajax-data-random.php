<?php
include "db-functions.php";
include "restaurant.php";
include "hawker.php";
include "customer.php";
session_start();

if(isset($_POST['areaID']) && !empty($_POST['areaID'])) {
  global $mongoConnection;
  $counter = 0;
  $filter = array();
  $areaID = $_POST['areaID'];
  $customer = $_SESSION['Obj'];
  $custID = $customer->getCustID();
  $recommendationArray = array();
  $idquery = ['_id'=>$areaID];
  $collection = $mongoConnection->selectCollection('swiftmeal', 'area');
  $document = $collection->find($idquery,['Places'=>1]);
  foreach($document as $row1){
      foreach($row1['Places'] as $row2){
          array_push($filter, ['_id'=>$row2['PlaceID']]);
      }
  }
  $collection2 = $mongoConnection->selectCollection('swiftmeal', 'place');
  $document2 = $collection2->find(['$or'=>$filter], ['skip' => rand(0,sizeof($filter))]); 
  foreach($document2 as $row){
      if($counter<5){
          if($row['Type'=='Restaurant']){
              $restaurant = new Restaurant($row['_id'],$row['Block'],$row['Building'],$row['Floor'],$row['Street'],
              $row['Unit'],$row['GeoX'],$row['GeoY'],$row['GeoLat'],$row['GeoLong'],$row['DateAdded'],$row['TimeAdded'],$row['Details'][0]['RestaurantID'],$row['Details'][0]['RestaurantName'],
              $row['Details'][0]['CountLikes'],$row['Details'][0]['CountDislikes'],$row['Details'][0]['isValid']);
              array_push($recommendationArray,$restaurant);
              $counter++;
          }
          else{
              $hawker = new hawker($row['PlaceID'],$row['Block'],$row['Building'],$row['Floor'],$row['Street'],
              $row['Unit'],$row['GeoX'],$row['GeoY'],$row['GeoLat'],$row['GeoLong'],$row['DateAdded'],$row['TimeAdded'],$row['Details'][0]['HawkerCenterID'],"Hawker Center".$row['Building'],
              $row['Details'][0]['isValid']);
              array_push($recommendationArray,$hawker);
              $counter++;
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
          }
          else if ($recommendationArray[$i] instanceof hawker){
              $fiveRecommendationID.=$recommendationArray[$i]->getHawkerID().",";
          }
      }
      $collection3 = $mongoConnection->selectCollection('swiftmeal', 'customer');
      $collection3->updateOne(
              ['_id' => $custID],
              ['$push' =>['UserRecommendations' => ['RecommendationID' => $recommendationID,'DateRecommended' => $date, 'TimeRecommended' => $time, 'RecommendedPlaces' => $fiveRecommendationID, 'AreaID' => $areaID]]]
      );
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