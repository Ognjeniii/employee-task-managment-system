<?php
session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: ../prijava.php');
    die();
}

$tip_korisnika_id = $_SESSION['tip_korisnika_id'];
if ($tip_korisnika_id != 1) {
    session_destroy();
    header('Location: ../prijava.php');
    die();
}


require_once __DIR__ . '../../../klase/Korisnik.php';
require_once __DIR__ . '../../../klase/Zadatak.php';

$izvrsioci = Korisnik::vratiIzvrsioce();
$rukovodioci = Korisnik::vratiRukovodioce();
$sveGrupe = Zadatak::vratiSveGrupe();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kreiraj zadatak</title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Ubuntu&display=swap');

        body{
            background-color: #D3D3D3;
        }

        .form-container{
            padding-top: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        input{
            margin: 10px;
            width: 250px;
        }
        
        .form-container label{
            display: block;
            font-family: arial, sans-serif;
            text-align: left;
            padding-left: 22px;
        }

        .dugme{
            width: 150px;
            height: 30px;
            font-family: 'Montserrat', sans-serif;
            background-color: #009FBD;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border-radius: 5px;
        }

        .dugme:hover{
            background-color: #19376D;
            color: #fff;
        }

        .petlja-div{
            display:flex;
            flex-direction: row-reverse;
            align-items: center;
            justify-content: flex-end;
            border-bottom: solid 1px #aaa;
            width: 80%;
            margin-inline: auto;
        }

        .petlja-div>input{
            width: 20px;
        }

        

    </style>
</head>
<body>
    <div class="form-container">
        <form action="../../logika/kreiranje_zadatka.php" method="post">
            <label>Unesite naslov:</label>
            <input type="text" name="naslov" placeholder="Naslov:" required>
            <label>Opis zadatka:</label>
            <textarea name="opis_zadatka" cols="20" rows="10" required></textarea>
            <label>Odaberite izvrsioce:</label>
            <?php foreach ($izvrsioci as $izvrsilac): ?>
                    <div class="petlja-div">
                        <input type="checkbox" name="lista_izvrsioca[]" class="lista_izvrsioca" value="<?= $izvrsilac->id ?>">
                        <label for="lista_izvrsioca"><?= $izvrsilac->id . " - " . $izvrsilac->korisnicko_ime ?></label>
                    </div>
            <?php endforeach ?>
            <br>
            <label for="">Odaberite rukovodioca:</label>
            <select name="rukovodilac">
                <?php foreach ($rukovodioci as $rukovodilac): ?>
                        <option value="<?= $rukovodilac->korisnicko_ime ?>"><?= $rukovodilac->korisnicko_ime ?></option>
                <?php endforeach ?>
            </select>
            <label>Rok izvrsenja:</label>
            <input type="datetime-local" name="rok_izvrsenja">
            <label>Prioritet:</label>
            <input type="number" name="prioritet" min="1" max="10" required>

            <label>Odaberite grupu kojoj pripada:</label>
            <select name="grupa_zadatka_id" class="grupa-select">
                <?php foreach ($sveGrupe as $grupa): ?>
                      <option value="<?= $grupa->id ?>"><?= $grupa->Naziv_grupe ?></option>
                <?php endforeach ?> 
            </select>
            <label>Propratni fajlovi:</label>
            <input type="file" name="propratni_fajlovi">

            <input type="submit" value="KREIRAJ ZADATAK" class="dugme">

        </form>
    </div>
</body>
</html>