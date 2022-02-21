<?php
session_start();
if (!(isset($_SESSION["admin"]) && $_SESSION["admin"] == "admin")){
    header("Location:../html/kirjauduadmin.html");
    exit;
}
include '../html/header.html';
print "<h2>Tervetuloa ".$_SESSION["admin"]."!</h2>";
?>
<?php 
//mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
$yhteys=mysqli_connect("db", "root", "password", "registration");
}

catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

$tulos=mysqli_query($yhteys, "select * from admin");
while($rivi=mysqli_fetch_object($tulos)){
    print "<li> $rivi->tunnus $rivi->salasana"."<a href='./poista.php?poistettava=$rivi->tunnus'>POISTA</a><a href='./muokkaa.php?muokattava=$rivi->tunnus'>MUOKKAA</a>";
}
print "<ol>";
mysqli_close($yhteys);
?>
<a href='kirjauduulos.php'>Kirjaudu ulos</a>
<?php 
include '../html/footer.html';
?>
