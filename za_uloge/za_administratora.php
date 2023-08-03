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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Ubuntu&display=swap');

        body{
            background-color: #D3D3D3;
        }

        .container-1{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            
        }

        .container-2{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start; 
        }

        h1{
            display: flex;
            justify-content: center;
            font-family: 'Montserrat', arial;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 20px;
            }

        .dugme{
            padding: 30px;
            margin: 15px;
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

        a{
            text-decoration: none;
            font-family: "Montserrat", arial;
            color: #000;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            border: solid 1px #000;
        }

    </style>
</head>
<body>
    <a href="../logika/odjavise.php">-ODJAVI SE-</a>
    <h1>Dobrodosli!</h1>
    <div class="container-1">
        <form action="za_admina/tipovi_korisnika.php" method="post">
            <input type="submit" class="dugme" value="Tipovi korisnika">
        </form>
        <form action="za_admina/korisnici.php" method="post">
            <input type="submit" class="dugme" value="Korisnici">
        </form>
    </div>
    <div class="container-2">
        <form action="za_admina/grupe_zadataka.php" method="post">
            <input type="submit" class="dugme" value="Grupe zadataka">
        </form>
        <form action="za_admina/zadaci.php" method="post">
            <input type="submit" class="dugme" value="Zadaci">
        </form>
        <form action="za_admina/komentari.php" method="post">
            <input type="submit" class="dugme" value="Komentari">
        </form>
    </div>
</body>
</html>
