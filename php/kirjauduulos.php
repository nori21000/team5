<?php
session_start();
unset($_SESSION["badmin"]);
header("Location:../html/kirjauduadmin.html");
?>