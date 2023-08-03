<?php

require_once __DIR__ . '/../klase/Korisnik.php';

$korisnicko_ime = $_POST['korisnicko_ime'];
$email = $_POST['email'];
$stara_lozinka = $_POST['stara_lozinka'];
$nova_lozinka = $_POST['nova_lozinka'];
$nova_lozinka_ponovljena = $_POST['nova_lozinka_ponovljena'];

if ($nova_lozinka !== $nova_lozinka_ponovljena) {
    header('Location: ../promena_lozinke.php?lozinka=0');
    die();
}

$korisnik = Korisnik::proveriKorisnika($korisnicko_ime, $email, $stara_lozinka);

if ($korisnik === null) {
    header('Location: ../promena_lozinke.php?error=1');
    die();
}

Korisnik::promeniLozinku($korisnicko_ime, $nova_lozinka);

header('Location: ../prijava.php');
die();