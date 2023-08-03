<?php

require_once __DIR__ . '/../klase/Komentar.php';
require_once __DIR__ . '/../klase/Zadatak.php';

$id_zadatka = $_POST['id_zadatka'];
$sadrzaj_komentara = $_POST['sadrzaj_novog_komentara'];

$id = Komentar::dodajKomentar($sadrzaj_komentara, $id_zadatka);
if ($id > 0) {
    session_start();
    if ($_SESSION['tip_korisnika_id'] === 2) {
        // header('Location: ../za_uloge/za_rukovodioca_odeljenja.php');
        // die();
        $komentar = Komentar::vratiZaId($id);
        echo json_encode($komentar);
    } elseif ($_SESSION['tip_korisnika_id'] === 1) {
        header('Location: ../za_uloge/za_admina/komentari.php');
        die();
    }
} else {
    header('Location: ../za_uloge/za_rukovodioca_odeljenja.php?error');
    die();
}