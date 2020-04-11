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

if($_GET["loraModule"] == 2) {
  $loraModule = 2;
  $loraConfig = $configurationFile['packet-forwarder-2'];
}
else {
  $loraModule = 1;
  $loraConfig = $configurationFile['packet-forwarder-1'];
}

if($configurationFile['gateway-info']['initial-setup'] == 0) {
  //Send to first time setup
  header("Location: firstTimeSetup.php");
}

if($loggedIn == 0) {
  //Send to login page
  header("Location: login.php");
}



$macAddress = implode(':', str_split($loraConfig['packet-forwarder-mac'],2));
?>

<div class="row align-items-center">
   <div class="text-center">
     <h1>Packet Forwarder Configuration Tool</h1>
   </div>
</div>
<div class="row align-items-center">
   <div class="text-center">
     <h4>This page modifies the packet forwarder configuration. After updating the configuration you will have to go to the system control's page to reload the software.</h4>
     </div>

     <?php
      if($configurationFile['packet-forwarder-2']['enabled'] == true) {
        if($loraModule == 1) {
            echo("<a href='configurePacketForwarder.php?loraModule=2'  class='ui big orange button fluid'>Configure Lora Module 2</a>");
        }
        elseif($loraModule == 2) {
            echo("<a href='configurePacketForwarder.php?loraModule=1'  class='ui big orange button fluid'>Configure Lora Module 1</a>");
        }
      }
      ?>
</div>
<br>


<br/><br/>

