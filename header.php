<?php if (!session_id()) session_start();
$loggedIn = $_SESSION['loggedIn'] ?? false;
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<head>
    <meta charset="utf-8">
    <title><?= $title ?? 'Neilikka-mallisovellus';?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="site.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="errors.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="icon" type="image/x-icon" href="./globe32.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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
<!--navbar-nav-->  
<div class="topnav" id="myTopnav">
  <a class="brand-logo" href="index.php"><img src="globe32.png" alt="Brand Logo"></a>
  <a class="<?= ($activePage == 'index') ? 'active':''; ?>" href="index.php">Etusivu</a>
  <a class="<?= ($activePage == 'myymalat') ? 'active':''; ?>" href="myymalat.php">Myymälät</a>
  <a class="<?= ($activePage == 'tuotteet') ? 'active':''; ?>" href="tuotteet.php">Tuotteet</a>
  <a class="<?= ($activePage == 'yhteydenotto') ? 'active':''; ?>" href="yhteydenotto.php">Ota yhteyttä</a>
  <a class="<?= ($activePage == 'yritys') ? 'active':'';?>" href="yritys.php">Tietoa meistä</a>
  <?php
  if ($loggedIn) {
  echo '<a href="profiili.php">Profiili</a>';
  echo '<a class="nav-suojaus" href="poistu.php">Poistu</a>';
  }
  else {
  echo '<a class="nav-suojaus" href="kirjautuminen.php">Kirjautuminen</a>';
  }
  ?>
  <a href="javascript:void(0);" class="icon" onclick="menutoggle()">
  <i class="fa fa-bars"></i>
  </a>
</div>

