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
      <input type="submit" class="ui primary button" value="Update Configuration" >
      </div>
     </form>
   </div>
  </div>

  <br/>
  <br/>


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
          <label for="emailAddr"  >Description:</label>
          <input type="text" id="description" name="description" class="form-control" required <?php if($jsonDecoded['description']!=null) { echo "value='".$jsonDecoded['description']."'"; }?>/>
          </div>
          <br/>


                  <div class="field">
                   <label for="emailAddr"  >Server Address:</label>
                   <input type="text" id="serverAdd" name="serverAdd" class="form-control" required minlength=5 <?php if($jsonServers['server_address']!=null) { echo "value='".$jsonServers['server_address']."'"; }?>/>
                   </div>
                   <br/>

        <div class="field">
         <label for="emailAddr"  >Gateway Key:</label> This is the Gateway Key from the TTN Console
         <input type="text" id="ttnKey"name="ttnKey" class="form-control" required minlength=101 <?php if($jsonServers['serv_gw_key']!=null) { echo "value='".$jsonServers['serv_gw_key']."'"; }?>/>
         </div>
         <br/>

         <div class="field">
          <label for="emailAddr"  >Region Plan:</label>
          <select class="ui fluid search dropdown" name="regionPlan">
           <option value="EU">Europe 868</option>
           <option value="US">United States 915</option>
           <option value="AS1">Asia 920-923</option>
           <option value="AS2">Asia 923-925</option>
           <option value="AU">Australia 915</option>
           <option value="CN">China 470-510</option>
           <option value="IN">India 865-867</option>
           <option value="KR">Kora 920-923</option>
           <option value="RU">Russia 864-870</option>
         </select>

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

                  <h4>These values will be ignored if the GPS module is enabled</h4>
                  <div class="field">
                   <label for="emailAddr"  >Latitude:</label> This is the Gateway Key from the TTN Console
                   <input type="text" id="latitude" name="latitude" class="form-control"  minlength=3 <?php if($jsonDecoded['ref_latitude']!=null) { echo "value='".$jsonDecoded['ref_latitude']."'"; }?>/>
                   </div>
                   <br/>

                   <div class="field">
                    <label for="emailAddr"  >Longitude:</label> This is the Gateway Key from the TTN Console
                    <input type="text" id="longitude" name="longitude" class="form-control"  minlength=3 <?php if($jsonDecoded['ref_longitude']!=null) { echo "value='".$jsonDecoded['ref_longitude']."'"; }?>/>
                    </div>
                    <br/>
                    <div class="field">
                     <label for="emailAddr"  >Altitude:</label> This is the Gateway Key from the TTN Console
                     <input type="text" id="altitude" name="altitude" class="form-control"   <?php if($jsonDecoded['ref_altitude']!=null) { echo "value='".$jsonDecoded['ref_altitude']."'"; }?>/>
                     </div>
                     <br/>




        <br/>
        <input type="submit" class="ui primary button" value="Update Configuration">
        </div>
   <input type="hidden" name="semtech"   class="form-control" <?php if($jsonServers['serv_type'] == "semtech") { echo "value='1'";}?> >

       </form>
     </div>
    </div>

  



</div>


<?php
include('inc/footer.php');
?>
