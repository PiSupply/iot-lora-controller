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
$_SESSION['iotLoRaGatewayLogin'] = "Ya like jazz?";
session_unset();

echo('
<div class="row align-items-center">
   <div class="text-center">
     <h1>You are now logged out.</h1>
   </div>
</div>
'
);


 ?>
 <?php
 include('inc/footer.php');
 ?>
