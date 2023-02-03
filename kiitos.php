<!DOCTYPE html>
<html lang="fi">
<?php
include('header.php');
$tulos = $_GET['tulos'] ?? '';
?>
<div class="container">
<h1>Kiitos</h1> 
<?php
if ($tulos == 'ok'){
echo "Kiitos, tiedot on tallennettu:";
echo "<form action='index.php'>";
echo "<input type='submit' value='Kirjaudu'/>";
echo "</form>"; 
}
?>
</div>
<?php
include('footer.html')
?>
</html>