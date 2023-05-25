<?php

//PHP Example for creating JWT Token
//Change the below to be your secret key provided to you from ATD 
$key = 'sCrTkEy99';
$header = [
    'alg' => 'HS256',
    'typ' => 'JWT' ];
$header = json_encode($header);
//We need to fix some characters here
$header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
//replace below information with consumer data
$payload = [
    "name" => "Jpptwapimaster", 
    "location" => "2390941", 
    "address1" => "1901 W Madison St", 
    "city" => "Chicago",
    "state" => "IL",
    "postalCode" => "60612", 
    "country" => "US"
];
$payload = json_encode($payload);
//We need to fix some characters here
$payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
// Generates a keyed hash value using the HMAC method
$signature = hash_hmac('sha256', $header . "." . $payload, $key, true); //We need to fix some characters here
$signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
$token = "$header.$payload.$signature";
echo $token;
?>