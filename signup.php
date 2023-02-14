<!DOCTYPE html>
<html lang="fi">
<?php
$title = "Rekisteröityminen";
$result = false;
$virheet = [];
$patterns['password'] = "/^.{12,}$/";
$patterns['firstname'] = "/^[a-zåäöA-ZÅÄÖ'-]*$/";
$patterns['lastname'] = $patterns['firstname']; 
$patterns['mobilenumber'] = "/^[0-9]{7,15}$/";
$patterns['email'] = "/^[\w]+[\w.+-]*@[\w-]+(\.[\w-]{2,})?\.[a-zA-Z]{2,}$/";

include('tietokantarutiinit.php');
include('header.php');

function nayta($kentta){
    echo (!isset($GLOBALS['virheet'][$kentta]) and isset($_POST[$kentta])) ? $_POST[$kentta] : ""; 
    return;
    }
    
function is_invalid($kentta){
      echo isset($GLOBALS['virheet'][$kentta]) ? "is-invalid" : ""; 
      return;
      }
    
function is_invalid_variable($kentta){
       $is_invalid = isset($GLOBALS['virheet'][$kentta]) ? "is-invalid" : ""; 
       return $is_invalid;
       }  

function validoi($kentta,$arvo){
   $patterns = $GLOBALS['patterns'];
   $virhe = false;
   if ($kentta == 'email' && !filter_var($arvo, FILTER_VALIDATE_EMAIL)) $virhe = 'email';
   elseif (!is_array($arvo) && !preg_match($patterns[$kentta],$arvo)) $virhe = 'match'; 
   elseif (is_array($arvo)){
      foreach ($arvo as $value){
         if (!preg_match($patterns[$kentta],$value)) $virhe = 'match';
         }
      }
   return $virhe;
   }      
     
if (isset($_POST['painike'])){
   $kentat = ['firstname','lastname','email','mobilenumber','password'];
   $pakolliset = ['firstname','lastname','email','mobilenumber','password'];
           
   foreach ($kentat as $kentta) {
      $$kentta = $_POST[$kentta] ?? '';
      if (!is_array($$kentta)){
         $$kentta = $yhteys->real_escape_string(strip_tags(trim($$kentta)));
         }
      else {
         foreach ($$kentta as $key => $value) {
            $$kentta[$key] = $yhteys->real_escape_string(strip_tags(trim($value)));
            }
         }
      if (!$$kentta && in_array($kentta,$pakolliset)) $virheet[$kentta] = 'puuttuu';
      elseif ($virhe = validoi($kentta,$$kentta)) $virheet[$kentta] = $virhe;
      }
      
      //$$kentta = implode(",",$$kentta);    
      $created = date("Y-m-d H:i:s",time());
      $kentat[] = 'created';    
      $str_kentat = implode(", ",$kentat);
      //echo "str_kentat:$str_kentat<br>";
           
      if (!$virheet) {
         $query = "INSERT INTO users ($str_kentat) VALUES ('$firstname', '$lastname', '$email', '$mobilenumber', '$password', '$created')";
         //echo "$query<br>";
         //exit;
         $result = $yhteys->query($query);
         $lisattiin = $yhteys->affected_rows;
         }   
   }
?>
<div class="container">

<form method="post" autocomplete="on" novalidate class="needs-validation">
<fieldset>
<legend>Rekisteröityminen</legend>   

<div class="row mb-sm-1">
<label class="form-label mb-0 col-sm-4">Etunimi</label>
<div class="col-sm-8">
<input id="firstname" name="firstname" pattern="<?=trim($patterns['firstname'],"/");?>" class="form-control <?php is_invalid('firstname');?>" placeholder="Etunimi" value="<?php nayta('firstname');?>" autofocus required></input>
<div class="invalid-feedback">Anna etunimi.</div>
</div></div>

<div class="row mb-sm-1">
<label class="form-label mb-0 col-sm-4">Sukunimi</label>
<div class="col-sm-8">
<input id="lastname" name="lastname" pattern="<?=trim($patterns['lastname'],"/");?>" class="form-control <?php is_invalid('lastname');?>" placeholder="Sukunimi" value="<?php nayta('lastname');?>" required></input>
<div class="invalid-feedback">Anna sukunimi.</div>
</div></div>

<div class="row mb-sm-1">
<label class="form-label mb-0 col-sm-4">Sähköpostiosoite</label>
<div class="col-sm-8">
<input id="email" name="email" type="email" pattern="<?=trim($patterns['email'],"/");?>" class="form-control <?php is_invalid('email');?>" placeholder="etunimi.sukunimi@yritys.fi" value="<?php nayta('email');?>" required></input>
<div class="invalid-feedback">Anna sähköpostiosoite.</div>
</div></div>

<div class="row mb-sm-1">
<label class="form-label mb-0 col-sm-4">Matkapuhelinnumero</label>
<div class="col-sm-8">
<input id="mobilenumber" name="mobilenumber" pattern="<?=trim($patterns['mobilenumber'],"/");?>" class="form-control <?php is_invalid('mobilenumber');?>" placeholder="358XX12345678" value="<?php nayta('mobilenumber');?>" required></input>
<div class="invalid-feedback">Anna matkapuhelinnumero.</div>
</div></div>

<div class="row mb-sm-1">
<label class="form-label mb-0 col-sm-4">Salasana</label>
<div class="col-sm-8">
<input id="password" name="password" minlength="12" type="password" class="form-control <?php is_invalid('password');?>" placeholder="salasana" required></input>
<div class="invalid-feedback">Anna salasana.</div>
</div></div>

<div class="row mb-sm-1">
<label class="form-label mb-0 col-sm-4 nowrap">Salasana uudestaan</label>
<div class="col-sm-8">
<input id="confirm_password" name="confirm_password" minlength="12" type="password" onkeyup="tarkista_salasana()" class="form-control <?php is_invalid('confirm_password');?>" placeholder="salasana uudestaan" required></input>
<div class="invalid-feedback">Anna salasana uudestaan.</div>
</div></div>

<input type="submit" name="painike" class="btn btn-primary" value="Tallenna">  
</fieldset>
</form>

<?php
if (isset($_POST['painike'])){
  echo '<div class="mt-3">';
  echo '<div class="alert alert-info" role="alert">';
  echo "Lomake on vastaanotettu.</div>";
  if ($virheet) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">";
    echo "Virheet:<br>";
    foreach ($virheet as $kentta => $arvo) echo "$kentta<br>";
    echo "</div>";
    }
  else {
    echo "<div class=\"alert alert-success\" role=\"alert\">";
    echo "Lisättiin: $lisattiin uusi käyttäjä<br></div>";   
    echo "<div class=\"alert alert-info\" role=\"alert\">";
    echo $query;
    echo "</div>";
  }
  echo "</div></div>";
  }
?>

</div>
<?php




include('footer.html')
?>
</html>