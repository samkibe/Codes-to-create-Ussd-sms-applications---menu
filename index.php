<?php 

//  https://2ab9-102-219-208-34.in.ngrok.io/ussdsms/Codes-to-create-Ussd-sms-applications---menu/index.php

include_once 'menu.php';
include_once 'db.php';
include_once 'user.php';

// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

//$isRegistered = true;
$user = new User($phoneNumber);
$db = new DBConnector();
$pdo = $db->connectToDB();

$menu = new Menu();
$text = $menu->middleware($text);
//$isRegistered = false;
//$menu = new Menu($text, $sessionId);  // adjusted after system was working fine

if($text == "" && $user->isUserRegistered($pdo) == true){
      //user registered , string empty
    echo "CON" . $menu->mainMenuRegistered($user->readName($pdo));
     }else if($text == "" && $user->isUserRegistered($pdo) == false) {
      //user unregistered , string empty
        $menu->mainMenuUnRegistered();
     }else if($user->isUserRegistered($pdo) == false){
    //user unregisered , string not empty
         $textArray = explode("*", $text);
         switch($textArray[0]){
            case 1:
              $menu->registerMenu($textArray, $phoneNumber, $pdo);
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
                 $ussdLevel = count($textArray) - 1;
                 $menu->persistInvalidEntry($sessionId, $user, $ussdLevel, $pdo);
                echo "CON Invalid menu\n" . $menu->mainMenuRegistered($user->readName($pdo));

           }

}




?>