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
      if($nebra) { echo ('<img id="logo" src="img/nebra.png"/>');}
      else { echo ('<img id="logo" src="img/pisupply.png"/>'); }
       echo ('
       </a>
       <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <a class="col-md-3 col-lg-2 mr-0 px-3" href="#"><img id="logo" src="img/logo.png"/></a>
       </nav>


 <div class="container-fluid">
   <div class="row">
     <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
       <div class="sidebar-sticky pt-3">
         <ul class="nav flex-column">
           <li class="nav-item">

             <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
               <span>Home</span>
               <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">

               </a>
             </h6>
             <a class="nav-link active" href=index.php">
               <span data-feather="home"></span>
               Dashboard <span class="sr-only">(current)</span>
             </a>
           </li>
           ');

           if($loggedIn) {
             echo('

           <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
             <span>LoRa Configuration</span>
             <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">

             </a>
           </h6>

           <li class="nav-item">
             <a class="nav-link" href="configurePacketForwarder.php?loraModule=1">
               <span data-feather="radio"></span>
               Packet Forwarder 1
             </a>
           </li>');
         }

           if($nebra && $loggedIn) {
             echo ('

           <li class="nav-item">
             <a class="nav-link" href="configurePacketForwarder.php?loraModule=2">
               <span data-feather="radio"></span>
               Packet Forwarder 2
             </a>
           </li>
           ');
         }

         if($loggedIn) {
           echo('

           <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
             <span>WAN Configuration</span>
             <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">

             </a>
           </h6>

           <li class="nav-item">
             <a class="nav-link" href="configure4G.php">
               <span data-feather="bar-chart"></span>
               4G Module
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="configureWiFi.php">
               <span data-feather="wifi"></span>
               Wireless Networks
             </a>
           </li>

           <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
             <span>System Configuration</span>
             <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
             </a>
           </h6>
           <li class="nav-item">
             <a class="nav-link" href="systemControls.php">
               <span data-feather="sliders"></span>
               System Controls
             </a>
           </li>
         </ul>

         <ul class="nav flex-column mb-2">
           <li class="nav-item">
             <a class="nav-link" href="changePassword.php">
               <span data-feather="lock"></span>
               Change Password
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="configureGPS.php">
               <span data-feather="compass"></span>
               Enable / Disable GPS
             </a>
           </li>
           ');
         }
         echo ('
           <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
             <span>Misc</span>
             <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">

             </a>
           </h6>

           <li class="nav-item">
             <a class="nav-link" href="about.php">
               <span data-feather="help-circle"></span>
               About
             </a>
           </li>
           ');
           if($loggedIn) {
             echo ('
           <li class="nav-item">
             <a class="nav-link" href="logout.php">
               <span data-feather="log-out"></span>
               Logout
             </a>
           </li>
           ');
         }
         echo ('
         </ul>
       </div>
     </nav>





<!-- Begin page content -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

');

}

?>
