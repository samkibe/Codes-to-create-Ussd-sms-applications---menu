<?php 

//  https://2ab9-102-219-208-34.in.ngrok.io/ussdsms/Codes-to-create-Ussd-sms-applications---menu/index.php

include_once 'menu.php';

// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

$isRegistered = true;
$isRegistered = false;

$menu = new Menu($text, $sessionId);

if ($text == "" &&  !$isRegistered) {
      //user registered , string empty

      $menu->mainMenuUnRegistered();

    // This is the first request. Note how we start the response with CON
   

     }else if($text == "" && $isRegistered) {
      //user unregistered , string empty

        $menu->mainMenuRegistered();

     }else if($isRegistered) {
    //user unregisered , string not empty

       }else{
     //user registered , string not empty

}




?>