<?php

require_once __DIR__ . '/../klase/Zadatak.php';

$id_zadatka = $_POST['id_zadatka'];

Zadatak::zavrsiZadatak($id_zadatka);

header('Location: ../za_uloge/za_rukovodioca_odeljenja.php');
die();