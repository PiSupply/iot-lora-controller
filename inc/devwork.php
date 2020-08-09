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
