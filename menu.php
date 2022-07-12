<?php
   class Menu{
      protected $text;
      protected $sessionId;

      function __construct($text, $sessionId)
      {
        $this->text = $text;
        $this->sessionId = $sessionId;
      }
      public function mainMenuRegistered(){
           $response = "CON Reply with\n";
           $response .= "1. Send Money\n";
           $response .= "2. Withdraw\n";
           $response .= "3. Check balance\n";
           echo $response;
      }

      public function mainMenuUnRegistered(){
            $response = " CON Hello I'm Kibe your Bot Assistance. Welcome to this app. Reply with\n";
            $response .= "1. Register\n";
            echo $response;
      }

      public function registerMenu($textArray){
             $level = count($textArray);
             if($level == 1){
                echo "CON Please enter your full name:";
             }else if($level == 2){
                echo "CON Please enter your PIN:";
             }else if($level == 3){
                echo "Please Re-enter your PIN:";
             }else if($level== 4){
             $name = $textArray [1];
             $pin = $textArray[2];
             $confirmPin = $textArray[3];
             if($pin !=$confirmPin){
                echo "END Your pins do not match. Please try again";
             }else{
              //we can register user
              //send sms
                echo "END You have been registered";

             }


             }


      }

      public function sendMoneyMenu($textArray){}

      public function withdrawMoneyMenu($textArray){}

      public function checkBalanceMenu($textArray){}

   }
   

?>