<?php

$id_grupe = $_POST['id_grupe'];

require_once __DIR__ . '../../../klase/Grupa.php';

Grupa::obrisiGrupu($id_grupe);

header('Location: ../za_admina/grupe_zadataka.php');
die();