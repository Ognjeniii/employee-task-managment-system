<?php
session_start();
$tip_korisnika_id = $_SESSION['tip_korisnika_id'];
if ($tip_korisnika_id != 1) {
    session_destroy();
    header('Location: ../prijava.php');
    die();
}

require_once __DIR__ . '../../../klase/Korisnik.php';
$sviKorisnici = Korisnik::vratiSveKorisnike();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korisnici</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Ubuntu&display=swap');

        body{
            background-color: #D3D3D3;
        }
        .korisnik{
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

        h1, h2{
            display:flex;
            justify-content: center;
            font-family: 'Montserrat', arial;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 10px;
        }
        h2{
            padding-bottom: 50px;
        }

        a{
            text-decoration: none;
            font-family: "Montserrat", arial;
            color: #000;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            border: solid 1px #000;
        }
        
        .dugme-container{
            display:flex;
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

        .bold{
            font-weight: bold;
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
    <h1>Dobrodosli!</h1>
    <h2>Svi korisnici</h2>
    <div class="dugme-container">
        <form action="napravi_korisnika.php" method="post">
            <input type="submit" name="kreiraj_korisnika.php" value="KREIRAJ KORISNIKA" class="dugme">
        </form>
        <form action="menjaj_korisnika.php" method="post">
            <input type="submit" name="menjaj_korisnika.php" value="MENJAJ KORISNIKA" class="dugme">
        </form>
    </div>
    <hr>
    <div>
        <?php foreach ($sviKorisnici as $korisnik): ?>
                <div class="korisnik">
                    <span class="bold"><?= $korisnik->id ?></span>
                    |
                    <span><?= $korisnik->korisnicko_ime ?></span>
                    |
                    <span><?= $korisnik->ime_prezime ?></span>
                    |
                    <span><?= $korisnik->email ?></span>
                    |
                    <span><?= $korisnik->broj_telefona ?></span>
                    |
                    <span><?= $korisnik->datum_rodjenja ?></span>
                    |
                    <span><?= $korisnik->tip_korisnika_id ?></span>

                    <form action="../logika_admin/brisanje_korisnika.php" method="post">
                        <input type="hidden" name="korisnicko_ime" value="<?= $korisnik->korisnicko_ime ?>">
                        <input type="submit" value="OBRISI" class="dugme-obrisi">
                    </form>
                </div>
        <?php endforeach ?>
    </div>
</body>
</html>