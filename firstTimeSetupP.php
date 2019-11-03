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


//Check email address
$emailAddress = $_POST['emailAddr'];
$emailAddress_c = $_POST['emailConfirm'];

if($emailAddress != $emailAddress_c || $emailAddress == null)
{
  echo("<h1>Email Addresses Do Not Match");
  include('inc/footer.php');
  exit();
}

//Check password
$password = $_POST['password'];
$password_c = $_POST['confirmPassword'];

if($password != $password_c || $password == null)
{
  echo("<h1>Passwords Do Not Match");
  include('inc/footer.php');
  exit();
}

$model = $_POST['model'];
$gps = $_POST['gps'];
$gatewayID = $_POST['gatewayId'];
$description = $_POST['description'];


var_dump(yaml_emit($configurationFile));

$arr = get_defined_vars();
print_r($arr);

include('inc/footer.php');
 ?>
