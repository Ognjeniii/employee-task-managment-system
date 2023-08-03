<?php

require_once __DIR__ . '/../klase/Komentar.php';

$komentar_id = $_POST['komentar_id'];
Komentar::obrisiKomentar($komentar_id);

session_start();
if ($_SESSION['tip_korisnika_id'] === 2) {
    header('Location: ../za_uloge/za_rukovodioca_odeljenja.php');
    die();
} elseif ($_SESSION['tip_korisnika_id'] === 1) {
    header('Location: ../za_uloge/za_admina/komentari.php');
    die();
}