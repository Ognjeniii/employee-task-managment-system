<?php

if (!isset($_POST['korisnicko_ime'])) {
    header('Location: ../registracija.php');
    die();
}

$korisnicko_ime = $_POST['korisnicko_ime'];
$lozinka = $_POST['lozinka'];
$ponovljena_lozinka = $_POST['ponovljena_lozinka'];
$ime_prezime = $_POST['ime_prezime'];
$email = $_POST['email'];
$broj_telefona = $_POST['broj_telefona'];
$datum_rodjenja = $_POST['datum_rodjenja'];

if ($lozinka !== $ponovljena_lozinka) {
    header('Location: ../registracija.php?lozinka=0');
    die();
}

require_once __DIR__ . '/../klase/Korisnik.php';

try {
    $id = Korisnik::registracija($korisnicko_ime, $lozinka, $ime_prezime, $email, $broj_telefona, $datum_rodjenja);
} catch (Exception $e) {

}

if ($id > 0) {
    header('Location: ../prijava.php');
    die();
}

header('Location: ../registracija.php?error=1');
die();