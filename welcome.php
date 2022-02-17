<?php
session_start();
if (!isset($_SESSION["kayttaja"])){
    header("Location:..login.html");
    exit;
}

print "<h2>Welcome, ".$_SESSION["users"]."!</h2>";
?>
<a href='logout.php'>Log out</a>
