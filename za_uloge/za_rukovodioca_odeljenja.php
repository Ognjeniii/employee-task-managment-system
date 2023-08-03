<?php
session_start();
if (!isset($_SESSION['korisnik_id'])) {
    header('Location: ../prijava.php');
    die();
}

$tip_korisnika_id = $_SESSION['tip_korisnika_id'];
if ($tip_korisnika_id != 2) {
    session_destroy();
    header('Location: ../prijava.php');
    die();
}

require_once __DIR__ . '/../klase/Zadatak.php';

$sviZadaci = Zadatak::vratiSveZadatke();
$sviKomentari = Komentar::vratiSveKomentare();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rukovodilac odeljenja</title>
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

        .container-3{
            position: absolute;
            padding-top: 250px;
        }

        .uspesno{
            color: green;
            font-size: 110%;
            font-family: 'Montserrat', arial;
        }

        .neuspesno{
            color: red;
            font-size: 110%;
            font-family: 'Montserrat', arial;
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

        .container-4{
            padding: 280px 0 0 0;
        }
       
        .zadatak{
            display: flex;
            justify-content:left;
            align-items: center;
            background-color: #aaa;
            padding: 10px; 
            border: solid black 1px;
            border-radius: 10px;
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

        .lista-zadataka{
            font-family: arial;
            font-size: 110%;
            padding: 5px;
        }

        .komentari{
            border: 1px solid #7C9070;
            border-radius: 10px;
        }

        .komentari p{
            padding-left: 20px;
            font-family: arial;
        }

        .komentari form{
            display: flex;
            justify-content: right;
        }

        .dugme-tip-forma{
            padding: 5px;
        }

        .dugme-tip-zadatka{
            background-color: #aaa;
            font-family: 'Montserrat', arial;
            border: none;
            text-shadow: 0px 4px 6px rgba(0, 0, 0, 0.7);
            cursor: pointer;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $('#dodaj-komentar').on('submit', function(e){
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: {
                        'sadrzaj_novog_komentara': $('[name="sadrzaj_novog_komentara"]').val(),
                        'id_zadatka': $('[name="id_zadatka"]').val()
                    },
                    dataType: 'json',
                    success: function(komentar){
                        console.log(komentar);
                        form.before(
                            '<div class="komentari">' + 
                                        '<p>' + 
                                        komentar.sadrzaj + 
                                        '</p>' + 
                                        '<form action="../logika/obrisi_komentar.php" method="post" class="obrisi-komentar">' + 
                                            '<input type="hidden" name="komentar_id" value=" ' + komentar.id + '">' +
                                            '<input type="submit" value="OBRISI" class="dugme-obrisi">' + 
                                        '</form>' + 
                                    '</div>'
                        );
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });
        
            $('.obrisi-komentar').on('submit', function(e){
                e.preventDefault();
                 let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data:{
                        'komentar_id': form.find('[name="komentar_id"]').val()
                    },
                    success: function(response){
                        form.parent().remove();
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <a href="../logika/odjavise.php">-ODJAVI SE-</a>
    <h1>Dobrodosli!</h1>
    <div class="container-1">
        <form action="grupe_zadaci/kreiraj_grupu.php">
            <input type="submit" class="dugme" value="Kreiraj grupu">
        </form>
        <form action="grupe_zadaci/menjaj_grupu.php">
            <input type="submit" class="dugme" value="Izmeni grupu">
        </form>
        <form action="grupe_zadaci/obrisi_grupu.php">
            <input type="submit" class="dugme" value="Obrisi grupu">
        </form>
    </div>
    <div class="container-2">
        <form action="grupe_zadaci/kreiraj_zadatak.php">
            <input type="submit" class="dugme" value="Kreiraj zadatak">
        </form>
        <form action="grupe_zadaci/menjaj_zadatak.php">
            <input type="submit" class="dugme" value="Izmeni zadatak">
        </form>
        <form action="grupe_zadaci/obrisi_zadatak.php">
            <input type="submit" class="dugme" value="Obrisi zadatak">
        </form>
        <form action="grupe_zadaci/pronadji_zadatak.php">
            <input type="submit" class="dugme" value="Pronadji zadatak">
        </form>
        <div class="container-3">
            <?php if (isset($_GET['uspesnokreiranje'])): ?>
                                <p class="uspesno" id="poruka">Uspesno ste dodali zadatak!</p>
            <?php elseif (isset($_GET['neuspesnokreiranje'])): ?>
                                <p class="neuspesno" id="poruka">Neuspesno dodavanje zadatka!</p>
            <?php endif ?> 
        </div>
    </div>
    <div class="container-4">
        <?php foreach ($sviZadaci as $zadatak): ?>
            <div class="zadatak">
                <span class="lista-zadataka"><?= $zadatak->naslov ?></span>
                |
                <span class="lista-zadataka"><?= $zadatak->opis_zadatka ?></span>
                |
                <span class="lista-zadataka"><?= $zadatak->rok_izvrsenja ?></span>   
                |
                <?php if ($zadatak->otkazan !== NULL): ?>
                    <span class="lista-zadataka">Zadatak otkazan</span>
                <?php elseif ($zadatak->zavrsen !== NULL): ?>
                    <span class="lista-zadataka">Zadatak zavrsen</span>
                <?php else: ?>
                    <form action="../logika/zavrsen_zadatak.php" method="post" class="dugme-tip-forma">
                        <input type="hidden" name="id_zadatka" value="<?= $zadatak->id ?>">
                        <input type="submit" value="ZAVRSI" class="dugme-tip-zadatka">
                    </form> 
                    |
                    <form action="../logika/otkazan_zadatak.php" method="post" class="dugme-tip-forma">
                        <input type="hidden" name="id_zadatka" value="<?= $zadatak->id ?>">
                        <input type="submit" value="OTKAZI" class="dugme-tip-zadatka">
                    </form>
                <?php endif ?>    
            </div>
                <?php foreach ($sviKomentari as $komentar): ?>
                    <?php if ($zadatak->id === $komentar->id_zadatka): ?>
                        <div class="komentari">
                            <p><?= $komentar->sadrzaj ?></p>
                            <form action="../logika/obrisi_komentar.php" method="post" class="obrisi-komentar">
                                <input type="hidden" name="komentar_id" value="<?= $komentar->id ?>">
                                <input type="submit" value="OBRISI" class="dugme-obrisi">
                            </form>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
                <form action="../logika/dodaj_komentar.php" method="post" class="dodaj-komentar" id="dodaj-komentar">
                    <input type="hidden" name="id_zadatka" value="<?= $zadatak->id ?>">
                    <textarea name="sadrzaj_novog_komentara" cols="30" rows="3" required id="area"></textarea>
                    <input type="submit" value="DODAJ KOMENTAR" class="dugme-dodaj">
                </form>
                <hr>
        <?php endforeach ?>
    </div>
    <script>
        window.onload = function() {
            var poruka = document.getElementById("poruka");
            poruka.style.display = "block";

            setTimeout(function() {
                poruka.style.display = "none";
                }, 2500);
            };
    </script>
</body>
</html>