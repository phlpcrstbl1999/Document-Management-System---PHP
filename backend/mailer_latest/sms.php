<?php
//Send an SMS using Gatewayapi.com
// $url = "https://gatewayapi.com/rest/mtsms";
// $api_token = "lfkNys5zQ52JaQlLDJm1FmamidB809OOFQPkTPn7csnwR098A1dUnReu2USOeKxd";

// //Set SMS recipients and content
// $recipients = [639178473296];
// $json = [
//     'sender' => 'PhilFirst',
//     'message' => 'Hello sir BJ May Bayad po Itong Text. 0.029 EU',
//     'recipients' => [],
// ];
// foreach ($recipients as $msisdn) {
//     $json['recipients'][] = ['msisdn' => $msisdn];
// }

// //Make and execute the http request
// //Using the built-in 'curl' library
// $ch = curl_init();
// curl_setopt($ch,CURLOPT_URL, $url);
// curl_setopt($ch,CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
// curl_setopt($ch,CURLOPT_USERPWD, $api_token.":");
// curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($json));
// curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
// $result = curl_exec($ch);
// curl_close($ch);
// print($result);
// $json = json_decode($result);
// print_r($json->ids);

echo $base_url="http://".$_SERVER['SERVER_NAME'].'/sr/login.php';
echo '<br>';

echo $base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';

echo '<br>';
echo $base_url1="http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER["REQUEST_URI"].'?').'/';

?>