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

      public function registerMenu(){}

      public function sendMoneyMenu(){}

      public function withdrawMoneyMenu(){}

      public function checkBalanceMenu(){}

   }
   

?>