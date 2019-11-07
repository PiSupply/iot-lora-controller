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

var_dump($_POST); //For Dev Only

if($_POST["loraModule"] == 2) {
  $loraModule = 2;
  $loraConfig = $configurationFile['packet-forwarder-2'];
}
else {
  $loraModule = 1;
  $loraConfig = $configurationFile['packet-forwarder-1'];
}

//Lets update the configuration file with all of the information.

//First which server is being used.
if($_POST['serverType'] == "TTN") {
$loraConfig['providerType'] = "TTN";
$loraConfig['packet-forwarder-id'] = $_POST['gatewayId'];
$loraConfig['packet-forwarder-key'] = $_POST['ttnKey'];
$loraConfig['router'] = $_POST['routerTtn'];
$loraConfig['frequency-plan'] = $_POST['frequencyPlan'];


}

elseif($_POST['serverType'] == "LORIOT") {
$loraConfig['providerType'] = "LORIOT";
$loraConfig['router'] = $_POST['routerLor'];
$loraConfig['frequency-plan'] = $_POST['frequencyPlan'];


}

elseif($_POST['serverType'] == "OTHER") {
  $loraConfig['providerType'] = "OTHER";
  $loraConfig['router'] = $_POST['routerOth'];
  $loraConfig['frequency-plan'] = $_POST['frequencyPlan'];


}

else {
  echo ("<h1>There has been an error processing the data, please re-submit");
  include('inc/footer.php');
  die();
}



if($_POST['enabled'] == "on") {
  $loraConfig['enabled'] = true;
}
else {
  $loraConfig['enabled'] = false;

}

if($loraModule == 2) {
   $configurationFile['packet-forwarder-2'] = $loraConfig;
}
else {
  $configurationFile['packet-forwarder-1'] = $loraConfig;
}

$configurationFile['location']['latitude'] = $_POST['latitude'];
$configurationFile['location']['longitude'] = $_POST['longitude'];
$configurationFile['location']['altitude'] = $_POST['altitude'];



yaml_emit_file('/opt/iotloragateway/config/gateway_configuration.yml',$configurationFile);

echo('
<div class="row align-items-center">
   <div class="text-center">
     <h1>Packet Forwarder Configuration Tool</h1>
     <h4>Configuration has been written, please reboot the packet forwarder from the commands tab.</h4>
   </div>
</div>
'
);


 ?>
