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


if($configurationFile['gateway-info']['initial-setup'] == 0) {
  //Send to first time setup
  header("Location: firstTimeSetup.php");
}

if($loggedIn == 0) {
  //Send to login page
  header("Location: login.php");
}


//var_dump($_POST); //For Dev Only

//Update WiFi Module

$configurationFile['wifi']['ssid'] = $_POST['SSID'];
$configurationFile['wifi']['password'] = $_POST['passwordWiFi'];
$configurationFile['wifi']['region'] = $_POST['region'];


yaml_emit_file('/opt/iotloragateway/config/gateway_configuration.yml',$configurationFile);

echo('
<div class="row align-items-center">
   <div class="text-center">
     <h1>WiFi Configuration Tool</h1>
     <h4>Configuration has been written, please reboot the system from the commands tab for the changes to be applied.</h4>
   </div>
</div>
'
);


 ?>
