<?php
session_start();
if (!(isset($_SESSION["badmin"]) && $_SESSION["badmin"] == "admin1")){
    header("Location:../html/kirjauduadmin.html");
    exit;
}
include '../html/header.html';
print "<h2>Tervetuloa ".$_SESSION["badmin"]."!</h2>";
?>
<?php 
//mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
$yhteys=mysqli_connect("localhost", "TRTKP21A3_5", "DOH0GX1X", "wp_TRTKP21A3_5");
}

catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

$tulos=mysqli_query($yhteys, "select * from badmin");
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
