<?php 

//  https://2ab9-102-219-208-34.in.ngrok.io/ussdsms/Codes-to-create-Ussd-sms-applications---menu/index.php

include_once 'menu.php';

// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

$isRegistered = true;
$menu = new Menu();
$text = $menu->middleware($text);
//$isRegistered = false;
//$menu = new Menu($text, $sessionId);  // adjusted after system was working fine

if ($text == "" &&  $isRegistered) {
      //user registered , string empty
      $menu->mainMenuRegistered();
     }else if($text == "" && !$isRegistered) {
      //user unregistered , string empty
        $menu->mainMenuUnRegistered();
     }else if(!$isRegistered) {
    //user unregisered , string not empty
         $textArray = explode("*", $text);
         switch($textArray[0]){
            case 1:
              $menu->registerMenu($textArray);
              break;
              default:
               echo "END Invalid choice. Please try again";
            }
           }else{
             //user registered , string not empty

            $textArray = explode("*", $text);
             switch($textArray[0]){
             case 1:
             $menu->sendMoneyMenu($textArray);
              break;
               case 2:
               $menu->WithdrawMoneyMenu($textArray);
               break;  
                case 3:
                 $menu->checkBalanceMenu($textArray);
                 break;  
                 default:
                echo "END Invalid choice. Please try again";

           }

}




?>