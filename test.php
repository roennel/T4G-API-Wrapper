<?php



namespace T4G;



header('content-type: text/plain');

error_reporting(E_ALL);

ini_set('display_errors', true);



require 'API.php';



$api = new API;

$api->auth('apikey', 'apisecret');



// Fetch Server #16 Info, Events, Status, Players (Only Russian Team), Chat (only chatlines containing 'hack'), Kicklog

$test = $api->getBlacklist()->getServer(['serverId' => 16])->events()->status()->players(['team' => 'ru'])->chat(['search' => 'hack'])->kicklog()->execute();



var_dump($test);



// Fetch Server #16 Info, Status

$test = $api->getBlacklist()->getServer(['serverId' => 16])->status()->execute();



var_dump($test);

