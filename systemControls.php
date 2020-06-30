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
  die();
}



?>
<h1>IoT LoRa Gateway Commands</h1>

<div class="ui column segment error message ">
    <a href="runCommand.php?butt=rbtSys"  class="ui yellow button big fluid ">Soft Restart system</a>
  <strong>Soft Restart Gateway:</strong> Restarts the controller software, packet forwarders & updates the system.

</div>

<div class="ui column segment error message ">
    <a href="runCommand.php?butt=rbtSys"  class="ui orange button big fluid ">Hard Restart system</a>
  <strong>Hard Restart Gateway:</strong> Restarts the entire gateway including networking & linux.

</div>

<div class="ui error message">
    <a href="runCommand.php?butt=sdSys"  class="ui negative button big fluid">Shutdown system</a>
    <strong>Shutdown Gateway:</strong> Shuts down the entire system, requires a power cycle to re-turn on.
</div>






<?php
include('inc/footer.php');
?>
