<?php

$id_tip_koji_se_menja = $_POST['tip_koji_se_menja'];
$naziv_novog_tipa = $_POST['naziv_tipa'];

require_once __DIR__ . '../../../klase/TipKorisnika.php';

TipKorisnika::menjajTip($naziv_novog_tipa,$id_tip_koji_se_menja);

header('Location: ../za_admina/tipovi_korisnika.php');
die();