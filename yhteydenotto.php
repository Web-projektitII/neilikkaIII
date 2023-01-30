<?php
if (isset($_POST['painike'])){
  /*foreach($_POST as $key => $value){
    echo "$key:$value<br>";
    }*/
    echo json_encode($_POST);
    exit;  
}
?>
<!DOCTYPE html>
<html lang="fi">
<?php
include('header.php')
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
<form id="yhteydenotto" method="POST" novalidate onsubmit="tallennus(event)">
<fieldset>
<legend>Yhteydenottopyyntö</legend>
<label class="label" for="nimi">Nimi</label>
<input id="nimi" name="nimi" type="text" placeholder="nimi" minlength="2" maxlength="40" pattern="[a-zA-ZåäöÅÄÖ- ]+" autofocus required/><br>
<label class="label" for="sposti">Sähköpostiosoite</label>
<input id="posti" name="sposti" type="email" placeholder="sähköposti" pattern="^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,4})+$"
 required/><br>
<label class="label" for="aihe">Aihe</label>
<input id="aihe" name="aihe" type="text" placeholder="aihe" maxlength="40" required/><br>
<label class="label label-textarea" for="viesti">Viesti</label>
<textarea id="viesti" name="viesti" rows="4" cols="40" maxlength="256" placeholder="Kirjoita viesti tähän." required></textarea><br>
<label class="label" for="tilaus">Haluan tilata Puutarhaliike Neilikan uutiskirjeen</label>
<input id="tilaus" name="tilaus" type="checkbox" value="1"/><br>
<button type="submit" value="Lähetä" name="painike">Lähetä</button>
</fieldset>
</form>

</div>
<?php
include('footer.html')
?>
</html>