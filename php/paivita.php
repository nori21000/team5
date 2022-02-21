<?php
//Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
//jos syötteet ovat olemassa
$tunnus=isset($_POST["tunnus"]) ? $_POST["tunnus"] : "";
$salasana=isset($_POST["salasana"]) ? $_POST["salasana"] : "";

//Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
//ohjataan pyyntö takaisin lomakkeelle
if (empty($tunnus) || empty($salasana)){
    header("Location:../php/muokkaa.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    $yhteys=mysqli_connect("db", "root", "password", "registration");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="update admin set salasana=sha2(?,256) where tunnus=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'ss', $salasana, $tunnus);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:./lue.php");
?>