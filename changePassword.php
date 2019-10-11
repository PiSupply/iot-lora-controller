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




?>


<div class="row">
  <div class="coulumn">
     <h1 class="ui top attached block header">Change Password</h1>

     <form action="updatePassword.php" method="post" class="ui form">

         <div class="ui bottom attached segment">
           <p><strong>This will change the password used to login to this and via SSH (if enabled).</strong></p>
      <div class="field">
       <label for="emailAddr">New Password:</label>
       <input type="password" id="password" name="password" class="form-control" required/>
       </div>
       <div class="field">
        <label for="emailAddr">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required/>
        </div>
       <br/>

         <input type="submit" class="ui primary button" value="Update Password">
  </div>

</form>
</div>
</div>





<?php
include('inc/footer.php');
?>
