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

$jsonDecoded = json_decode($currentConfig,true)['gateway_conf'];
$jsonServers = $jsonDecoded['servers'][0];
?>

<div class="row align-items-center">
   <div class="text-center">
     <h1>Host Configuration Tool</h1>
   </div>
</div>
<div class="row align-items-center">
   <div class="text-center">
     <h3>This page modifies the host (Raspberry Pi) configuration.</h3>
   </div>
</div>
<br>



  <div class="row">
    <div class="collumn">
       <h1 class="ui top attached block header">Edit Wi-Fi Configuration</h1>
       <form action="updateWiFi.php" method="post" class="ui form">
           <div class="ui bottom attached segment">

        <br/>
        <input type="submit" class="ui primary button" value="Update Configuration">
        </div>
       </form>
     </div>
    </div>
    <br/>

    <div class="row">
      <div class="collumn">
         <h1 class="ui top attached block header">Change Password</h1>
         <form action="updateWiFi.php" method="post" class="ui form">
             <div class="ui bottom attached segment">

          <br/>
          <input type="submit" class="ui primary button" value="Update Configuration">
          </div>
         </form>
       </div>
      </div>
</div>
<?php
include('inc/footer.php');
?>
