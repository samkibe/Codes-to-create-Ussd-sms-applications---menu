<?php
   class Util{
       //Db variables
       static $DB_NAME = "ussdsms";

     //static $DB_NAME = "ussd";
      //It is okay to use your own values here. for user,pass and,server name

       static $DB_USER = "root";
       static $DB_USER_PASS = "K1b8ish??";
       static $DB_SERVER_NAME = "localhost";

       //About USSD menu
       static $GO_BACK = "98";
       static $GO_TO_MAIN_MENU = "99";

       //user initial balance
       static $USER_BALANCE = 40000;
       static $COUNTRY_CODE = "+254";
       static $TRANSACTION_FEE = 50;

     //  static $API_KEY = "6eac7d474b5d0a7ea349c502a7bf841cd0b4b1a8b103bab02694aa8d5b8d6089";
       static $API_KEY = "9dd586bf310b04ee037f5696046c2e3f7030b1c51c09761d39421d8b62cc96c1";
       static $API_USERNAME = "sandbox";

        static $SMS_SHORTCODE = "70303";//sandbox
        static $COMPANY_NAME = "MOBI LTD";
        // static $SMS_SHORTCODE_KEYWORD = ""; //prod.

       //static $SMS_SHORTCODE = "70302"; //prod.
      // static $SMS_SHORTCODE_KEYWORD = ""; //prod.
        
   }

?>
