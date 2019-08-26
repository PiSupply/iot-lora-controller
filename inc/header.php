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


//Global variables

$configLocation = "/opt/iotloragateway/local_conf.json";
$globalConfigLocation = "/opt/iotloragateway/global_conf.json";

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
    <link href="css/custom.css" rel="stylesheet">

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
      <div class="ui stackable menu">
        <div class="header item"><img id="logo" src="img/logo.png"/></div>
        <a class="item menuButt" href="index.php"><strong>Gateway Status</strong></a>
        <a class="item menuButt" href="configurePacketForwarder.php"><strong>Packet Forwarder Config</strong></a>
        <!---<a class="item menuButt" href="configureHost.php"><strong>Host Config</strong></a>--->
        <a class="item menuButt" href="systemControls.php"><strong>System Controls</strong></a>
        <a class="item menuButt" href="viewLog.php"><strong>Packet Forwarder Logfile</strong></a>
        <a class="item menuButt" href="about.php"><strong>About</strong></a>
</div>

    </header>


<!-- Begin page content -->
<div class="ui container">

');
}

?>
