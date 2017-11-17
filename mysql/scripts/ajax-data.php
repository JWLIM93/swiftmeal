<?php

include 'db-functions.php';
include 'restaurant.php';

if(isset($_POST['areaID']) && !empty($_POST['areaID'])){
        $areaID = $_POST['areaID'];
        $restaurantArray = array();
        $restaurantSQL = "SELECT * FROM place p, placearea pa, area a,restaurant r
        WHERE
        p.PlaceID = pa.PlaceID AND
        pa.AreaID = a.AreaID
        AND r.PlaceID = p.PlaceID
        AND a.AreaID = '$areaID'"
    . "ORDER BY r.CountLikes DESC " ."LIMIT 5";
    $restaurantResult = connect_db()->query($restaurantSQL) or die(mysqli_error());
    if(mysqli_num_rows($restaurantResult) > 0){
      while($row = mysqli_fetch_array($restaurantResult)){
        $restaurant = new Restaurant($row['PlaceID'],$row['Block'],$row['Building'],$row['Floor'],$row['Street'],
        $row['Unit'],$row['GeoX'],$row['GeoY'],$row['GeoLat'],$row['GeoLong'],$row['DateAdded'],$row['TimeAdded'],$row['RestaurantID'],$row['RestaurantName'],
      $row['CountLikes'],$row['CountDislikes'],$row['isValid']);
      array_push($restaurantArray,$restaurant);


         
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
for($i=0;$i<count($restaurantArray);$i++){
  echo   "<li class='mdc-list-item' data-mdc-auto-init='MDCRipple' id='".$restaurantArray[$i]->getGeoLat().",".$restaurantArray[$i]->getGeoLong()."' value=".$i." name=".$restaurantArray[$i]->getRestaurantID().">".
  "<i class='mdc-list-item__start-detail material-icons' aria-hidden='true'>restaurant</i>".
 "<span id='selected-restaurant-name'class='mdc-list-item__text'>"
    .$restaurantArray[$i]->getRestaurantName().
   " <span class='mdc-list-item__text__secondary'>".$restaurantArray[$i]->getBuilding().",".$restaurantArray[$i]->getBlock()." ".$restaurantArray[$i]->getStreet().
  " #".$restaurantArray[$i]->getFloor()."-"
  .$restaurantArray[$i]->getUnit().
  "</span>".
  "</span>
</li><script>coordinates.push([".$restaurantArray[$i]->getGeoLong().",".$restaurantArray[$i]->getGeoLat()."]);</script>";
}

?>