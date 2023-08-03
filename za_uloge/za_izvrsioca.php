<?php
session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: ../prijava.php');
    die();
}

$tip_korisnika_id = $_SESSION['tip_korisnika_id'];
if ($tip_korisnika_id != 3) {
    session_destroy();
    header('Location: ../prijava.php');
    die();
}

$korisnik_id = $_SESSION['korisnik_id'];
require_once __DIR__ . '/../klase/Zadatak.php';
require_once __DIR__ . '/../klase/Korisnik.php';

if(!isset($_SESSION['tip'])){
    $zadaci = Zadatak::vratiSveZadatke();
} elseif($_SESSION['tip'] == 'po_datumu_zavrsetka')
{
    $zadaci = Zadatak::sortirajPoZavrsetku();
} elseif($_SESSION['tip'] == 'po_clanovima')
{
    $zadaci = Zadatak::sortirajPoClanovima();
} elseif($_SESSION['tip'] == 'po_rukovodiocima')
{
    $zadaci = Zadatak::sortitajPoRukovodiocima();
}

$trenutniKorisnik = Korisnik::getById($korisnik_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izvrsilac</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Ubuntu&display=swap');

        body{
            background-color: #D3D3D3;
        }

        h1{
           display: flex;
           justify-content: center;
           padding: 20px;
           font-family: "Montserrat", arial;
           text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
 
        }

        .container-1{
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
            align-items: center;
            border: 1px solid #000;
            border-radius: 10px;
            padding: 10px;
            font-size: 110%;
            font-family:arial;
            background-color: #aaa;
        }
        
        span{
            padding:5px;
        }

        .dugme{
            padding: 20px;
            margin: 25px;
            font-family: 'Montserrat', arial;
            font-size: 110%;
            color: blue;
            border: 2px solid blue;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .dugme:hover{
            color: black;
            border: 2px solid black;
            background-color: #aaa;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.7)
        }

        .zavrsen{
            padding-left: 30px;
        }

        .dugme-tip-forma{
            background-color: #aaa;
            font-family: 'Montserrat', arial;
            border: none;
            text-shadow: 0px 4px 6px rgba(0, 0, 0, 0.7);
            cursor: pointer;
        }

        .komentari{
            border: 1px solid #7C9070;
            border-radius: 10px;
        }

        .komentari p{
            padding-left: 20px;
            font-family: arial;
        }

        .dugme-dodaj{
            font-family: 'Montserrat', arial;
            color: blue;
            border: 2px solid blue;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border-radius: 30px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
            width: 150px;
            height: 25px;
        }

        .dugme-dodaj:hover{
            color: black;
            border: 2px solid black;
            background-color: #aaa;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.7)
        }

        a{
            text-decoration: none;
            font-family: "Montserrat", arial;
            color: #000;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            border: solid 1px #000;
        }

        .sortiranje{
            padding:25px;
            font-family: arial;
        }

        .stil-opcija{
            padding: 2px;
            background-color:#aaa;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <a href="../logika/odjavise.php">-ODJAVI SE-</a>
    <h1>Dobrodosli!</h1>

    <div class="trazi-zadatak">
    <form action="grupe_zadaci/pronadji_zadatak_izvrsilac.php">
            <input type="submit" class="dugme" value="Pronadji zadatak">
        </form>
    </div>

    <div class="sortiranje">
        <form action="../logika/sortiranje_zadataka.php" method="post">
            <label for="tip">Sortiraj po:</label>
            <select name="tip" class="stil-opcija">
                <option value="po_datumu_zavrsetka">datumu zavrsetka</option>
                <option value="po_clanovima">clanovima</option>
                <option value="po_rukovodiocima">rukovodiocima</option>
            </select>
            <input type="submit" value="sortiraj">
        </form>
    </div>
    
    <div class="body-container">
        <?php foreach ($zadaci as $zadatak): ?>
                <?php if (str_contains($zadatak->lista_izvrsioca, $korisnik_id)): ?>
                        <div class="container-1">
                            <span><?= $zadatak->naslov ?></span>
                            |
                            <span><?= $zadatak->opis_zadatka ?></span>
                            |
                            <span><?= $zadatak->rok_izvrsenja ?></span>
                            |
                            <?php if(!str_contains($trenutniKorisnik->zavrsen_deo_zadatka, $zadatak->id)) : ?>
                                <form action="../logika/zavrsi_zadatak_za_izvrsioca.php" method="post">
                                    <input type="hidden" name="id_zadatka" value="<?= $zadatak->id ?>">
                                    <input type="submit" value="ZAVRSI" class="dugme-tip-forma">
                                </form>
                            <?php else : ?>
                                <span>Zadatak zavrsen</span>
                            <?php endif ?>
                        </div>
                        <form action="../logika/dodaj_komentar_izvrsilac.php" method="post" class="dodaj-komentar">
                            <input type="hidden" name="id_zadatka" value="<?= $zadatak->id ?>">
                            <textarea name="sadrzaj_novog_komentara" cols="30" rows="3" required></textarea>
                            <input type="submit" value="DODAJ KOMENTAR" class="dugme-dodaj">
                        </form>
                        <br>
                <?php endif ?>
        <?php endforeach ?>
    </div>
</body>
</html>