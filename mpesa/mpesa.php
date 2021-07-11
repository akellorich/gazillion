p<?php
    class MPesa{
        private $consumerKey = 'so01jPYiHkFXGiW0oC2mwsawSD8yUiIG';
        private $consumerSecret = 'E5zOlM6rTA9JWIWc'; 
        private $shortCode='600324';
        public $accessToken;
        
        function __construct(){
            $this->getToken();
        }

        public function getToken(){
	        $headers = ['Content-Type:application/json'];
            //  charset=utf8
            $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_HEADER, FALSE);
            curl_setopt($curl, CURLOPT_USERPWD, $this->consumerKey.':'. $this->consumerSecret);
            $result = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $result = json_decode($result);

            $this->accessToken = $result->access_token;

            curl_close($curl);
        }

        public function registerURL($confirmationUrl,$validationUrl){
            $this->getToken();
            $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

            $access_token = ''; // check the mpesa_accesstoken.php file for this. No need to writing a new file here, just combine the code as in the tutorial.
                    
            // get the token
            $access_token=$this->accessToken;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
        
        
            $curl_post_data = array(
              //Fill in the request parameters with valid values
              'ShortCode' => $this->shortCode,
              'ResponseType' => 'Confirmed',
              'ConfirmationURL' => $confirmationUrl,
              'ValidationURL' => $validationUrl
            );
        
            $data_string = json_encode($curl_post_data);
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        
            $curl_response = curl_exec($curl);
           // print_r($curl_response);
        
            return $curl_response;
        }

        
    }

?>