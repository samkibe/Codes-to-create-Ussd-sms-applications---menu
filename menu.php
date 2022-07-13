<?php
  include_once 'util.php';
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
                $name = $textArray[1];
                $pin = $textArray[2];
                 $confirmPin = $textArray[3];
                  if($pin !=$confirmPin){
                  echo "END OOPS Your pins do not match. Please try again";
                  }else{
              //we can register user
              //send sms
                  echo "END You have been registered";
             }
            }
      }

      public function sendMoneyMenu($textArray){
        $level = count($textArray); 
        if($level == 1){
            echo "CON Enter mobile number of the receiver:";
        }else if($level == 2){
            echo "CON Enter amount:";
        }else if($level == 3){
            echo "CON Enter your PIN:";
        }else if($level == 4){
            $response = "CON Send " . $textArray[2] . " " . $textArray[1] . " \n";
            $response.= "1. Confirm\n";
            $response.= "2. Cancel\n";
            $response.= Util::$GO_BACK . " Back\n";
            $response.= Util::$GO_TO_MAIN_MENU . " Main menu\n";
            echo $response;
        }else if($level == 5 && $textArray[4] == 1){
            //a confirm
            //send the money plus process
            //check if PIN is correct
            //Sufficient funds
            echo "END Your request is being processed";;
        }else if($level == 5 && $textArray[4] == 2){
            //cancel
            echo "END Thank you for using our services";
        }else if($level == 5 && $textArray[4] == Util::$GO_BACK){
            echo "END You have requested to back up one step";
        }else if($level == 5 && $textArray[4] == Util::$GO_TO_MAIN_MENU){
            "END You have requested to back to main menu";
        }else{
            echo "END Invalid entry";
        }


      }

      public function withdrawMoneyMenu($textArray){}

      public function checkBalanceMenu($textArray){}

   }
   

?>