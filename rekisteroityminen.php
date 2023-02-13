<?php
$virhetekstit['nimi']['puuttuu'] = "Nimi puuttuu";
$virhetekstit['sposti']['puuttuu'] = "Sähköposti puuttuu";
$virhetekstit['aihe']['puuttuu'] = "Aihe puuttuu";
$virhetekstit['viesti']['puuttuu'] = "Viesti puuttuu";
$pakolliset = ['nimi','sposti','aihe','viesti'];

function virheteksti($kentta){
if (!isset($_POST['painike'])) return;   
$virhetekstit = $GLOBALS['virhetekstit'];
$pakolliset = $GLOBALS['pakolliset'];
$arvo = $GLOBALS[$kentta];
if (in_array($kentta,$pakolliset) and !$arvo) echo $virhetekstit[$kentta]['puuttuu'];
return;
}

function virheluokka($kentta){ 
  if (!isset($_POST['painike'])) return;   
  echo (!$GLOBALS[$kentta]) ? "is-invalid" : "is-valid";
  return;
  }
  

$nimi = $_POST['nimi'] ?? "";  
$sposti = $_POST['sposti'] ?? "";
$viesti = $_POST['viesti'] ?? "";
$aihe = $_POST['aihe'] ?? "";
$checked = isset($_POST['tilaus']) ? "checked" : "";

if (isset($_POST['painike'])){
  foreach($_POST as $key => $value){
    echo "$key:$value<br>";
    }
  //header('location: index.php');
  //exit;  
  
}
?>
<!DOCTYPE html>
<html lang="fi">
<?php
include('header.php');
?>
<div class="container">
<h1>Ota yhteyttä</h1> 

<p>Voit ottaa meihin yhteyttä</p>
<p class="nowrap">
- puhelimitse <a href="myymalat.php">yksittäisiin myymälöihin</a><br>
- sähköpostitse <a href="mailto:asiakasespalvelu@puutarhaliikeneilikka">asiakaspalvelu@puutarhaliikeneilikka.fi</a><br>
- alla olevalla lomakkeella<br>
</p>
<p id="tulos"></p>
<form id="yhteydenotto" method="POST">
<fieldset>
<legend>Yhteydenottopyyntö</legend>
<div>
<label class="label" for="nimi">Nimi</label>
<input id="nimi" name="nimi" type="text" placeholder="nimi" minlength="2" maxlength="40" pattern="[a-zA-ZåäöÅÄÖ- ]+" value="<?=$nimi;?>" 
class="<?php virheluokka('nimi');?>" autofocus required/><br>
<div class="invalid-feedback"><?php virheteksti('nimi');?></div>
</div>
<div>
<label class="label" for="sposti">Sähköpostiosoite</label>
<input id="sposti" name="sposti" type="email" placeholder="sähköposti" value="<?=$sposti;?>" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,4})+$"
class="<?php virheluokka('sposti');?>" required/><br>
<div class="invalid-feedback"><?php virheteksti('sposti');?></div>
</div>
<div>
<label class="label" for="aihe">Aihe</label>
<input id="aihe" name="aihe" type="text" placeholder="aihe" maxlength="40" value="<?=$aihe;?>" 
class="<?php virheluokka('aihe');?>" required/><br>
<div class="invalid-feedback"><?php virheteksti('aihe');?></div>
</div>
<div>
<label class="label label-textarea" for="viesti">Viesti</label>
<textarea id="viesti" name="viesti" rows="4" cols="40" maxlength="256" placeholder="Kirjoita viesti tähän." 
class="<?php virheluokka('viesti');?>" required><?=$viesti;?></textarea><br>
<div class="invalid-feedback"><?php virheteksti('viesti');?></div>
</div>
<label class="label" for="tilaus">Haluan tilata Puutarhaliike Neilikan uutiskirjeen</label>
<input id="tilaus" name="tilaus" type="checkbox" value="1" <?php echo $checked;?>/><br>
<div class="invalid-feedback"></div>

<button type="submit" value="Lähetä" name="painike">Lähetä</button>
</fieldset>
</form>

</div>
<?php
include('footer.html');
?>
</html>