<?php 
$tunnukset = "../../../tunnukset.php";
if (file_exists($tunnukset)) include($tunnukset);
else {
  die ("Tietokantayhteys ei toimi.<br>"); 
  }
$palvelin = "localhost";
$tietokanta = "neilikka";
$kayttaja = $db_username_local;
$salasana = $db_password_local;

function db_connect(){
static $yhteys;
if (!$yhteys) {
    $yhteys = new mysqli(
        $GLOBALS['palvelin'], $GLOBALS['kayttaja'], 
        $GLOBALS['salasana'], $GLOBALS['tietokanta']);
}
if ($yhteys->connect_error) {
   die("<br>Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
}
return $yhteys;
}

function mysql_kysely($query){    
$yhteys = db_connect();
//$yhteys = $GLOBALS['yhteys'];
try {
    $result = $yhteys->query($query);
    if (!$result) throw new Exception("Queryn result on false: ".$yhteys->error);
    else {
        //$vaikutti = $yhteys->affected_rows;
        //echo "Vaikutti $vaikutti riviin.<br>";    
        return $result;
        }
    } 
catch (Exception $e) {
    //debuggeri('<br>Virhe: ' .  $e->getMessage());
    echo 'Virhe: '. $e->getMessage() . '<br>';
    return false;
    }
}

// $yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);
// if ($yhteys->connect_error) {
//   die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
// }
// $yhteys->set_charset("utf8");
$yhteys = db_connect();
?>