<div class="row">
  <div class="coulumn">
     <h1 class="ui top attached block header">Edit config file - LoRa Module <?php echo($loraModule); ?> </h1>
     <form action="updatePacketfwd.php" method="post" class="ui form">
         <div class="ui bottom attached segment">

           <div class="field">
            <label for="emailAddr">LoRa Provider:</label>
            <select class="ui fluid search dropdown" name="serverType" id="serverType">
             <option value="TTN" <?php if($loraConfig['providerType']=="TTN") { echo "selected"; }?>>The Things Network</option>
             <option value="TTI" <?php if($loraConfig['providerType']=="TTN") { echo "selected"; }?>>The Things Industries</option>
             <option value="LORIOT" <?php if($loraConfig['providerType']=="LORIOT") { echo "selected"; }?>>Loriot</option>
             <option value="CHIRPL" <?php if($loraConfig['providerType']=="CHIRPL") { echo "selected"; }?>>Chirpstack Bridge</option>
             <option value="OTHER" <?php if($loraConfig['providerType']=="OTHER") { echo "selected"; }?>>Other</option>
            </select>
          </div>
          <br/>

          <div class="field">
           <label for="emailAddr"  >Gateway EUI:</label> This is the fixed EUI address of this gateway.
           <h4><?php echo($loraConfig['packet-forwarder-eui']); ?></h4>
          </div>
          <br/>

          <div class="field">
          <label for="emailAddr"  >Gateway MAC:</label> This is the fixed MAC address of this gateway.
          <h4><?php echo($macAddress); ?></h4>
         </div>
         <br/>

          <!--Display these fields for TTN only-->
          <div class="field" id="ttnIDF" hidden>
           <label for="gatewayId"  >TTN ID:</label> This is the same as the Gateway ID from the TTN Console.
           <input type="text" id="gatewayId" name="gatewayId" class="form-control"  <?php if($loraConfig['packet-forwarder-id']!=null) { echo "value='".$loraConfig['packet-forwarder-id']."'"; }?>/>
            <br/>
          </div>

          <div class="field" id="ttnKeyF" hidden>
           <label for="ttnKey" >TTN Gateway Key:</label> This is the Gateway Key from the TTN Console
           <input type="text" id="ttnKey"name="ttnKey" class="form-control"  minlength=101 <?php if($loraConfig['packet-forwarder-key']!=null) { echo "value='".$loraConfig['packet-forwarder-key']."'"; }?>/>

           <br/>

          </div>

          <div class="field" id="ttnServF" hidden>
           <label for="routerTtn">TTN Server:</label>
           <select class="ui fluid search dropdown" name="routerTtn">
            <option value="ttn.thingsconnected.net" <?php if($loraConfig['router']=="ttn.thingsconnected.net") { echo "selected"; }?>>digitalcatapult-uk-router</option>
            <option value="thethings.meshed.com.au" <?php if($loraConfig['router']=="thethings.meshed.com.au") { echo "selected"; }?>>meshed-router</option>
            <option value="ttn.opernnetworkinfrastructure.org" <?php if($loraConfig['router']=="ttn.opernnetworkinfrastructure.org") { echo "selected"; }?>>switch-router</option>
            <option value="bridge.asisa-se.thethings.network" <?php if($loraConfig['router']=="bridge.asisa-se.thethings.network") { echo "selected"; }?>>ttn-router-asia-se</option>
            <option value="bridge.brazil.thethings.network" <?php if($loraConfig['router']=="bridge.brazil.thethings.network") { echo "selected"; }?>>ttn-router-brazil</option>
            <option value="bridge.eu.thethings.network" <?php if($loraConfig['router']=="bridge.eu.thethings.network") { echo "selected"; }?>>ttn-router-eu</option>
            <option value="bridge.asia-se.thethings.network" <?php if($loraConfig['router']=="bridge.asia-se.thethings.network") { echo "selected"; }?>>ttn-router-jp</option>
            <option value="bridge.us-west.thethings.network" <?php if($loraConfig['router']=="bridge.us-west.thethings.network") { echo "selected"; }?>>ttn-router-us-west</option>
           </select>

           <br/>
         </div>


          <!--Display these fields for Loriot-->
          <div class="field" id="loriotServF" hidden>
           <label for="routerLor">Loriot Server:</label>
           <select class="ui fluid search dropdown" name="routerLor">
            <option value="af1.loriot.io"  <?php if($loraConfig['router']=="af1.loriot.io") { echo "selected"; }?>>AF1</option>
            <option value="ap1.loriot.io" <?php if($loraConfig['router']=="ap1.loriot.io") { echo "selected"; }?>>AP1</option>
            <option value="ap2.loriot.io" <?php if($loraConfig['router']=="ap2.loriot.io") { echo "selected"; }?>>AP2</option>
            <option value="ap3.loriot.io" <?php if($loraConfig['router']=="ap3.loriot.io") { echo "selected"; }?>>AP3</option>
            <option value="au1.loriot.io" <?php if($loraConfig['router']=="au1.loriot.io") { echo "selected"; }?>>AU1</option>
            <option value="cn1.loriot.io" <?php if($loraConfig['router']=="cn1.loriot.io") { echo "selected"; }?>>CN1</option>
            <option value="eu1.loriot.io" <?php if($loraConfig['router']=="eu1.loriot.io") { echo "selected"; }?>>EU1</option>
            <option value="eu2.loriot.io" <?php if($loraConfig['router']=="eu2.loriot.io") { echo "selected"; }?>>EU2</option>
            <option value="eu3.loriot.io" <?php if($loraConfig['router']=="eu3.loriot.io") { echo "selected"; }?>>EU3</option
            <option value="uk1.loriot.io" <?php if($loraConfig['router']=="uk1.loriot.io") { echo "selected"; }?>>UK1</option>
            <option value="us1.loriot.io" <?php if($loraConfig['router']=="us1.loriot.io") { echo "selected"; }?>>US1</option>
            <option value="us1.loriot.io" <?php if($loraConfig['router']=="us2.loriot.io") { echo "selected"; }?>>US2</option>
           </select>

           <br/>
         </div>

          <!--Display these fields for Other-->

          <div class="field" id="servF" hidden>
           <label for="routerOth">Server Address:</label> The IP of the LoRa Server / Provider you wish to use.
           <input type="text" id="routerOth" name="routerOth" class="form-control" <?php if($loraConfig['router']!=null) { echo "value='".$loraConfig['router']."'"; }?> />
           <br/>
          </div>


          <!--Display this for Loriot & Other-->

          <div class="field" id="freqF" hidden>
           <label for="frequencyPlan">Frequency Plan:</label>
           <select class="ui fluid search dropdown" name="frequencyPlan">
            <option value="AS920" <?php if($loraConfig['frequency-plan']=="AS920") { echo "selected"; }?>>AS920</option>
            <option value="AS923" <?php if($loraConfig['frequency-plan']=="AS923") { echo "selected"; }?>>AS923</option>
            <option value="AU915" <?php if($loraConfig['frequency-plan']=="AU915") { echo "selected"; }?>>AU915</option>
            <option value="CN470" <?php if($loraConfig['frequency-plan']=="CN470") { echo "selected"; }?>>CN470</option>
            <option value="EU868" <?php if($loraConfig['frequency-plan']=="EU868") { echo "selected"; }?>>EU868</option>
            <option value="IN865" <?php if($loraConfig['frequency-plan']=="IN865") { echo "selected"; }?>>IN865</option>
            <option value="KR920" <?php if($loraConfig['frequency-plan']=="KR920") { echo "selected"; }?>>KR920</option>
            <option value="RU864" <?php if($loraConfig['frequency-plan']=="RU864") { echo "selected"; }?>>RU864</option>
            <option value="US915" <?php if($loraConfig['frequency-plan']=="US915") { echo "selected"; }?>>US915</option>
           </select>

           <br/>
         </div>

         <div class="field">
          <label for="gatewayId">Latitude:</label> Latitude of the gateway's location.
          <input type="text" id="latitude" name="latitude" class="form-control" required <?php if($configurationFile['location']['latitude']!=null) { echo "value='".$configurationFile['location']['latitude']."'"; }?>/>
         </div>
         <br/>
         <div class="field">
          <label for="longitude">Longitude:</label> Longitude of the gateway's location.
          <input type="text" id="longitude" name="longitude" class="form-control" required <?php if($configurationFile['location']['longitude']!=null) { echo "value='".$configurationFile['location']['longitude']."'"; }?> />
         </div>
         <br/>
         <div class="field">
          <label for="altitude">Altitude:</label> Approximate altitude of the gateway in meters.
          <input type="text" id="altitude" name="altitude" class="form-control" required  <?php if($configurationFile['location']['altitude']!=null) { echo "value='".$configurationFile['location']['altitude']."'"; }?>/>
         </div>
         <br/>

         <div class="field">
           <label for="enable"  >Enable LoRa Module <?php echo($loraModule); ?>:</label> Enables the LoRa Module.
           <br/><br/>
           <div class="ui slider checkbox">
            <input type="checkbox" name="enabled" id="enabled" class="form-control" <?php if($loraConfig['enabled'] == "true") { echo "checked";}?> >
            <label>Enable LoRa Module <?php echo($loraModule); ?></label>
           </div>
          </div>
          <br/>

          <input id="loraModule" name="loraModule" type="hidden" value="<?php echo($loraModule);?>">
          <br/>



          <input type="submit" class="ui primary button" value="Update Configuration" >
          </div>
         </form>
       </div>
     </div>
    </div>
    </div>

<script src="js/configurePkt.js"></script>

<?php
include('inc/footer.php');
?>
