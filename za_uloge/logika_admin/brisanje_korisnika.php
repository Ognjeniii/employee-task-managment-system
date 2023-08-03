<?php

$korisnicko_ime = $_POST['korisnicko_ime'];

require_once __DIR__ . '../../../klase/Korisnik.php';

Korisnik::obrisiKorisnika($korisnicko_ime);

header('Location: ../za_admina/korisnici.php');
die();