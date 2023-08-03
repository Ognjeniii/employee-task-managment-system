<?php
session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: ../prijava.php');
    die();
}

$naslov = $_POST['naslov'];
$opis_zadatka = $_POST['opis_zadatka'];

$lista_izvrsioca = implode(' ', $_POST['lista_izvrsioca']);

$rok_izvrsenja = $_POST['rok_izvrsenja'];
$prioritet = $_POST['prioritet'];
$grupa_zadatka_id = $_POST['grupa_zadatka_id'];
$propratni_fajlovi = $_POST['propratni_fajlovi'];

require_once __DIR__ . '/../klase/Zadatak.php';

Zadatak::izmeniZadatak(
    $naslov,
    $opis_zadatka,
    $lista_izvrsioca,
    $rok_izvrsenja,
    $prioritet,
    $grupa_zadatka_id,
    $propratni_fajlovi
);

header('Location: ../za_uloge/za_rukovodioca_odeljenja.php');
die();