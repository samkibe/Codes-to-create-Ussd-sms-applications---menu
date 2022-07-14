<?php
  include_once 'util.php';
  include_once 'user.php';
  include_once 'util.php';

   class Menu{
      protected $text;
      protected $sessionId;

      function __construct()
      {
        //new constructer after system testing was working fine
      }
     // function __construct($text, $sessionId)
     // {
        //$this->text = $text;
        //$this->sessionId = $sessionId;
      //}    // adjusted


      public function mainMenuRegistered($name){
           $response = " Welcome " . $name . " Reply with\n";
           $response .= "1. Send Money\n";
           $response .= "2. Withdraw\n";
           $response .= "3. Check balance\n";
           return $response;
      }

      public function mainMenuUnRegistered(){
            $response = " CON Hello I'm Kibe your Bot Assistance. Welcome to this app. Reply with\n";
            $response .= "1. Register\n";
            echo $response;
      }

      public function registerMenu($textArray, $phoneNumber, $pdo){
             $level = count($textArray);
             if($level == 1){
               echo "CON Please enter your full name:";
                }else if($level == 2){
                echo "CON Please enter your PIN:";
                }else if($level == 3){
                echo "CON Please Re-enter your PIN:";
                }else if($level== 4){
                $name = $textArray[1];
                $pin = $textArray[2];
                 $confirmPin = $textArray[3];
                  if($pin !=$confirmPin){
                  echo "END OOPS Your pins do not match. Please try again";
                  }else{
              //we can register user
              //send sms

              $user = new User($phoneNumber);
              $user->setName($name);
              $user->setPin($pin);
              $user->setBalance(Util::$USER_BALANCE);
              $user->register($pdo);
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
            $response = "CON Send " . $textArray[2] . " to " . $textArray[1] . " \n";
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

      public function withdrawMoneyMenu($textArray){
        $level = count($textArray); 
        if($level == 1){
            echo "CON Enter agent number:";
        }else if($level == 2){
            echo "CON Enter amount:";
        }else if($level == 3){
            echo "CON Enter your PIN:";
        }else if($level == 4){
       echo "CON Withdraw" . $textArray[2] . " from agent " . $textArray[1] . "\n 1. Confirm\n 2. Cancel\n";
        }else if($level == 5 && $textArray[4] == 1){
           //confirm
           //if sufficient funds
           //if PIN correct
           echo "END  Your request is being processed";
        }else if($level == 5 && $textArray[4] == 2){
            echo "END Thank you";
        }else{
            echo "END Invalid Entry";
        }
      }

      public function checkBalanceMenu($textArray){
        $level = count($textArray); 
        if($level == 1){
            echo "CON Enter PIN";
        }else if($level == 2){
            //logic
            //check if PIN is correct etc
            echo "END We are processing your request and you wil reeive an sms shortly";
        }else{
            echo "END Invalid entry";
        }
      }

      public function middleware($text, $user, $sessionId, $pdo){
        //remove entrie forgoing back and going to the main menu
        //return $this->goBack($this->goToMainMenu($text));

         return $this->invalidEntry($this->goBack($this->goToMainMenu($text)), $user, $sessionId, $pdo);
      }

      public function goBack($text){
          //1*4*5*1*98*2*1234
          $explodedText = explode("*", $text);
          while(array_search(Util::$GO_BACK, $explodedText)!= false){
            $firstIndex = array_search(Util::$GO_BACK, $explodedText);
            array_splice($explodedText, $firstIndex-1, 2);
          }

          return join("*", $explodedText);

      }

       public function goToMainMenu($text){
          //1*4*5*1*99*2*1234
          $explodedText = explode("*", $text);
          while(array_search(Util::$GO_TO_MAIN_MENU, $explodedText)!= false){
            $firstIndex = array_search(Util::$GO_TO_MAIN_MENU, $explodedText);
            $explodedText = array_slice($explodedText, $firstIndex +1);
          }

          return join("*", $explodedText);
       }
 
       public function persistInvalidEntry($sessionId, $user, $ussdLevel, $pdo){
        $stmt = $pdo->prepare("insert into ussdsession (sessionId,ussdLevel, uid) values (?,?,?)");
        $stmt->execute([$sessionId, $ussdLevel, $user->readUserId($pdo)]);
        $stmt= null;
       }
       public function invalidEntry($ussdStr, $user, $sessionId, $pdo){
        $stmt = $pdo->prepare("select ussdLevel from ussdsession where sessionId=?");
        $stmt->execute([$sessionId]);
        $result = $stmt->fetchAll();

        if(count($result) == 0){
            return $ussdStr;
        }

        $strArray = explode("*", $ussdStr);

        foreach ($result as $value){
            unset($strArray[$value['ussdLevel']]);
        }

        $strArray = array_values($strArray);

        return join("*", $strArray);
    }
    
   // public function addCountryCodeToPhoneNumber($phone){
   //     return Util::$COUNTRY_CODE . substr($phone, 1);
   // }





   }
   

?>