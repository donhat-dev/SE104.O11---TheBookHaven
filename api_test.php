<?php

echo "api test";

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://178.128.62.16:8069/api/v2/session',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'accept: application/json',
    'Authorization: Basic YWRtaW46YWRtaW4='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
