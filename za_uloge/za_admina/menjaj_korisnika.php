<?php
session_start();
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
    <title>Promeni postojeceg korisnika</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Ubuntu&display=swap');

        body{
            background-color: #D3D3D3;
        }

        .form-container{
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

        .form-container label, p{
            display: block;
            font-family: arial, sans-serif;
            text-align: left;
            padding-left: 22px;
        }

        .dugme{
            width: 170px;
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

        select{
            margin: 10px;
            padding: 3px;
            background-color: #D3D3D3;
        }

        a{
            text-decoration: none;
            font-family: "Montserrat", arial;
            color: #000;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            border: solid 1px #000;
        }

        p{
            font-size: 70%;
            padding-right: 20px;
            color:#808080;
        }

    </style>
</head>
<body>
    <a href="../za_admina/korisnici.php">-VRATI SE-</a>
    <div class="form-container">
        <form action="../logika_admin/menjanje_korisnika.php" method="post">
            <label>Unesite korisnicko ime korisnika kog zelite da menjate:</label>
            <input type="text" name="korisnicko_ime" placeholder="Korisnicko ime:" required><br>
            <p>U slucaju da ne zelite da menjate lozinku, unesite samo staru.</p>
            <label>Unesite staru lozinku:</label>
            <input type="password" name="stara_lozinka" placeholder="Stara lozinka:" required><br>
            <label>Unesite novu lozinku:</label>
            <input type="password" name="nova_lozinka" placeholder="Nova lozinka:"><br>
            <label>Ponovite novu lozinku:</label>
            <input type="password" name="nova_lozinka_ponovljena" placeholder="Nova lozinka:"><br>
            <label>Unesite ime i prezime:</label>
            <input type="text" name="ime_prezime" placeholder="Ime i prezime:" required><br>
            <label>Unesite email:</label>
            <input type="email" name="email" placeholder="Email:" required><br>
            <label>Unesite broj telefona:</label>
            <input type="text" name="broj_telefona" placeholder="Broj telefona:"><br>
            <label>Unesite datum rodjenja: </label>
            <input type="date" name="datum_rodjenja" class="datum-rodjenja"><br>
            <label for="">Obelezite tip korisnika:</label>
            <select name="tip_korisnika">
                <option value="1">administrator</option>
                <option value="2">rukovodilac odeljenja</option>
                <option value="3">izvrsilac</option>
            </select>
            <input type="submit" value="PROMENI PODATKE" class="dugme">
        </form>
    </div>
</body>
</html>