<?php

$korisnicko_ime = $_POST['korisnicko_ime'];
$stara_lozinka = $_POST['stara_lozinka'];
$nova_lozinka = $_POST['nova_lozinka'];
$nova_lozinka_ponovljena = $_POST['nova_lozinka_ponovljena'];

$ime_prezime = $_POST['ime_prezime'];
$email = $_POST['email'];
$broj_telefona = $_POST['broj_telefona'];
$datum_rodjenja = $_POST['datum_rodjenja'];
$tip_korisnika = $_POST['tip_korisnika'];


require_once __DIR__ . '../../../klase/Korisnik.php';

if ($nova_lozinka != null) {
    if ($nova_lozinka !== $nova_lozinka_ponovljena) {
        header('Location: ../za_admina/korisnici.php?error');
        die();
    }

    $nova_lozinka = hash('sha512', $nova_lozinka);

    Korisnik::promeniKorisnika($korisnicko_ime, $nova_lozinka, $ime_prezime, $email, $broj_telefona, $datum_rodjenja, $tip_korisnika);
    header('Location: ../za_admina/korisnici.php');
    die();
}
if ($nova_lozinka == '') {
    $stara_lozinka = hash('sha512', $stara_lozinka);

    Korisnik::promeniKorisnika($korisnicko_ime, $stara_lozinka, $ime_prezime, $email, $broj_telefona, $datum_rodjenja, $tip_korisnika);
    header('Location: ../za_admina/korisnici.php');
    die();
}
header('Location: ../za_admina/korisnici.php?error');
die();

//ovde bez menjanja lozinke