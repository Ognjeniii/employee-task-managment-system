<?php

session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: ../prijava.php');
    die();
}

$naziv_grupe = $_POST['naziv_grupe'];

require_once __DIR__ . '/../klase/Grupa.php';

$naslov = Grupa::vratiZaNaziv($naziv_grupe);
if ($naslov !== null) {
    header('Location: ../za_uloge/za_rukovodioca_odeljenja.php?neuspesnokreiranjegrupe');
    die();
}

$id = Grupa::kreirajGrupu($naziv_grupe);
if ($id > 0) {
    if ($_SESSION['tip_korisnika_id'] === 2) {
        header('Location: ../za_uloge/za_rukovodioca_odeljenja.php');
        die();
    } else if ($_SESSION['tip_korisnika_id'] === 1) {
        header('Location: ../za_uloge/za_admina/grupe_zadataka.php');
        die();
    }
}