<?php

$tip = $_POST['tip'];

session_start();
$_SESSION['tip'] = $tip;

header('Location: ../za_uloge/za_izvrsioca.php');
die();