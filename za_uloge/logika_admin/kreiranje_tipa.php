<?php

require_once __DIR__ . '../../../klase/TipKorisnika.php';

$naziv_tipa = $_POST['naziv_tipa'];

$id = TipKorisnika::kreirajTip($naziv_tipa);

if ($id > 0) {
    header('Location: ../za_admina/tipovi_korisnika.php?uspesno');
    die();
}

header('Location: ../za_admina/tipovi_korisnika.php?error');
die();