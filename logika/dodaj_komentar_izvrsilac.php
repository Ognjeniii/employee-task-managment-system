<?php

require_once __DIR__ . '/../klase/Komentar.php';
require_once __DIR__ . '/../klase/Zadatak.php';

$id_zadatka = $_POST['id_zadatka'];
$sadrzaj_komentara = $_POST['sadrzaj_novog_komentara'];

Komentar::dodajKomentar($sadrzaj_komentara, $id_zadatka);

header('Location: ../za_uloge/za_izvrsioca.php');
die();