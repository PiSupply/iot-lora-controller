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

/*
* Lets load most of the information required to fill this page's details out
*
*/

?>
<h1>About IoT LoRa Controller Software</h1>


  <div class="ui divided grid stackable">
    <div class="row">
        <div class="column wide">
          <h3>About this software:</h3>
          <p>This software is designed to make managing your Nebra Smart Gateway & Pi Supply IoT LoRa Gateway Hat as easy & quick as possible. It is primarily designed for use with The Things Network but also supports other networks in legacy semtech mode.</p>
          <p>Limited support is provided for the software via our social media channels and Github at https://github.com/PiSupply/iot-lora-image/</p>
          <p>Please report any bugs, issues & feature requests in this software to the github repository linked above</p>
    </div>
  </div>

  <div class="row">
      <div class="column wide">
        <h3>Software Used:</h3>
        <p>This software and all software used is open source on Github.</p>
        <p>The following is the Pi Supply Repositories for our software, scripts and packaging tools:</p>
        <ul>
          <li><a href="https://github.com/PiSupply/iot-lora-image">https://github.com/PiSupply/iot-lora-image</a></li>
          <li><a href="https://github.com/PiSupply/iot-lora-controller">https://github.com/PiSupply/iot-lora-controller</a></li>
          <li><a href="https://github.com/PiSupply/iot-pi-gen">https://github.com/PiSupply/iot-pi-gen</a></li>
          <li><a href="https://github.com/PiSupply/IoTLoRaRange">https://github.com/PiSupply/IoTLoRaRange</a></li>
        </ul>

        <p>The following are the repositories of other contained software, these are all forks for security reasons and the original contributors can be found from these github pages:</p>
        <ul>
          <li><a href="https://github.com/PiSupply/lora_gateway">https://github.com/PiSupply/lora_gateway</a></li>
          <li><a href="https://github.com/PiSupply/packet_forwarder">https://github.com/PiSupply/packet_forwarder</a></li>
          <li><a href="https://github.com/PiSupply/paho.mqtt.embedded-c">https://github.com/PiSupply/paho.mqtt.embedded-c</a></li>
          <li><a href="https://github.com/PiSupply/ttn-gateway-connector">https://github.com/PiSupply/ttn-gateway-connector</a></li>
        </ul>


  </div>
</div>

<div class="row">
    <div class="column wide">
      <h3>Thanks:</h3>
      <p>A special thanks to all of our LoRa Beta Testers for providing feedback. And Jac Kersing (@Kersing) for the packet forwarding software.</p>

</div>
</div>



  </div>

<?php
include('inc/footer.php');
 ?>
