<?php
session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: ../prijava.php');
    die();
}

$naslov = $_POST['naslov'];
$opis_zadatka = $_POST['opis_zadatka'];
$lista_izvrsioca = implode(' ', $_POST['lista_izvrsioca']);

//ovo je kada rukovodilac kreira
$rukovodilac_id = $_SESSION['korisnik_id'];

//ovo je kada admin kreira
$rukovodilac = $_POST['rukovodilac'];

$rok_izvrsenja = $_POST['rok_izvrsenja'];
$prioritet = $_POST['prioritet'];
$grupa_zadatka_id = $_POST['grupa_zadatka_id'];
$propratni_fajlovi = $_POST['propratni_fajlovi'];

require_once __DIR__ . '/../klase/Korisnik.php';

$korisnik = Korisnik::getById($rukovodilac_id);
if ($korisnik === null) {
    header('Location: ../prijava.php');
    die();
}

require_once __DIR__ . '/../klase/Zadatak.php';

$zadatak = Zadatak::vratiZaNaslov($naslov);
if ($zadatak !== null) {
    if ($_SESSION['tip_korisnika_id'] === 2) {
        header('Location: ../za_uloge/za_rukovodioca_odeljenja.php?neuspesnokreiranje');
        die();
    }
}

if ($_SESSION['tip_korisnika_id'] === 2) {
    $id = Zadatak::kreirajZadatak(
        $naslov,
        $opis_zadatka,
        $lista_izvrsioca, $korisnik->korisnicko_ime,
        $rok_izvrsenja,
        $prioritet,
        $grupa_zadatka_id,
        $propratni_fajlovi
    );
    if ($id > 0) {
        header('Location: ../za_uloge/za_rukovodioca_odeljenja.php?uspesnokreiranje');
        die();
    }
} elseif ($_SESSION['tip_korisnika_id'] === 1) {
    $id = Zadatak::kreirajZadatak(
        $naslov,
        $opis_zadatka,
        $lista_izvrsioca,
        $rukovodilac,
        $rok_izvrsenja,
        $prioritet,
        $grupa_zadatka_id,
        $propratni_fajlovi
    );
    if ($id > 0) {
        header('Location: ../za_uloge/za_admina/zadaci.php?uspesno');
        die();
    }
}