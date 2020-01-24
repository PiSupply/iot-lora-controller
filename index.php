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

if($configurationFile['gateway-info']['initial-setup'] == 0) {
  //Send to first time setup
  header("Location: firstTimeSetup.php");
}

if($loggedIn == 0) {
  //Send to login page
  header("Location: login.php");
}



//Lets check for external internet connectivity by doing a http request to three servers
$internetCheck1 = file_get_contents('https://1.1.1.1');
$internetStatus = 0;
if($internetCheck1 == FALSE) {
  $internetStatus++;
}

$cpuTemp = shell_exec("cat /sys/class/thermal/thermal_zone0/temp");
$cpuTemp = $cpuTemp/1000;
?>
<?php
if($nebra) {echo('<h1>IoT Smart LoRa Gateway</h1>');}
else {echo('<h1>IoT LoRa Gateway Status Page</h1>');}
?>
<h2>Gateway Name: <?php echo($configurationFile['gateway-info']['gatway-friendly-name']);?></h2>
<h3><?php echo($configurationFile['gateway-info']['gatway-description']);?></h3>

<div class="ui divided grid stackable">

    <div class="<?php if($configurationFile['gateway-info']['gateway-type'] == 1) { echo('three');} else {echo('two');} ?> column row">
    <div class="column wide">
      <?php
      //Change the alert box's colour based on the status.
      if($internetStatus == 0) {
        echo("<div class=\"ui positive message segment\">");
      }
      else{
        echo("<div class=\"ui error message segment\">");
      }
      ?>
          <h3>Internet Connectivity <i class="globe icon"></i></h3>
            <?php
            //Change the text based on the status.
            if($internetStatus == 0) {
              echo("All good!");
            }
            elseif($internetStatus == 1) {
              echo("There might be an issue of this gateway connecting to the internet, please check and reload.");
            }
            ?>
      </div>
    </div>

    <div class="column wide">
      <?php
      //Change the alert box's colour based on the status.
      if($configurationFile['packet-forwarder-1']['enabled'] == true) {
        echo("<div class=\"ui positive message segment\">");
      }
      else {
        echo("<div class=\"ui teal message segment\">");
      }
       ?>
          <h3>Packet Forwarder 1<i class="microchip icon"></i></h3>
          The packet forwarder container is <?php if($packetForwarder==0){echo("not ");}?>running.
      </div>
    </div>

    <div class="column wide">
      <?php
      //Change the alert box's colour based on the status.
      if($configurationFile['packet-forwarder-2']['enabled'] == true) {
        echo("<div class=\"ui positive message segment\">");
      }
      else {
        echo("<div class=\"ui teal message segment\">");
      }
       ?>
          <h3>Packet Forwarder 2 <i class="microchip icon"></i></h3>
          The packet forwarder container is <?php if($packetForwarder==0){echo("not ");}?>running.
      </div>
    </div>


      </div>
  </div>
<div class="ui divided grid stackable">


  <?php
  if($configurationFile['gateway-info']['gateway-type'] == 0) {

  echo ('


  <div class="row">
    <div class="column">
    <div class="ui positive message">
        <strong>Configured Server:</strong> '.$configurationFile['packet-forwarder-1']['router'].'
    </div>
  </div>
</div>
');
}

else {
    echo ('
    <div class="row">
    <div class="column">
    <div class="ui positive message">
        <strong>Packet Forwarder 1 Server:</strong> '.$configurationFile['packet-forwarder-1']['router'].'
    </div>
  </div>
  </div>
  ');
  if($configurationFile['packet-forwarder-2']['enabled'] == true) {
      echo ('

    <div class="row">
    <div class="column">
    <div class="ui positive message">
        <strong>Packet Forwarder 2 Server:</strong> '.$configurationFile['packet-forwarder-2']['router'].'
    </div>
    </div>
    </div>
    ');
    }
}
?>

<div class="row">
  <div class="column">
  <div class="ui info message">
      <strong>CPU Temperature:</strong>
      <div class="ui teal progress" id="progressBar" data-percent="<?php echo($cpuTemp); ?>">
        <div class="bar"></div>

        <div class="label"><?php echo($cpuTemp); ?> Degrees C</div>
      </div>
  </div>
</div>
</div>
</div>




<script>
$('#progressBar').progress();
</script>
<?php
include('inc/footer.php');
?>
