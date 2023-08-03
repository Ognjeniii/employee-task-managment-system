<?php

$id_komentara = $_POST['id_komentara'];
$sadrzaj_komentara = $_POST['sadrzaj_komentara'];
$id_zadatka = $_POST['id_zadatka'];

require_once __DIR__ . '../../../klase/Komentar.php';
Komentar::menjajKomentar($id_komentara, $sadrzaj_komentara, $id_zadatka);

header('Location: ../za_admina/komentari.php');
die();