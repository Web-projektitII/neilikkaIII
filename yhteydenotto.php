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
- sähköpostitse <a href="mailto:asiakaspalvelu@puutarhaliikeneilikka">asiakaspalvelu@puutarhaliikeneilikka.fi</a><br>
- alla olevalla lomakkeella<br>
</p>
<form id="yhteydenotto" onsubmit="tallennus()">
<fieldset>
<legend>Yhteydenottopyyntö</legend>
<label class="label" for="nimi">Nimi</label>
<input id="nimi" name="nimi" type="text" placeholder="nimi" autofocus required/><br>
<label class="label" for="sposti">Sähköpostiosoite</label>
<input id="posti" name="sposti" type="email" placeholder="sähköposti" required/><br>
<label class="label" for="aihe">Aihe</label>
<input id="aihe" name="aihe" type="text" placeholder="aihe" required/><br>
<label class="label label-textarea" for="viesti">Viesti</label>
<textarea id="viesti" name="viesti" rows="4" cols="40" placeholder="Kirjoita viesti tähän." required></textarea><br>
<label class="label" for="tilaus">Haluan tilata Puutarhaliike Neilikan uutiskirjeen</label>
<input id="tilaus" name="tilaus" type="checkbox"/><br>
<button type="submit" value="Lähetä" name="painike">Lähetä</button>
</fieldset>
</form>

</div>
<?php
include('footer.html')
?>
</html>