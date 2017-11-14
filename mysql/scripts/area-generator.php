<?php
include 'db-functions.php';
include 'area.php';
$areaArray = array();
$areaArray = getAreas();
echo "<select class='mdc-select' data-mdc-auto-init='MDCRipple' name='area' id='area'>";
echo "<option value='' selected>Select an Area</option>";
echo "<optgroup label='Areas'>";
for($i = 0; $i < count($areaArray);$i++){
    echo "<option   value='".$areaArray[$i]->getAreaID().",".$areaArray[$i]->getAreaLat().",".$areaArray[$i]->getAreaLong()."'>".$areaArray[$i]->getAreaName()."</option> <br/>";
}
echo "</optgroup>";
echo "</select>";



?>


    
               