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

//use Symfony\Component\Yaml\Yaml;

//Global variables

 session_start();


$configurationFile = yaml_parse_file('/opt/iotloragateway/config/gateway_configuration.yml');

$nebra = $configurationFile['gateway-info']['gateway-type'];

$loggedIn = 0;


if($_SESSION['iotLoRaGatewayLogin']) {
  $loginHash = hash("sha512", $configurationFile['user']['email-address'].$configurationFile['user']['salt'].$configurationFile['user']['password'].$configurationFile['user']['salt']);
  if($_SESSION['iotLoRaGatewayLogin'] == $loginHash) {
    $loggedIn = 1;
  }
}

if (php_sapi_name() != "cli") {
  echo ('
  <!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="IoTLoRaGateway Management">
      <meta name="author" content="Ryan Walmsley">
      <title>IoTLoRaGateway Management</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/custom.css" rel="stylesheet">
    ');
    if($nebra) { echo ('   <link href="css/custom-nebra.css" rel="stylesheet">  ');}
    else { echo ('   <link href="css/custom-hat.css" rel="stylesheet">  '); }

    echo ('
  </head>

  <body>

  <div class = "pusher">
    <header>

    <nav class="navbar sticky-top flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">


      ');
      if($nebra) { echo ('<img id="logo" src="img/nebra-white.png"/>');}
      else { echo ('<img id="logo" src="img/nebra-white.png"/>'); }
       echo ('
       </a>
       <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <a class="col-md-3 col-lg-2 mr-0 px-3" href="#"><img id="logo" src="img/logo.png"/></a>
       </nav>







        <div class="header item"><img id="logo" src="img/logo.png"/></div>
        <a class="item menuButt" href="index.php"><strong>Gateway Status</strong></a>');
        if($loggedIn) {
          echo('
        <div class="ui dropdown item menuButt">
          <strong>LoRa Configuration</strong>
          <i class="dropdown icon menuButt"></i>
          <div class="menu">
            <a class="item menuButt" href="configurePacketForwarder.php?loraModule=1"><strong>Configure Packet Forwarder 1</strong></a>
            ');
          }

            if($nebra && $loggedIn) {
              echo('<a class="item menuButt" href="configurePacketForwarder.php?loraModule=2"><strong>Configure Packet Forwarder 2</strong></a>');
            }

            if($loggedIn) {
            echo('
            <!--<a class="item menuButt" href=".php"><strong>Gateway Bridge</strong></a>-->
          </div>
        </div>
        <div class="ui dropdown item menuButt">
          <strong>WAN Configuration</strong>
          <i class="dropdown icon menuButt"></i>
          <div class="menu">
            <a class="item menuButt" href="configure4G.php"><strong>4G Module Configuration</strong></a>
            <a class="item menuButt" href="configureWiFi.php"><strong>WiFi Configuration</strong></a>
          </div>
        </div>
        <div class="ui dropdown item menuButt">
          <strong>System Configuration</strong>
          <i class="dropdown icon menuButt"></i>
          <div class="menu">
            <a class="item menuButt" href="systemControls.php"><strong>System Controls</strong></a>
            <a class="item menuButt" href="changePassword.php"><strong>Change Password</strong></a>
            <a class="item menuButt" href="configureGPS.php"><strong>Configure GPS</strong></a>
          </div>
        </div>');
      }

        echo('<a class="item menuButt" href="about.php"><strong>About</strong></a>');
        if($loggedIn) {
          echo ('<a class="item menuButt" href="logout.php"><strong>Logout</strong></a>');
        }
        echo ('



</div>
<script>
$(".ui.dropdown")
  .dropdown()
;
</script>
    </header>


<!-- Begin page content -->
<div class="ui container">

');
}

?>
