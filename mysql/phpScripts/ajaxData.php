<?php

include 'DBFunctions.php';

if(isset($_POST['areaID']) && !empty($_POST['areaID'])){
        $areaID = $_POST['areaID'];
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
          
        echo   "<li class='mdc-list-item' data-mdc-auto-init='MDCRipple' id='".$row['GeoLat'].",".$row['GeoLong']."'>".
                "<i class='mdc-list-item__start-detail material-icons' aria-hidden='true'>restaurant</i>".
               "<span class='mdc-list-item__text'>"
                  .$row['RestaurantName'].
                 " <span class='mdc-list-item__text__secondary'>".$row['Building'].",".$row['Block']." ".$row['Street'].
                " #".$row['Floor']."-"
                .$row['Unit'].
                "</span>".
                "</span>
              </li>";
         
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

