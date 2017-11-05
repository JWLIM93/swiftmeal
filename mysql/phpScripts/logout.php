<?php
include 'DBFunctions.php';
include 'customer.php';
session_start();
$customer = $_SESSION['Obj'];
$user_ID = $customer->getUser_id();
logOut($user_ID);
session_unset();
session_destroy();


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
