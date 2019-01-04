<?php
$logData = shell_exec('journalctl -u iot-lora-gateway.service --no-pager -n 3000');
echo "<pre>$logData</pre>";
 ?>
