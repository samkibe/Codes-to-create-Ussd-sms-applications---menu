<?php 

// https://6ef7-102-219-208-34.in.ngrok.io/ussdsms/index.php

include_once 'menu.php';

// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

$isRegistered = false;

if ($text == "" &&  !$isRegistered) {
      //user registered , string empty

    // This is the first request. Note how we start the response with CON
    //$response  = "CON What would you want to check \n";
    //$response .= "1. My Account \n";
    //$response .= "2. My Mobile number";

     }else if($text == "" && $isRegistered){
      //user unregistered , string empty


     }else if($isRegistered){
    //user unregisered , string not empty

       }else{
     //user registered , string not empty

}




?>