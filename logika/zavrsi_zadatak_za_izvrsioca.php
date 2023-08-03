<?php

require_once __DIR__ . '/../klase/Korisnik.php';

$id_zadatka = $_POST['id_zadatka'];

session_start();
$korisnik_id = $_SESSION['korisnik_id'];

$korisnik = Korisnik::getById($korisnik_id);

$id_zadatka = strval($id_zadatka);
$zaUpis = $id_zadatka . " " . $korisnik->zavrsen_deo_zadatka;

Korisnik::zavrsiZadatakZaIzvrsioca($zaUpis, $korisnik_id);

header('Location: ../za_uloge/za_izvrsioca.php');
die();