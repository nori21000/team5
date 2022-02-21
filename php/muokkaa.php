<?php 
$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : 0;

if (empty($muokattava)){
    header("Location:./lue.php");
    exit;
}
include '../html/header.html';
try{
    $yhteys=mysqli_connect("localhost", "TRTKP21A3_5", "DOH0GX1X", "wp_TRTKP21A3_5");
}

catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

$sql="select * from badmin where tunnus=?";
//valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
//suoritetaan sql-lause
mysqli_stmt_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);

if(!$rivi=mysqli_fetch_object($tulos)){
    header("Location:./lue.php");
    exit;
}

?>
<form action='./paivita.php' method='post'>
Tunnus:<input type='text' name='tunnus' value='<?php print $rivi->tunnus;?>' readonly><br>
Salasana:<input type='text' name='salasana' value='<?php print $rivi->salasana;?>'><br>


<input type="submit" name ='ok' value='OK'>
</form>
<?php 
mysqli_close($yhteys);
?>
<?php 
include '../html/footer.html';
?>