<?php

$id = $_POST['id_tipa'];

require_once __DIR__ . '../../../klase/TipKorisnika.php';

TipKorisnika::obrisiTip($id);

header('Location: ../za_admina/tipovi_korisnika.php');
die();