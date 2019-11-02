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

var_dump($configurationFile)



?>


<div class="row align-items-center">
   <div class="text-center">
     <h1>First Time Setup Wizard</h1>
   </div>
</div>
<div class="row align-items-center">
   <div class="text-center">
     <h4>Welcome to the First Time Setup Wizard.</h4>
     <p>This wizard will guide you through the first time setup for the gateway to configure the hardware and user details</p>
     <h5>Once completed you can then configure the LoRa Modules.</h5>
   </div>
</div>
<br>

<div class="row">
  <div class="coullumn">


     <form action="firstTimeSetupP.php" method="post" class="ui form">
         <div class="ui bottom attached segment">

           <!--Email Address-->
           <div class="field">
            <label for="emailAddr">Email Address:</label> You will need this to login to the gateway and can be used for contacting
            <input type="email" id="emailAddr" name="emailAddr" class="form-control" required/>
          </div>
          <br/>
          <div class="field">
            <label for="emailConfirm">Confirm Email Address:</label>
            <input type="email" id="emailConfirm" name="emailConfirm" class="form-control" required />
          </div>
          <br/>
          <!--Password-->
          <div class="field">
            <label for="emailConfirm">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required />
          </div>
          <br/>
          <div class="field">
            <label for="emailConfirm">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required />
          </div>
          <br/>

          <!--Hardware Config-->
          <div class="field">
           <label for="emailAddr"  >Hardware Model:</label>
           <select class="ui fluid search dropdown" name="model">
            <option value="nebraSmart">Nebra Smart LoRa Gateway</option>
            <option value="loraHat">Pi Supply IoT LoRa Gateway HAT</option>
          </select>

          <div class="field">
            <label for="emailAddr"  >Enable GPS Module:</label> Enables the GPS Module, (if plugged in on Gateway HAT).
            <br/><br/>
            <div class="ui slider checkbox">
             <input type="checkbox" name="gps"  class="form-control" <?php if($jsonDecoded['gps'] == "true") { echo "checked";}?> >
             <label>Enable GPS Module</label>
            </div>
           </div>
           <br/>

          <!--Final bit of information-->
          <div class="field">
           <label for="emailAddr">Gateway ID:</label> An ID for your gateway to be known by.
           <input type="text" id="description" name="description" class="form-control" required/>
          </div>
          <br/>
          <div class="field">
           <label for="emailAddr">Gateway Description:</label> A human readable description of your gateway.
           <input type="text" id="description" name="description" class="form-control" required/>
          </div>
          <br/>



      <input type="submit" class="ui primary button" value="Complete First Time Setup">
      </div>
 <input type="hidden" name="semtech"   class="form-control" <?php if($jsonServers['serv_type'] == "semtech") { echo "value='1'";}?> >

     </form>

   </div>
  </div>
<br/><br/>
