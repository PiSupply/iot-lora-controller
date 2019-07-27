<?php
/*
*IoT LoRa Gateway Controller
*Copyright (C) 2018-2019  Nebra LTD. T/a Pi Supply

*This program is free software: you can redistribute it and/or modify
*it under the terms of the GNU General Public License as published by
*the Free Software Foundation, either version 3 of the License, or
*(at your option) any later version.
*
*This program is distributed in the hope that it will be useful,
*but WITHOUT ANY WARRANTY; without even the implied warranty of
*MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*GNU General Public License for more details.
*
*You should have received a copy of the GNU General Public License
*along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

include('inc/header.php');

$configHandler = fopen($configLocation, 'r');
$currentConfig = fread($configHandler, filesize($configLocation));
fclose($configHandler);
$jsonDecoded = json_decode($currentConfig,true);


//TheGatewayID Is based off of the mac and starts with PIS
$macAddress = substr(trim(shell_exec("cat /proc/cpuinfo | grep ^Serial")), -10);
$gatewayId = "504953".$macAddress;
$jsonDecoded['gateway_conf']['gateway_ID'] = $gatewayId;



if (php_sapi_name() != "cli") {
//These values will be updated only if not run by the CLI
//This gateway ID Is the TTN Name, only if the value is not null
if($_POST['gatewayId']) {
  $jsonDecoded['gateway_conf']['servers'][0]['serv_gw_id'] = $_POST['gatewayId'];
}
//TTN key
if($_POST['ttnKey']) {
$jsonDecoded['gateway_conf']['servers'][0]['serv_gw_key'] = $_POST['ttnKey'];
}
//Contact Email
if($_POST['email']) {
$jsonDecoded['gateway_conf']['contact_email'] = $_POST['email'];
}


}

$ttnApiUrl = "https://account.thethingsnetwork.org/api/v2/gateways/".$jsonDecoded['gateway_conf']['servers'][0]['serv_gw_id'];
$ttnApiData = json_decode(file_get_contents($ttnApiUrl),true);
$frequencyPlan = file_get_contents($ttnApiData['frequency_plan_url']);
//We need to set the following
//TTN Server Address
$serverAddress = explode(":",$ttnApiData['router']['address'])[0];
//
if(strstr($serverAddress, "thethings.network")

) {
  $serverAddress = "bridge.".$serverAddress;

}
else {
  $serverAddress = $serverAddress;
}
$jsonDecoded['gateway_conf']['servers'][0]['server_address'] = $serverAddress;
//description
$jsonDecoded['gateway_conf']['description'] = $ttnApiData['attributes']['description'];

//currently GPS Is false and FakeGPS Is true
$jsonDecoded['gateway_conf']['gps'] = false;
$jsonDecoded['gateway_conf']['fake_gps'] = true;

//Serv type and enabled
$jsonDecoded['gateway_conf']['servers'][0]['serv_type'] = "ttn";
$jsonDecoded['gateway_conf']['servers'][0]['serv_enabled'] = true;

//Latitude
$jsonDecoded['gateway_conf']['ref_latitude'] = $ttnApiData['location']['lat'];
//Longitude
$jsonDecoded['gateway_conf']['ref_longitude'] = $ttnApiData['location']['lng'];
//Altitude
$jsonDecoded['gateway_conf']['ref_altitude'] = $ttnApiData['altitude'];

//Frequency Plan Updater

$freqHandler = fopen($globalConfigLocation, 'w');
fwrite($freqHandler, $frequencyPlan);
fclose($freqHandler);


$jsonEncoded = json_encode($jsonDecoded, JSON_PRETTY_PRINT);
$configHandler = fopen($configLocation, 'w');
fwrite($configHandler, $jsonEncoded);
fclose($configHandler);


if (php_sapi_name() != "cli") {
echo('
<div class="row align-items-center">
   <div class="text-center">
     <h1>IoT LoRa Gateway Configuration Tool</h1>
     <h4>Configuration has been written, please reboot the packet forwarder from the commands tab.</h4>
   </div>
</div>
'
);
}
 ?>
