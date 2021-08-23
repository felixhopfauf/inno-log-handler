<?php

//Init Config File
$configs = include("config.php");

//Call Zammad REST API
function callGraylog($method, $url, $data){
    global $configs;
    $curl = curl_init();
    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
        case "DELETE":
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST, "DELETE");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       default:
          if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   //  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

//Get all Closed Tickets
function sendInput($json){

    global $configs;
    $gelfurl = "http://$configs[graylog_url]/gelf";
    $setmessage = callGraylog('POST', $gelfurl, $json);
    return($setmessage);

}
?>