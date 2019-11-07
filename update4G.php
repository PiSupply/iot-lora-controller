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

//var_dump($_POST); //For Dev Only

//Update 4G Module
if($_POST['enable4G']) {
  $configurationFile['lte-modem']['enabled'] = true;
}
else {
  $configurationFile['lte-modem']['enabled'] = false;
}

$configurationFile['lte-modem']['apn'] = $_POST['apn'];
$configurationFile['lte-modem']['username'] = $_POST['username'];
$configurationFile['lte-modem']['password'] = $_POST['password'];
$configurationFile['lte-modem']['number'] = $_POST['number'];


yaml_emit_file('/opt/iotloragateway/config/gateway_configuration.yml',$configurationFile);

echo('
<div class="row align-items-center">
   <div class="text-center">
     <h1>4G Configuration Tool</h1>
     <h4>Configuration has been written, please reboot the system from the commands tab.</h4>
   </div>
</div>
'
);


 ?>
