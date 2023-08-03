<?php
session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: ../prijava.php');
    die();
}
$id = $_POST['id'];

require_once __DIR__ . '/../klase/Zadatak.php';

Zadatak::obrisiZadatak($id);

if ($_SESSION['tip_korisnika_id'] === 2) {
    header('Location: ../za_uloge/za_rukovodioca_odeljenja.php');
    die();
} elseif ($_SESSION['tip_korisnika_id'] === 1) {
    header('Location: ../za_uloge/za_admina/zadaci.php');
    die();
}

// u slucaju da je zadatak obrisan vraca me na dugmice, isto tako i ako nije obrisan..
// sa sve metode je tako, naci relevantno resenje za to...
