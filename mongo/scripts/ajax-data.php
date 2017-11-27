<?php

include 'db-functions.php';
include 'restaurant.php';
include 'customer.php';
session_start();

if(isset($_POST['areaID']) && !empty($_POST['areaID'])){
  global $mongoConnection;
  $counter = 0;
  $filter = array();
  $areaID = $_POST['areaID'];
  $customer = $_SESSION['Obj'];
  $custID = $customer->getCustID();
  $restaurantArray = array();
  $idquery = ['_id'=>$areaID];
  $collection = $mongoConnection->selectCollection('swiftmeal', 'area');
  $document = $collection->find($idquery,['Places'=>1]);
  foreach($document as $row1){
      foreach($row1['Places'] as $row2){
          array_push($filter, ['_id'=>$row2['PlaceID']]);
      }
  }
  $collection2 = $mongoConnection->selectCollection('swiftmeal', 'place');
  $document2 = $collection2->find(['Type'=>'Restaurant','$or'=>$filter],
  [ 'limit' => 5,
    'sort'=>['Details.CountLikes'=>-1]]); 
  foreach($document2 as $row){
      $restaurant = new Restaurant($row['_id'],$row['Block'],$row['Building'],$row['Floor'],$row['Street'],
      $row['Unit'],$row['GeoX'],$row['GeoY'],$row['GeoLat'],$row['GeoLong'],$row['DateAdded'],$row['TimeAdded'],$row['Details'][0]['RestaurantID'],$row['Details'][0]['RestaurantName'],
      $row['Details'][0]['CountLikes'],$row['Details'][0]['CountDislikes'],$row['Details'][0]['isValid']);
      array_push($restaurantArray,$restaurant);
  }
  $date = date("Y-m-d");
  $time = date("h:i:s");
  $recommendationID = generateRandomID();
  $fiveRecommendationID ="";
  for($i=0;$i<count($restaurantArray);$i++){
      $fiveRecommendationID.=$restaurantArray[$i]->getRestaurantID().",";
  }
  $collection3 = $mongoConnection->selectCollection('swiftmeal', 'customer');
  $collection3->updateOne(
          ['_id' => $custID],
          ['$push' =>['UserRecommendations' => ['RecommendationID' => $recommendationID,'DateRecommended' => $date, 'TimeRecommended' => $time, 'RecommendedPlaces' => $fiveRecommendationID, 'AreaID' => $areaID]]]
  );
}
for($i=0;$i<count($restaurantArray);$i++){
  echo   "<li class='mdc-list-item' data-mdc-auto-init='MDCRipple' id='".$restaurantArray[$i]->getGeoLat().",".$restaurantArray[$i]->getGeoLong()."' value=".$i." name=".$restaurantArray[$i]->getRestaurantID().">".
  "<i class='mdc-list-item__start-detail material-icons' aria-hidden='true'>restaurant</i>".
 "<span id='selected-restaurant-name'class='mdc-list-item__text'>"
    .$restaurantArray[$i]->getRestaurantName().",".
   " <span class='mdc-list-item__text__secondary'>".$restaurantArray[$i]->getBuilding()." ".$restaurantArray[$i]->getBlock()." ".$restaurantArray[$i]->getStreet().
  " #".$restaurantArray[$i]->getFloor()."-"
  .$restaurantArray[$i]->getUnit().
  "</span>".
  "</span>
</li><script>coordinates.push([".$restaurantArray[$i]->getGeoLong().",".$restaurantArray[$i]->getGeoLat()."]);</script>";
}

?>