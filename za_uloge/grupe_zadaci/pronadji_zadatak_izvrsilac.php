<?php

require_once __DIR__ . '../../../klase/Zadatak.php';

$rezultat = [];

if(isset($_GET['pojam']))
{
    $pojam = $_GET['pojam'];
    $tip = $_GET['tip'];
    if($tip == 'po_datumu_zavrsetka')
    {
        $rezultat = Zadatak::vratiZaZavrsetak($_GET['pojam']);
    } elseif($tip == 'po_clanovima')
    {
        $zadaci = Zadatak::vratiSveZadatke();
        foreach($zadaci as $z){
            if(str_contains($z->lista_izvrsioca, $_GET['pojam']))
            {
                array_push($rezultat, $z);
            }
        }
        
    } else
    {
        $rezultat = Zadatak::vratiZaRukovodioca($_GET['pojam']);
    }
}

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

        span{
            padding: 5px;
        }

    </style>
</head>
<body>
    <a href="../za_izvrsioca.php">-VRATI SE-</a>
    <div class="form-container">
    <!-- ../../logika/pronalazenje_zadatka_izvrsilac.php -->
        <form action="" method="get">
            <label>Pronadji zadatak:</label>
            <input type="text" name="pojam" placeholder="Unesite neki pojam:" required>
            <select name="tip" class="stil-opcija" id="opcija">
                <option value="po_datumu_zavrsetka">po datumu zavrsetka</option>
                <option value="po_clanovima">po clanovima</option>
                <option value="po_rukovodiocima">po rukovodiocima</option>
            </select>
            <input type="submit" value="PRETRAZI" class="dugme">
        </form>
    </div>

    <?php if ($rezultat != null): ?>
            <?php foreach ($rezultat as $zadatak): ?>
                    <div class="rezultat">
                        <span><?= $zadatak->naslov ?></span>
                        |
                        <span><?= $zadatak->opis_zadatka ?></span>
                        |                    
                        <span><?= $zadatak->rok_izvrsenja ?></span>
                        |
                        <span><?= $zadatak->prioritet ?></span>
                    </div>
                    <br>
            <?php endforeach ?>
    <?php endif ?>
</body>
</html>