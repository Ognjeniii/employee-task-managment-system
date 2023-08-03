<?php

require_once __DIR__ . '../../../klase/Zadatak.php';

$rezultat = [];

if (isset($_GET['tip_po_kom_se_pretrazuje'])) {
    $pojam = $_GET['tip_po_kom_se_pretrazuje'];
    $tip = $_GET['tip'];
    if ($tip == 'po_naslovu') {
        $rezultat = Zadatak::vratiZaNaslovPronalazenje($pojam);
    } elseif ($tip == 'po_prioritetu') {
        $rezultat = Zadatak::vratiZaPrioritet($pojam);
    } elseif ($tip == 'po_izvrsiocima') {
        $sviZadaci = Zadatak::vratiSveZadatke();
        foreach ($sviZadaci as $zadatak) {
            if (str_contains($zadatak->lista_izvrsioca, $pojam)) {
                array_push($rezultat, $zadatak);
            }
        }
    } else {
        $datum_od = strtotime($pojam);
        $datum_do = $_GET['datum_do'];
        $datum_do = strtotime($datum_do);
        $sviZadaci = Zadatak::vratiSveZadatke();
        foreach ($sviZadaci as $zadatak) {
            $zadatakRokC = strtotime($zadatak->rok_izvrsenja);
            if ($datum_od <= $zadatakRokC && $datum_do >= $zadatakRokC) {
                array_push($rezultat, $zadatak);
            }
        }
    }
}

// if (!isset($_SESSION['datum_do'])) {
//     $_SESSION['datum_do'] = '';
// }
// if (!isset($_SESSION['tip'])) {
//     $_SESSION['tip'] = '';
// }
// if (!isset($_SESSION['pojam'])) {
//     $_SESSION['pojam'] = '';
// } else {
//     $pojam = $_SESSION['pojam'];
//     if ($_SESSION['tip'] == 'po_naslovu') {
//         $rezultat = Zadatak::vratiZaNaslov($pojam);
//         unset($_SESSION['tip']);
//         unset($_SESSION['pojam']);
//         unset($_SESSION['datum_do']);
//     } elseif ($_SESSION['tip'] === 'po_prioritetu') {
//         $rezultat = Zadatak::vratiZaPrioritet($pojam);
//         unset($_SESSION['tip']);
//         unset($_SESSION['pojam']);
//         unset($_SESSION['datum_do']);
//     } elseif ($_SESSION['tip'] === 'po_izvrsiocima') {
//         $sviZadaci = Zadatak::vratiSveZadatke();
//         foreach ($sviZadaci as $zadatak) {
//             if (str_contains($zadatak->lista_izvrsioca, $pojam)) {
//                 array_push($rezultat, $zadatak);
//             }
//         }
//         unset($_SESSION['tip']);
//         unset($_SESSION['pojam']);
//         unset($_SESSION['datum_do']);
//     } elseif ($_SESSION['tip'] === 'po_roku_izvrsenja') {
//         $datum_od = strtotime($pojam);
//         $datum_do = $_SESSION['datum_do'];
//         $datum_do = strtotime($datum_do);
//         $sviZadaci = Zadatak::vratiSveZadatke();
//         foreach ($sviZadaci as $zadatak) {
//             $zadatakRokC = strtotime($zadatak->rok_izvrsenja);
//             if ($datum_od <= $zadatakRokC && $datum_do >= $zadatakRokC) {
//                 array_push($rezultat, $zadatak);
//             }
//         }
//         unset($_SESSION['tip']);
//         unset($_SESSION['pojam']);
//         unset($_SESSION['datum_do']);
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pronadji zadatak</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Ubuntu&display=swap');


        body{
            background-color: #D3D3D3;
            /* overflow-x: hidden; */
        }

        .form-container{
            display: flex;
            align-items: center;
            justify-content: center;
            /* height: 100vh; */
            padding: 100px 0 100px 0;
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

        .rezultat{
            background-color: #aaa;
            width: 100%;
            height: 50px;
            border: solid black 1px;
            border-radius: 10px;
            font-family: arial;
            font-size:120%;
            display: flex;
            justify-content: left;
            align-items: center;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.6);
        }

        .rezultat span{
            padding: 5px;
        }

        a{
            text-decoration: none;
            font-family: "Montserrat", arial;
            color: #000;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            border: solid 1px #000;
        }

        .stil-opcija{
            padding: 2px;
            background-color:#aaa;
            border-radius: 5px;
        }

    </style>
    <script>
        function otkrij(){
            let input = document.getElementById("datum_do");
            input.style.display = "inline-block";
            let inputPlace = document.getElementById("datum_od");
            inputPlace.setAttribute("placeholder", "Unesite datum od:");
        }

        function sakrij(){
            let input = document.getElementById("datum_do");
            input.style.display = "none";
            let inputPlace = document.getElementById("datum_od");
            inputPlace.setAttribute("placeholder", "Unesite neki pojam:");
        }
    </script>
</head>
<body>
    <a href="../za_rukovodioca_odeljenja.php">-VRATI SE-</a>
    <div class="form-container">
        <form action="" method="get">
            <div id="container-input">
                <label for="">Pronadji zadatak:</label>
                <input type="text" name="tip_po_kom_se_pretrazuje" id="datum_od" placeholder="Unesite neki pojam:" required>
                <input type="text" name="datum_do" id="datum_do" placeholder="Unesite datum do:" style="display:none">
                <select name="tip" class="stil-opcija" id="opcija" onchange=
                "if(this.value === 'po_roku_izvrsenja'){
                    otkrij();
                }
                else{
                    sakrij();
                }">
                    <option value="po_prioritetu">po prioritetu</option>
                    <option value="po_izvrsiocima">po izvrsiocima</option>
                    <option value="po_naslovu">po naslovu</option>
                    <option value="po_roku_izvrsenja">po roku izvrsenja</option>
                </select>
                <input type="submit" value="PRETRAZI" class="dugme">
            </div>
        </form>
    </div>
        <?php if ($rezultat != null): ?>
                    <?php foreach ($rezultat as $zadatak): ?>
                                <div class="rezultat">
                                    <span><?= $zadatak->naslov ?></span>
                                    |
                                    <span><?= $zadatak->opis_zadatka ?></span>
                                    |
                                    <span><?= $zadatak->lista_izvrsioca ?></span>
                                    |
                                    <span><?= $zadatak->rok_izvrsenja ?></span>
                                    |
                                    <span><?= $zadatak->prioritet ?></span>
                                </div> 
                                <hr>
                    <?php endforeach ?>
        <?php endif ?>
</body>
</html>