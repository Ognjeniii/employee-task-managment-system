<?php
session_start();
$tip_korisnika_id = $_SESSION['tip_korisnika_id'];
if ($tip_korisnika_id != 1) {
    session_destroy();
    header('Location: ../prijava.php');
    die();
}

require_once __DIR__ . '../../../klase/TipKorisnika.php';
$sviTipovi = TipKorisnika::vratiSveTipove();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promeni postojeci tip</title>
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
<a href="tipovi_korisnika.php">-VRATI SE-</a>
    <h1>Promeni postojeci tip korisnika</h1>
        <div class="form-container">
            <form action="../logika_admin/menjanje_tipa.php" method="post">
                <label>Izaberite tip koji zelite da promenite:</label>
                <select name="tip_koji_se_menja">
                    <?php foreach($sviTipovi as $tip) : ?>
                        <option value="<?= $tip->id ?>"><?= $tip->naziv_tipa ?></option>
                    <?php endforeach ?>
                </select>
                <label for="">Unesite novi naziv tipa:</label>
                <input type="text" name="naziv_tipa" placeholder="Naziv tipa:" required>
                <input type="submit" value="MENJAJ TIP" class="dugme">
            </form>
        </div>
</body>
</html>