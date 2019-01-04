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
<h1>IoT LoRa Gateway Log</h1>
<h2>Viewing last 3000 lines of log file</h2>

<iframe src="viewLogData.php" style="width:100%; min-height:500px"></iframe>



<?php
include('inc/footer.php');
?>
