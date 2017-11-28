<?php
include 'db-functions.php';
include 'area.php';
$areaArrayOwner = array();
$areaArrayOwner = getAreas();
echo "<select class='mdc-select' data-mdc-auto-init='MDCRipple' name='area' id='area'>";
echo "<option value='' selected>Select an Area</option>";
echo "<optgroup label='Areas'>";
for($i = 0; $i < count($areaArrayOwner);$i++){
    echo "<option   value='".$areaArrayOwner[$i]->getAreaID().",".$areaArrayOwner[$i]->getAreaLat().",".$areaArrayOwner[$i]->getAreaLong().",".$areaArrayOwner[$i]->getAreaName()."'>".$areaArrayOwner[$i]->getAreaName()."</option> <br/>";
}
echo "</optgroup>";
echo "</select>";



?>


    
               