<?php
session_start();
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
    <title>Kreiraj komentar</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Ubuntu&display=swap');

        body{
            overflow: hidden;
            background-color: #D3D3D3;
        }

        .form-container{
            display: flex;
            align-items: center;
            justify-content: center;
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

        .form-container label, p{
            display: block;
            font-family: arial, sans-serif;
            text-align: left;
            padding-left: 22px;
            padding: 10px;
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

        h1{
            display:flex;
            justify-content: center;
            font-family: 'Montserrat', arial;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 30px;
        }

    </style>
</head>
<body>
    <a href="">-VRATI SE-</a>
    <h1>Kreiraj komentar</h1>
    <div class="form-container">
        <form action="../../logika/dodaj_komentar.php" method="post">
            <label for="">Unesite sadrzaj komentara:</label>
            <textarea name="sadrzaj_novog_komentara" cols="30" rows="5"></textarea>
            <label for="">Izaberite kom zadatku pripada komentar:</label>
            <select name="id_zadatka">
                <?php foreach ($sviZadaci as $zadatak): ?>
                        <option value="<?= $zadatak->id ?>$"><?= $zadatak->naslov ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" value="KREIRAJ KOMENTAR" class="dugme">
        </form>
    </div>
</body>
</html>