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

     <h4>This page allows you to configure the settings for GPS.</h4>
      <h5>You can enable the GPS module on your gateway from this page, the Nebra Smart Gateway has a module soldered on but must have an antenna to work properly so you might wish to disable it if no antenna is connected. On the HAT version you must plug in a GPS Module to enable the feature.</h5>
     </div>

</div>
<br>


<br/><br/>

<div class="row">
  <div class="coulumn">
     <h1 class="ui top attached block header">Edit config file - GPS</h1>
     <form action="updateGPS.php" method="post" class="ui form">
         <div class="ui bottom attached segment">
           <div class="field">
             <label for="enable"  >Enable GPS Module :</label> Enables GPS LoRa Module.
             <br/><br/>
             <div class="ui slider checkbox">
              <input type="checkbox" name="enabled" id="enabled" class="form-control" <?php if($configurationFile['gps']['enabled'] == "true") { echo "checked";}?> >
              <label>Enable GPS</label>
             </div>
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
