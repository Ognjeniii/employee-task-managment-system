<?php

session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: ../prijava.php');
    die();
}

$id = $_POST['id'];

require_once __DIR__ . '/../klase/Grupa.php';

Grupa::obrisiGrupu($id);

header('Location: ../za_uloge/za_rukovodioca_odeljenja.php');
die();