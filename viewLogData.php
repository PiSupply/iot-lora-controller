<?php
$logData = shell_exec('journalctl -u iot-lora-gateway.service --no-pager -n 3000');
//$logData = shell_exec('systemctl -l status iot-lora-gateway.service --no-pager');
echo "<pre>";
echo $logData;
echo "</pre>";
 ?>
