<?php
function virhe($kentta){ 
if (isset($_POST['painike']) and !$GLOBALS[$kentta]) echo "$kentta puuttuu";
return;
}

$sposti = $_POST['sposti'] ?? "";
$salasana = $_POST['salasana'] ?? "";

if (isset($_POST['painike'])){
  /* Onnistunut kirjautuminen */

  /* Uusi sessio */
  session_start();
  $_SESSION['loggedIn'] = true;
  //$_SESSION['kayttaja'] = $nimi;
  header('location: index.php');
  exit;
  /* Epäonnistunut kirjautuminen */

  foreach($_POST as $key => $value){
    echo "$key:$value<br>";
    }

  //exit;  
  
}
?>
<!DOCTYPE html>
<html lang="fi">
<?php
include('header.php');
?>
<div class="container">
<h1>Kirjautuminen</h1> 

<form id="yhteydenotto" method="POST" novalidate>
<fieldset>
<legend>Kirjautuminen</legend>

<label class="label" for="sposti">Käyttäjätunnus</label>
<input id="sposti" name="sposti" type="email" placeholder="käyttäjätunnus" value="<?=$sposti;?>" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,4})+$"
 required/><br>
 <div class="invalid-feedback"><?php echo virhe('sposti');?></div>

<label class="label" for="salasana">Salasana</label>
<input id="salasana" name="salasana" type="password" placeholder="salasana" minlength="2" maxlength="40" pattern="[a-zA-ZåäöÅÄÖ- ]+" autofocus required/><br>
<div class="invalid-feedback"><?php echo virhe('salasana');?></div>

<button type="submit" value="Kirjaudu" name="painike">Kirjaudu</button>
</fieldset>
</form>

</div>
<?php
include('footer.html');
?>
</html>