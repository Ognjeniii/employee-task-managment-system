<?php
session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: ../prijava.php');
    die();
}

$id = $_POST['id_grupe'];
$naslov = $_POST['novi_naslov'];

require_once __DIR__ . '/../klase/Grupa.php';

Grupa::izmeniGrupu($id, $naslov);

if ($_SESSION['tip_korisnika_id'] === 2) {
    header('Location: ../za_uloge/za_rukovodioca_odeljenja.php');
    die();
} else if ($_SESSION['tip_korisnika_id'] === 1) {
    header('Location: ../za_uloge/za_admina/grupe_zadataka.php');
    die();
}