<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$poistettava=isset($_GET["poistettava"]) ? $_GET["poistettava"] : 0;
if (empty($poistettava)){
    header("Location:./lue.php");
    exit;
}

try{
    $yhteys=mysqli_connect("localhost", "TRTKP21A3_5", "DOH0GX1X", "wp_TRTKP21A3_5");
}

catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}
$sql="delete from badmin where tunnus=?";

//valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'i', $poistettava);
//suoritetaan sql-lause
mysqli_stmt_execute($stmt);

// mysqli_query($yhteys, );

mysqli_close($yhteys);

header("Location:./lue.php");
?>