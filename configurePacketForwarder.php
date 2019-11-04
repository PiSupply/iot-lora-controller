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
            <select class="ui fluid search dropdown" name="serverType" id="serverType">
             <option value="TTN">The Things Network</option>
             <option value="LORIOT">Loriot</option>
             <option value="Other">Other</option>
            </select>
          </div>
          <br/>

          <div class="field">
           <label for="emailAddr"  >Gateway EUI:</label> This is the fixed MAC address of this gateway.
           <h4><?php echo($configurationFile['packet-forwarder-1']['packet-forwarder-eui']); ?></h4>
          </div>
          <br/>

          <!--Display these fields for TTN only-->
          <div class="field" id="ttnIDF" hidden>
           <label for="gatewayId"  >TTN ID:</label> This is the same as the Gateway ID from the TTN Console.
           <input type="text" id="gatewayId" name="gatewayId" class="form-control" required <?php if($configurationFile['packet-forwarder-2']['packet-forwarder-id']!=null) { echo "value='".$configurationFile['packet-forwarder-2']['packet-forwarder-id']."'"; }?>/>
            <br/>
          </div>

          <div class="field" id="ttnKeyF" hidden>
           <label for="ttnKey" >TTN Gateway Key:</label> This is the Gateway Key from the TTN Console
           <input type="text" id="ttnKey"name="ttnKey" class="form-control" required minlength=101 <?php if($jsonServers['serv_gw_key']!=null) { echo "value='".$jsonServers['serv_gw_key']."'"; }?>/>

           <br/>

          </div>

          <div class="field" id="ttnServF" hidden>
           <label for="routerTtn">TTN Server:</label>
           <select class="ui fluid search dropdown" name="routerTtn">
            <option value="ttn.thingsconnected.net">digitalcatapult-uk-router</option>
            <option value="thethings.meshed.com.au">meshed-router</option>
            <option value="ttn.opernnetworkinfrastructure.org">switch-router</option>
            <option value="bridge.asisa-se.thethings.network">ttn-router-asia-se</option>
            <option value="bridge.brazil.thethings.network">ttn-router-brazil</option>
            <option value="bridge.eu.thethings.network">ttn-router-eu</option>
            <option value="bridge.asia-se.thethings.network">ttn-router-jp</option>
            <option value="bridge.us-west.thethings.network">ttn-router-us-west</option>
           </select>

           <br/>
         </div>


          <!--Display these fields for Loriot-->
          <div class="field" id="loriotServF" hidden>
           <label for="routerLor">Loriot Server:</label>
           <select class="ui fluid search dropdown" name="routerLor">
            <option value="">AF1</option>
            <option value="">AP1</option>
            <option value="">AP2</option>
            <option value="">AP3</option>
            <option value="">AU1</option>
            <option value="">CN1</option>
            <option value="">EU1</option>
            <option value="">EU2</option>
            <option value="">EU3</option>
            <option value="">CN1</option>
            <option value="">UK1</option>
            <option value="">US1</option>
            <option value="">US2</option>
           </select>

           <br/>
         </div>

          <!--Display these fields for Other-->

          <div class="field" id="servF" hidden>
           <label for="routerOth">Server Address:</label> The IP of the LoRa Server / Provider you wish to use.
           <input type="text" id="routerOth" name="routerOth" class="form-control" required />

           <br/>
          </div>


          <!--Display this for Loriot & Other-->

          <div class="field" id="freqF" hidden>
           <label for="frequencyPlan">Frequency Plan:</label>
           <select class="ui fluid search dropdown" name="frequencyPlan">
            <option value="AS920">AS920</option>
            <option value="AS923">AS923</option>
            <option value="AU915">AU915</option>
            <option value="CN470">CN470</option>
            <option value="EU868">EU868</option>
            <option value="IN865">IN865</option>
            <option value="KR920">KR920</option>
            <option value="RU864">RU864</option>
            <option value="US915">US915</option>
           </select>

           <br/>
         </div>

         <div class="field">
          <label for="gatewayId">Latitude:</label> Latitude of the gateway's location.
          <input type="text" id="latitude" name="latitude" class="form-control" required />
         </div>
         <br/>
         <div class="field">
          <label for="longitude">Longitude:</label> Longitude of the gateway's location.
          <input type="text" id="longitude" name="longitude" class="form-control" required />
         </div>
         <br/>
         <div class="field">
          <label for="altitude">Altitude:</label> Approximate altitude of the gateway in meters.
          <input type="text" id="altitude" name="altitude" class="form-control" required />
         </div>
         <br/>

          <input id="loraModule" name="loraModule" type="hidden" value="1">
          <br/>
          <input type="submit" class="ui primary button" value="Update Configuration" >
          </div>
         </form>
       </div>
     </div>
    </div>
    </div>


<?php
include('inc/footer.php');
?>
