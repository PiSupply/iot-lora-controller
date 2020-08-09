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

$totalRam = shell_exec("free -m  | awk '/Mem/{print $3}'");
$freeRam = shell_exec("free -m  | awk '/Mem/{print $2}'");

//var_dump($totalRam);
//var_dump($freeRam);

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

<?php
if($nebra) {echo('<h1>IoT Smart LoRa Gateway</h1>');}
else {echo('<h1>IoT LoRa Gateway Status Page</h1>');}
?>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">

<h4>Gateway Name: <?php echo($configurationFile['gateway-info']['gatway-friendly-name']);?></h4>
<h4>Description: <?php echo($configurationFile['gateway-info']['gatway-description']);?></h4>
</div>

<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3">

      <?php
      //Change the alert box's colour based on the status.
      if($internetStatus == 0) {
        echo("<div class=\"alert alert-success flex-fill\">");
      }
      else{
        echo("<div class=\"alert alert-warning flex-fill\">");
      }
      ?>
          <h3>Internet Connectivity <span data-feather="globe"></span></i></h3>
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

      <?php
      //Change the alert box's colour based on the status.
      if($configurationFile['packet-forwarder-1']['enabled'] == true) {
        echo("<div class=\"alert alert-success flex-fill\">");
      }
      else {
        echo("<div class=\"alert alert-info flex-fill\">");
      }
       ?>
          <h3>Packet Forwarder 1 <span data-feather="radio"></span></h3>
          The packet forwarder container is <?php if($packetForwarder==0){echo("not ");}?>running.
      </div>
      <?php
      //Change the alert box's colour based on the status.
      if($configurationFile['packet-forwarder-2']['enabled'] == true) {
        echo("<div class=\"alert alert-success flex-fill\">");
      }
      else {
        echo("<div class=\"alert alert-info flex-fill\">");
      }
       ?>
          <h3>Packet Forwarder 2 <span data-feather="radio"></span></h3>
          The packet forwarder container is <?php if($packetForwarder==0){echo("not ");}?>running.
      </div>


      </div>
  </div>


  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">



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
  if($configurationFile['packet-forwarder-1']['enabled'] == true) {
    echo ('
    <div class="row">
    <div class="column">
    <div class="ui positive message">
        <strong>Packet Forwarder 1 Server:</strong> '.$configurationFile['packet-forwarder-1']['router'].'
    </div>
  </div>
  </div>
  ');
}
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
      <div class="progress-bar" id="progressBar" data-percent="<?php echo($cpuTemp); ?>">
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
