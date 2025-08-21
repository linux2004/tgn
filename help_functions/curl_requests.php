<?php
class makeRequest{
     static function getResponse($curl):array{
        $return_error=FALSE;
        $error_message='';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch,CURLOPT_TIMEOUT,30);
        $response = curl_exec($ch);
        // Check if any error occurred
        if(curl_errno($ch)){ $error_message=curl_error($ch);$return_error=TRUE;}
        curl_close($ch);         
        return [$response,$return_error,$error_message];
        // Return multiple values as an array
        // return [$name, $age, $email];
    }
}