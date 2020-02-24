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


?>

<div class="row align-items-center">
   <div class="text-center">
     <h1>Wi-Fi Configuration Tool</h1>
   </div>
</div>
<div class="row align-items-center">
   <div class="text-center">

     <h4>This page allows you to configure the settings for Wi-Fi.</h4>
      <h5>This will configure Wi-Fi on Raspberry Pi, if using the Nebra Gateway you will need to insert a Wi-Fi Adapter</h5>
     </div>

</div>
<br>


<br/><br/>

<div class="row">
  <div class="coulumn">
     <h1 class="ui top attached block header">Edit config file - Wi-Fi</h1>
     <form action="updateWiFi.php" method="post" class="ui form">
         <div class="ui bottom attached segment">


         <div class="field">
          <label for="SSID">SSID:</label> Name of your Wi-Fi Network
          <input type="text" id="SSID" name="SSID" class="form-control" required <?php if($configurationFile['wifi']['ssid']!=null) { echo "value='".$configurationFile['wifi']['ssid']."'"; }?>/>
         </div>
         <br/>
         <div class="field">
          <label for="password">Password:</label> This is the password for your Wi-Fi Network
          <input type="text" id="passwordWifi" name="passwordWifi" class="form-control" <?php if($configurationFile['wifi']['password']!=null) { echo "value='".$configurationFile['wifi']['password']."'"; }?>/>
         </div>
         <br/>
         <div class="field">
          <label for="password">Region Code:</label> This is the 2 letter Region Code, you can find your one <a href="https://en.wikipedia.org/wiki/ISO_3166-1#Current_codes">Here</a>
          <input type="text" id="region" name="region" class="form-control" <?php if($configurationFile['wifi']['region']!=null) { echo "value='".$configurationFile['wifi']['region']."'"; }?>/>
         </div>
         <br/>


          <br/>
          <input type="submit" class="ui primary button" value="Update Configuration" >
          </div>
         </form>
       </div>
     </div>




<script src="js/configurePkt.js"></script>

<?php
include('inc/footer.php');
?>
