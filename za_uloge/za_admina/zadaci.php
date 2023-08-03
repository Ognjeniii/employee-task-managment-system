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

require_once __DIR__ . '../../../klase/Zadatak.php';

$sviZadaci = Zadatak::vratiSveZadatke();
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadaci</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Ubuntu&display=swap');

        body{
            background-color: #D3D3D3;
        }

        .container-1{
            display: flex;
            margin-top: 100px;
        }

        .container-2{
            display: block;
            text-align: center;
        }

        .zadatak{
            display: flex;
            justify-content:left;
            align-items: center;
            background-color: #aaa;
            padding: 10px; 
            border: solid black 1px;
            border-radius: 10px;
            margin: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.7)
        }

        h1{
            display:flex;
            justify-content: center;
            font-family: 'Montserrat', arial;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 10px;
        }

        a{
            text-decoration: none;
            font-family: "Montserrat", arial;
            color: #000;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            border: solid 1px #000;
        }

        .dugme{
            padding: 30px;
            margin: 15px;
            font-family: 'Montserrat', arial;
            font-size: 105%;
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

        span{
            font-family: arial;
            padding: 5px;
            font-size: 110%;
        }
        
        .dugme-obrisi{
            font-family: 'Montserrat', arial;
            color: red;
            border: 2px solid red;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border-radius: 30px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
            width: 150px;
            height: 25px;
            margin-left:20px;
        }

        .dugme-obrisi:hover{
            color: black;
            border: 2px solid black;
            background-color: #aaa;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.7)
        }

    </style>
</head>
<body>
    <a href="../za_administratora.php">-VRATI SE-</a>
    <h1>Svi zadaci</h1>
    <div class="container-1">
        <form action="kreiraj_zadatak.php">
            <input type="submit" value="Kreiraj zadatak" class="dugme">
        </form>
        <form action="menjaj_zadatak.php">
            <input type="submit" value="Menjaj zadatak" class="dugme">
        </form>
    </div>
    <div class="container-2">
        <?php foreach ($sviZadaci as $zadatak): ?>
                <div class="zadatak">
                    <span><?= $zadatak->id ?></span>
                    |
                    <span><?= $zadatak->naslov ?></span>
                    |
                    <span><?= $zadatak->opis_zadatka ?></span>
                    |
                    <span><?= $zadatak->lista_izvrsioca ?></span>
                    |
                    <span><?= $zadatak->rukovodilac ?></span>
                    |
                    <span><?= $zadatak->rok_izvrsenja ?></span>
                    |
                    <form action="../../logika/brisanje_zadatka.php" method="post">
                        <input type="hidden" name="id" value="<?= $zadatak->id ?>">
                        <input type="submit" value="OBRISI" class="dugme-obrisi">
                    </form>
                </div>
        <?php endforeach ?>
    </div>
</body>
</html>