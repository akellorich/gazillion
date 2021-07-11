<?php
    require_once("settings.php");
    require('../vendor/autoload.php');
    use AfricasTalking\SDK\AfricasTalking;
    class sms extends settings{
        private $senderid;
        private $userid;
        private $apikey;
        public function __construct(){
            $rst=$this->getsmsconfigurationasobject();
            $row=$rst->fetch(PDO::FETCH_ASSOC);
            $this->senderid=$row['senderid'];
            $this->username=$row['username'];
            $this->apikey=$row['apikey'];
        } 

        public function sendSMS($recipients,$message){
            $AT = new AfricasTalking($this->username, $this->apikey);
            $sms = $AT->sms();
            $from = $this->senderid;

            try {
                $result = $sms->send([
                    'to'      => $recipients,
                    'message' => $message,
                    'from'    => $from
                ]);
            
                return $result['status'];
            } catch (Exception $e) {
                // queue in the database for sending later
                return "Error: ".$e->getMessage();
            }
        }
    }
?>