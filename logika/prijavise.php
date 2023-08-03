<?php

$korisnicko_ime = $_POST['korisnicko_ime'];
$lozinka = $_POST['lozinka'];

require_once __DIR__ . '/../klase/Korisnik.php';

$korisnik = Korisnik::prijava($korisnicko_ime, $lozinka);

if ($korisnik === null) {
    header('Location: ../prijava.php?error=1');
    die();
}
session_start();
$_SESSION['korisnik_id'] = $korisnik->id;
$_SESSION['tip_korisnika_id'] = $korisnik->tip_korisnika_id;

if ($korisnik->tip_korisnika_id === 1) {
    header('Location: ../za_uloge/za_administratora.php');
    die();
}
if ($korisnik->tip_korisnika_id === 2) {
    header('Location: ../za_uloge/za_rukovodioca_odeljenja.php');
    die();
}
if ($korisnik->tip_korisnika_id === 3) {
    header('Location: ../za_uloge/za_izvrsioca.php');
    die();
}

header('Location: ../nekastranica.php');
die();