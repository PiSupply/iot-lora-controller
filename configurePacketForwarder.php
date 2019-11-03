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


<br/><br/>

<div class="row">
  <div class="coulumn">
     <h1 class="ui top attached block header">Edit config file - LoRa Module 1</h1>
     <form action="updatePacketfwd.php" method="post" class="ui form">
         <div class="ui bottom attached segment">

           <div class="field">
            <label for="emailAddr">LoRa Provider:</label>
            <select class="ui fluid search dropdown" name="serverType">
             <option value="TTN">The Things Network</option>
             <option value="LORIOT">Loriot</option>
             <option value="Other">Other</option>
            </select>

            <div class="field">
             <label for="emailAddr"  >Gateway EUI:</label> This is the fixed MAC address of this gateway.
             <h4><?php echo($configurationFile['packet-forwarder-1']['packet-forwarder-eui']); ?></h4>
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



      <br/>
      <input type="submit" class="ui primary button" value="Update Configuration" >
      </div>
     </form>
   </div>
 </div>
</div>

<div class="row">
  <div class="coulumn">
     <h1 class="ui top attached block header">Edit config file - LoRa Module 2</h1>
     <form action="updatePacketfwd.php" method="post" class="ui form">
         <div class="ui bottom attached segment">

           <div class="field">
            <label for="emailAddr">LoRa Provider:</label>
            <select class="ui fluid search dropdown" name="serverType">
             <option value="TTN">The Things Network</option>
             <option value="LORIOT">Loriot</option>
             <option value="Other">Other</option>
            </select>

            <div class="field">
             <label for="emailAddr"  >Gateway EUI:</label> This is the fixed MAC address of this gateway.
             <h4><?php echo($configurationFile['packet-forwarder-2']['packet-forwarder-eui']); ?></h4>
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



      <br/>
      <input type="submit" class="ui primary button" value="Update Configuration" >
      </div>
     </form>
   </div>
 </div>
</div>


<?php
include('inc/footer.php');
?>
