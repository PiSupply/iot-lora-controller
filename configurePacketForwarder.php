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
     <h1>Packet Forwarder Configuration Tool</h1>
   </div>
</div>
<div class="row align-items-center">
   <div class="text-center">
     <h4>This page modifies the packet forwarder configuration. After updating the configuration you will have to go to the system control's page to reload the software.</h4>
     <h4>To use either select TTN Mode, Or Legacy Mode and then fill out the corrosponding values.</h4>
     <h5>Please note, switching between modes will wipe the settings for the packet forwarder and is not reversible</h5>
   </div>
</div>
<br>


<div class="row">
  <div class="coullumn">
     <h1 class="ui top attached block header">Edit config file - Mode Select</h1>

     <form action="updatePacketfwd.php" method="post" class="ui form">
         <div class="ui bottom attached segment">



<div class="field">
 <label for="emailAddr"  >Enable Semtech Mode:</label> Sets the packet forwarder to legacy semtech mode.
 <br/><br/>
 <div class="ui slider checkbox">
   <input type="checkbox" name="semtech"  class="form-control" <?php if($jsonDecoded['gps'] == "true") { echo "checked";}?> >
   <label>Enable Semtech Mode</label>
 </div>
 </div>
<br/>




      <br/>
      <input type="submit" class="ui primary button" value="Update Configuration">
      </div>
     </form>
   </div>
  </div>
<br/><br/>
<?php


if($jsonServers['serv_type'] == "ttn") {

  ?>


<div class="row">
  <div class="coullumn">
     <h1 class="ui top attached block header">Edit config file - TTN Server</h1>
     <form action="updatePacketfwd.php" method="post" class="ui form">
         <div class="ui bottom attached segment">
      <div class="field">
       <label for="emailAddr">Contact Email Address:</label> Contact email address in case of any issues.
       <input type="email" id="email" name="email" class="form-control" required <?php if($jsonDecoded['contact_email']!=null) { echo "value='".$jsonDecoded['contact_email']."'"; }?>/>
       </div>
       <br/>
      <div class="field">
       <label for="emailAddr"  >Gateway ID:</label> This is the same as the Gateway ID from the TTN Console.
       <input type="text" id="gatewayId" name="gatewayId" class="form-control" required <?php if($jsonServers['serv_gw_id']!=null) { echo "value='".$jsonServers['serv_gw_id']."'"; }?>/>
       </div>
       <br/>

      <div class="field">
       <label for="emailAddr"  >TTN Gateway Key:</label> This is the Gateway Key from the TTN Console
       <input type="text" id="ttnKey"name="ttnKey" class="form-control" required minlength=101 <?php if($jsonServers['serv_gw_key']!=null) { echo "value='".$jsonServers['serv_gw_key']."'"; }?>/>
       </div>
       <br/>

<div class="field">
 <label for="emailAddr"  >Enable GPS Module:</label> Enables use of the GPS Module. Only set if you have a GPS module plugged in.
 <br/><br/>
 <div class="ui slider checkbox">
   <input type="checkbox" name="gps"  class="form-control" <?php if($jsonDecoded['gps'] == "true") { echo "checked";}?> >
   <label>Enable GPS Module</label>
 </div>
 </div>
<br/>

       <div class="field">
        <h3>Missing Fields?</h3>
        <p>Location, TTN Region, Server and more are all got by your gateway from the TTN Console. Use the TTN Console to setup these settings.</p>
        <p>Then reboot the packet forwarder from the controls page to update the settings</p>
          </div>


      <br/>
      <input type="submit" class="ui primary button" value="Update Configuration">
      </div>
     </form>
   </div>
  </div>

  <br/>
  <br/>

<?php
}
if($jsonServers['serv_type'] == "semtech") {
 ?>
  <div class="row">
    <div class="coullumn">
       <h1 class="ui top attached block header">Edit config file - Semtech Server</h1>



       <form action="updatePacketfwd.php" method="post" class="ui form">
           <div class="ui bottom attached segment">

             <div class="field">
              <h3>Semtech / Legacy Mode</h3>
              <p>You have selected Semtech / Legacy Mode, this allows you to connect to most LoRa Network providers by providing an IP / Domain name and ports.</p>
              <p>If you wish to use TTN in this mode you will have to select legacy forwarder. Please note your ID Is fixed and based from the MAC address of the RPi</p>
                </div>

        <div class="field">
         <label for="emailAddr">Contact Email Address:</label> Contact email address in case of any issues.
         <input type="email" id="email" name="email" class="form-control" required <?php if($jsonDecoded['contact_email']!=null) { echo "value='".$jsonDecoded['contact_email']."'"; }?>/>
         </div>
         <br/>
        <div class="field">
         <label for="emailAddr"  >Gateway ID:</label>
         <input type="text" id="gatewayId" name="gatewayId" class="form-control" required <?php if($jsonDecoded['gateway_ID']!=null) { echo "value='".$jsonDecoded['gateway_ID']."'"; }?>/>
         </div>
         <br/>

        <div class="field">
         <label for="emailAddr"  >Gateway Key:</label> This is the Gateway Key from the TTN Console
         <input type="text" id="ttnKey"name="ttnKey" class="form-control" required minlength=101 <?php if($jsonServers['serv_gw_key']!=null) { echo "value='".$jsonServers['serv_gw_key']."'"; }?>/>
         </div>
         <br/>

         <div class="field">
          <label for="emailAddr"  >Gateway Key:</label> This is the Gateway Key from the TTN Console
          <input type="text" id="ttnKey"name="ttnKey" class="form-control" required minlength=101 <?php if($jsonServers['serv_gw_key']!=null) { echo "value='".$jsonServers['serv_gw_key']."'"; }?>/>
          </div>
          <br/>


        <div class="field">
         <label for="emailAddr"  >Enable GPS Module:</label> Enables use of the GPS Module. Only set if you have a GPS module plugged in.
         <br/><br/>
         <div class="ui slider checkbox">
           <input type="checkbox" name="gps"  class="form-control" <?php if($jsonDecoded['gps'] == "true") { echo "checked";}?> >
           <label>Enable GPS Module</label>
         </div>
         </div>
        <br/>

                  <div class="field">
                   <label for="emailAddr"  >Gateway Key:</label> This is the Gateway Key from the TTN Console
                   <input type="text" id="ttnKey"name="ttnKey" class="form-control" required minlength=101 <?php if($jsonServers['serv_gw_key']!=null) { echo "value='".$jsonServers['serv_gw_key']."'"; }?>/>
                   </div>
                   <br/>

                   <div class="field">
                    <label for="emailAddr"  >Gateway Key:</label> This is the Gateway Key from the TTN Console
                    <input type="text" id="ttnKey"name="ttnKey" class="form-control" required minlength=101 <?php if($jsonServers['serv_gw_key']!=null) { echo "value='".$jsonServers['serv_gw_key']."'"; }?>/>
                    </div>
                    <br/>
                    <div class="field">
                     <label for="emailAddr"  >Gateway Key:</label> This is the Gateway Key from the TTN Console
                     <input type="text" id="ttnKey"name="ttnKey" class="form-control" required minlength=101 <?php if($jsonServers['serv_gw_key']!=null) { echo "value='".$jsonServers['serv_gw_key']."'"; }?>/>
                     </div>
                     <br/>        




        <br/>
        <input type="submit" class="ui primary button" value="Update Configuration">
        </div>
       </form>
     </div>
    </div>

    <?php

  } ?>



</div>


<?php
include('inc/footer.php');
?>
