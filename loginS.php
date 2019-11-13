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

//var_dump($_POST); //For Dev Only

$username = $_POST['username'];
if($configurationFile['user']['email-address'] != $username) {
  echo("<h1>Username Or Password Incorrect</h1>");
  include('inc/footer.php');
  exit();

}

$password = hash("sha512", $configurationFile['user']['salt'] .$_POST['password'].$configurationFile['user']['salt'] );

if($configurationFile['user']['password'] != $password) {
  echo("<h1>Username Or Password Incorrect</h1>");
  include('inc/footer.php');
  exit();

}

//If we get to here both should be correct.

$loginHash = hash("sha512", $username.$configurationFile['user']['salt'].$password.$configurationFile['user']['salt']);
$_SESSION['iotLoRaGatewayLogin'] = $loginHash;



echo('
<div class="row align-items-center">
   <div class="text-center">
     <h1>You are now logged in.</h1>
   </div>
</div>
'
);

echo($loggedIn);

 ?>
