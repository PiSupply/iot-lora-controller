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

//var_dump($_POST); //For Dev Only

//TheGatewayID Is based off of the mac and starts with PIS
$macAddress = substr(trim(shell_exec("cat /proc/cpuinfo | grep ^Serial")), -10);
$gatewayId = "504953".$macAddress;
$jsonDecoded['gateway_conf']['gateway_ID'] = $gatewayId;





if (php_sapi_name() != "cli") {

  if($_POST['semtech']) {
    $jsonDecoded['gateway_conf']['servers'][0]['serv_type'] = "semtech";
    $jsonDecoded['gateway_conf']['ref_latitude'] = floatval($_POST['latitude']);
    //Longitude
    $jsonDecoded['gateway_conf']['ref_longitude'] = floatval($_POST['longitude']);
    //Altitude
    $jsonDecoded['gateway_conf']['ref_altitude'] = intval($_POST['altitude']);

//Ports
$jsonDecoded['gateway_conf']['servers'][0]['serv_port_up'] = 1700;
$jsonDecoded['gateway_conf']['servers'][0]['serv_port_down'] = 1700;


    //Description
    $jsonDecoded['gateway_conf']['description'] = $_POST['description'];

    $jsonDecoded['gateway_conf']['servers'][0]['server_address'] = $_POST['serverAdd'];

    $regionSelected = $_POST['regionPlan'];

    $globalConfTemp = "/opt/iotloragateway/global_confs/".$regionSelected."-global_conf.json";


    $freqPlan = fopen($globalConfTemp, 'r');
    var_dump($freqPlan);

    $freqPlanRead= fread($freqPlan, filesize($globalConfTemp));
    $freqHandler = fopen($globalConfigLocation, 'w');
    //var_dump($freqHandler);
    fwrite($freqHandler, $freqPlanRead);
    fclose($freqHandler);


    //echo("Semtech on");
  }
  else {
    $jsonDecoded['gateway_conf']['servers'][0]['serv_type'] = "ttn";
  }

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

  if($_POST['gps']) {
    $jsonDecoded['gateway_conf']['gps'] = true;
    $jsonDecoded['gateway_conf']['fake_gps'] = false;
      $jsonDecoded['gateway_conf']['gps_tty_path'] = "/dev/ttyAMA0";
  }
  else {


  $jsonDecoded['gateway_conf']['gps'] = false;
  $jsonDecoded['gateway_conf']['fake_gps'] = true;


  }

}


#Only do the following if it's a TTN Server

if($jsonDecoded['gateway_conf']['servers'][0]['serv_type']  == "ttn") {
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




  //Serv type and enabled
  #$jsonDecoded['gateway_conf']['servers'][0]['serv_type'] = "ttn";
  $jsonDecoded['gateway_conf']['servers'][0]['serv_enabled'] = true;

  //Latitude


  $jsonDecoded['gateway_conf']['ref_latitude'] = $ttnApiData['location']['lat'];
  //Longitude
  $jsonDecoded['gateway_conf']['ref_longitude'] = $ttnApiData['location']['lng'];
  //Altitude
  $jsonDecoded['gateway_conf']['ref_altitude'] = $ttnApiData['altitude'];

  //Frequency Plan Updater

  $freqHandler = fopen($globalConfigLocation, 'w');

  $freqPlanJson = json_decode($frequencyPlan,true);

  //Implement workaround for As920 and as923

  if($freqPlanJson['SX1301_conf']['lbt_cfg']) {
      $freqPlanJson['SX1301_conf']['lbt_cfg']['enable'] = false;
}


$jsonFreqEncoded = json_encode($freqPlanJson, JSON_PRETTY_PRINT);
  fwrite($freqHandler, $jsonFreqEncoded);

  fclose($freqHandler);
}

$jsonEncoded = json_encode($jsonDecoded, JSON_PRETTY_PRINT);
$configHandler = fopen($configLocation, 'w');
fwrite($configHandler, $jsonEncoded);
fclose($configHandler);


if (php_sapi_name() != "cli") {
echo('
<div class="row align-items-center">
   <div class="text-center">
     <h1>Packet Forwarder Configuration Tool</h1>
     <h4>Configuration has been written, please reboot the packet forwarder from the commands tab.</h4>
   </div>
</div>
'
);
}

include('inc/footer.php');
 ?>
