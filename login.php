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
if($loggedIn == 1) {
echo('
<div class="row align-items-center">
   <div class="text-center">
     <h1>Login</h1>
     <h4>You are already logged in</h4>
   </div>
</div>
');
die();
}


?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap flex-column pt-3 pb-2 mb-3 border-bottom">

     <h1>Login</h1>
     <h4>Before continuing you must login to access this LoRa gateway</h4>
   </div>
   <div class="d-flex justify-content-between flex-wrap flex-column flex-md-nowrap align-items-center pt-3 pb-2 mb-3">

     <form action="loginS.php" method="post" class="ui form">



         <div class="form-group row">
          <label for="username">Username:</label> This is your email address.
          <input type="text" id="username" name="username" class="form-control" required/>
         </div>
         <br/>

         <div class="form-group row">
          <label for="password">Password:</label> This is the password you setup when creating the account.
          <input type="password" id="password" name="password" class="form-control" required/>
         </div>
         <br/>


          <div class="form-group row">
            <input type="submit" class="btn btn-primary" value="Login" >
          </div>

         </form>

     </div>




<?php
include('inc/footer.php');
?>
