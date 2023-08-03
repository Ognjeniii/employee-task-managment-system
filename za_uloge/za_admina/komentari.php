<?php
session_start();
$tip_korisnika_id = $_SESSION['tip_korisnika_id'];
if ($tip_korisnika_id != 1) {
    session_destroy();
    header('Location: ../prijava.php');
    die();
}

require_once __DIR__ . '../../../klase/Komentar.php';

$sviKomentari = Komentar::vratiSveKomentare();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentari</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Ubuntu&display=swap');

        body{
            background-color: #D3D3D3;
        }

        h1{
            display:flex;
            justify-content: center;
            font-family: 'Montserrat', arial;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 30px;
        }

        a{
            text-decoration: none;
            font-family: "Montserrat", arial;
            color: #000;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            border: solid 1px #000;
        }

        .container{
            display: block;
            text-align: center;
        }

        .id-komentara{
            display: flex;
            justify-content:left;
            align-items: center;
            background-color: #aaa;
            padding: 10px; 
            border: solid black 1px;
            border-radius: 10px;
           
            /* box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.7) */
        }

        .sadrzaj-komentara{
            height: 50px;
            border: solid 3px #aaa;
            border-radius: 10px;
        }

        .komentar{
            padding: 5px;
            text-align: left;
            font-family: arial;
        }

        span{
            font-family: arial;
            padding: 5px;
            font-size: 110%;
        }

        .dugmici{
            display: flex;
            justify-content: right;
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
        }

        .dugme-obrisi:hover{
            color: black;
            border: 2px solid black;
            background-color: #aaa;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.7)
        }

        .area{
            display: block;
            text-align: right;
            padding: 10px;
            border: 2px dotted #505050;
            border-radius: 5px;
            margin: 5px;
        }

        .pomocni-tekst{
            color: #505050;
            font-family: arial;
            font-size: 80%;
            padding: 3px;
        }

        .kreiraj-menjaj{
            display: flex;
            justify-content: left;
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

    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</head>
<body>
    <a href="../za_administratora.php">-VRATI SE-</a>
    <h1>Komentari</h1>
    <div class="kreiraj-menjaj">
        <form action="kreiraj_komentar.php">
            <input type="submit" value="Kreiraj komentar" class="dugme">
        </form>
        <form action="menjaj_komentar.php">
            <input type="submit" value="Menjaj komentar" class="dugme">
        </form>
    </div>
    <div class="container">
        <?php foreach ($sviKomentari as $komentar): ?>
                    <div class="id-komentara">
                        <span>Id komentara: <?= $komentar->id ?></span>
                        |
                        <span>Id zadatka kome pripada: <?= $komentar->id_zadatka ?></span>
                    </div>
                    <div class="sadrzaj-komentara">
                        <div class="komentar"><?= $komentar->sadrzaj ?></div>
                        <div class="dugmici">
                            <form action="../../logika/obrisi_komentar.php" method="post">
                                <input type="hidden" name="komentar_id" value="<?= $komentar->id ?>">
                                <input type="submit" value="OBRISI" class="dugme-obrisi">
                            </form>
                        </div>
                    </div>
                    <br>
        <?php endforeach ?>
    </div>
</body>
</html>