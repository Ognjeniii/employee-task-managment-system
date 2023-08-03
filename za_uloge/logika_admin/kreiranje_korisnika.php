<?php

$korisnicko_ime = $_POST['korisnicko_ime'];
$lozinka = $_POST['lozinka'];
$ponovljena_lozinka = $_POST['ponovljena_lozinka'];
$ime_prezime = $_POST['ime_prezime'];
$email = $_POST['email'];
$broj_telefona = $_POST['broj_telefona'];
$datum_rodjenja = $_POST['datum_rodjenja'];
$tip_korisnika = $_POST['tip_korisnika'];

if ($lozinka !== $ponovljena_lozinka) {
    header('Location: ../za_admina/korisnici.php?error');
    die();
}

require_once __DIR__ . '../../../klase/Korisnik.php';

$id = Korisnik::kreiranjeKorisnika($korisnicko_ime, $lozinka, $ime_prezime, $email, $broj_telefona, $datum_rodjenja, $tip_korisnika);
if ($id > 0) {
    header('Location: ../za_admina/korisnici.php?uspesno');
    die();
}

header('Location: ../za_admina/korisnici.php?error');
die();