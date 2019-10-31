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

use Symfony\Component\Yaml\Yaml;

//Global variables

$configurationLocation = Yaml::parseFile('/opt/iotloragateway/config/gateway_configuration.yml');

$nebra = true;

if (php_sapi_name() != "cli") {
  echo ('
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>IoTLoRaGateway Management</title>

    <!-- Bootstrap core CSS -->

    <link href="css/semantic.min.css" rel="stylesheet">

    ');

    if($nebra) { echo ('   <link href="css/custom-nebra.css" rel="stylesheet">  ');}
    else { echo ('   <link href="css/custom.css" rel="stylesheet">  '); }



    echo ('

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/semantic.min.js"></script>
    <script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>

  </head>


  <body>

    <header>
      <!-- Fixed navbar -->
      <div class="ui left fixed vertical menu">
      ');
      if($nebra) { echo ('<div class="header item right"><img id="logo" src="img/nebra-white.png"/></div>');}

       echo ('
        <div class="header item"><img id="logo" src="img/logo.png"/></div>
        <a class="item menuButt" href="index.php"><strong>Gateway Status</strong></a>
        <div class="ui dropdown item menuButt">
          <strong>LoRa Configuration</strong>
          <i class="dropdown icon menuButt"></i>
          <div class="menu">
            <a class="item menuButt" href="configurePacketForwarder.php"><strong>Packet Forwarder Config</strong></a>
            <a class="item menuButt" href="viewLog.php"><strong>Packet Forwarder Logfile</strong></a>
          </div>
        </div>
        <div class="ui dropdown item menuButt">
          <strong>WAN Configuration</strong>
          <i class="dropdown icon menuButt"></i>
          <div class="menu">
            <a class="item menuButt" href="4gconfiguration.php"><strong>4G Module Configuration</strong></a>
          </div>
        </div>
        <div class="ui dropdown item menuButt">
          <strong>System Configuration</strong>
          <i class="dropdown icon menuButt"></i>
          <div class="menu">
            <a class="item menuButt" href="systemControls.php"><strong>System Controls</strong></a>
            <a class="item menuButt" href="changePassword.php"><strong>Change Password</strong></a>
          </div>
        </div>



        <a class="item menuButt" href="about.php"><strong>About</strong></a>


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
