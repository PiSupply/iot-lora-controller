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

<div class="row align-items-center">
   <div class="text-center">
     <h1>Login</h1>
   </div>
</div>
<div class="row align-items-center">
   <div class="text-center">
     <h4>Before continuing you must login to access this LoRa gateway</h4>

</div>
<br>


<br/><br/>

<div class="row">
  <div class="coulumn">
     <h1 class="ui top attached block header">Login</h1>
     <form action="update4G.php" method="post" class="ui form">
         <div class="ui bottom attached segment">


         <div class="field">
          <label for="username">Username:</label> This is your email address.
          <input type="text" id="username" name="username" class="form-control" required/>
         </div>
         <br/>

         <div class="field">
          <label for="password">Password:</label> This is the password you setup when creating the account.
          <input type="text" id="password" name="password" class="form-control" required/>
         </div>
         <br/>


          <br/>
          <input type="submit" class="ui primary button" value="Login" >
          </div>
         </form>
       </div>
     </div>
    </div>
    </div>



<?php
include('inc/footer.php');
?>
