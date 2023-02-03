<?php if (!session_id()) session_start();
$loggedIn = $_SESSION['loggedIn'] ?? false;
?>
<head>
    <meta charset="utf-8">
    <title>Neilikka-mallisovellus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="site.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="errors.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="icon" type="image/x-icon" href="./globe32.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="scripts.js" async defer></script>
    <style>
    /* {
      color:#000;
      font-weight:bold;
      font-family: 'Roboto', sans-serif;
    }*/
    </style>
</head>

<body>
<div class="topnav" id="myTopnav">
  <a class="brand-logo active" href="index.php"><img src="globe32.png" alt="Brand Logo"></a>
  <a href="index.php">Etusivu</a>
  <a href="myymalat.php">Myymälät</a>
  <a href="tuotteet.php">Tuotteet</a>
  <a href="yhteydenotto.php">Ota yhteyttä</a>
  <a href="yritys.php">Tietoa meistä</a>
  <?php
  if ($loggedIn) {
  echo '<a href="profiili.php">Profiili</a>';
  echo '<a class="nav-suojaus" href="poistu.php">Poistu</a>';
  }
  else {
  echo '<a class="nav-suojaus" href="kirjautuminen.php">Kirjautuminen</a>?>';
  }
  ?>
  <a href="javascript:void(0);" class="icon" onclick="menutoggle()">
  <i class="fa fa-bars"></i>
  </a>
</div>

