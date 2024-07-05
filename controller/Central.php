<?php
session_start();

include  ($dataLink == "single") ? "./model/DatabaseConnection.php" : "../model/DatabaseConnection.php";

include ($dataLink == "single") ? "./controller/Activity.php" :"../controller/Activity.php";
include ($dataLink == "single") ? "./controller/TrasactionHistory.php":"../controller/TrasactionHistory.php";