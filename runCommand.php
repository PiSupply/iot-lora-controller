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
//Run command and then add a 60 Second timer for the user to wait.

//Get the command ran

$buttonPressed = $_GET['butt'];

if($loggedIn == 0) {
  //Send to login page
  header("Location: login.php");
}


?>

<script>
<?php
if($buttonPressed == "rstPkt") {
  //Restart the packet forwarder
  echo("var timePerTick = 300;");
}
else if($buttonPressed == "stpPkt") {
  //Restart the packet forwarder
  echo("var timePerTick = 300;");
}
else if($buttonPressed == "strPkt") {
  //Restart the packet forwarder
  echo("var timePerTick = 300;");
}
else if($buttonPressed == "diag") {
  //Restart the packet forwarder
  //shell_exec("sudo systemctl start iot-lora-gateway.service");
}
else if($buttonPressed == "rbtSys") {
  //Restart the packet forwarder
  echo("var timePerTick = 1200;");
}
else if($buttonPressed == "sdSys") {
  //Restart the packet forwarder
    echo("var timePerTick = 300;");
}
?>

var restartCounter = 0;
var countdownTimer = window.setInterval(function () {
  restartCounter = restartCounter + 1;
  $('#progressBar').progress({percent: restartCounter,text: {
      active  : '{percent}%'
    }});
  if(restartCounter == 99) {
     clearInterval(countdownTimer);
     window.location.replace("index.php");
  }
  $('#progressBar').progress({percent: restartCounter,text: {
      active  : '{percent}%'
    }});
}, timePerTick);
</script>

<h1>IoT LoRa Gateway Command</h1>

<?php

if($buttonPressed == "rstPkt") {
  //Restart the packet forwarder
  echo("<h2>The Packet Forwarder Is Restarting</h2>  <p>This may take around 30 Seconds</p>");
}
else if($buttonPressed == "stpPkt") {
  //Restart the packet forwarder
  echo("<h2>The Packet Forwarder Is Starting</h2>  <p>This may take around 30 Seconds</p>");
}
else if($buttonPressed == "strPkt") {
  //Restart the packet forwarder
  echo("<h2>The Packet Forwarder Is Stopping</h2> <p>This may take around 30 Seconds</p>");
}
else if($buttonPressed == "diag") {
  //Restart the packet forwarder
  //shell_exec("sudo systemctl start iot-lora-gateway.service");
}
else if($buttonPressed == "rbtSys") {
  //Restart the packet forwarder
  echo("<h2>The gateway is restarting</h2> <p>This may take around 2 Minutes</p>");
}
else if($buttonPressed == "sdSys") {
  //Restart the packet forwarder
  echo("<h2>The gateway is shutting down.</h2>");
}

 ?>

<div class="ui indicating progress" id="progressBar">
  <div class="bar"></div>

  <div class="label">0%</div>
</div>

<?php
include("inc/footer.php");

if($buttonPressed == "rstPkt") {
  //Restart the packet forwarder
  shell_exec("sudo systemctl restart iot-lora-gateway.service");
}
else if($buttonPressed == "rbtSys") {
  //Restart the packet forwarder
  shell_exec("sudo /opt/iotloragateway/controller/iot-lora-controller/reboot.sh");
}
else if($buttonPressed == "sdSys") {
  //Restart the packet forwarder
  shell_exec("echo 1 > /proc/sys/kernel/sysrq");
  shell_exec("echo s > /proc/sysrq-trigger");
  shell_exec("echo o > /proc/sysrq-trigger");
}




 ?>
