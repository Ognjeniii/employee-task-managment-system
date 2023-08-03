<?php
    require_once __DIR__ . '../../../klase/Grupa.php';
    $sveGrupe = Grupa::vratiSve();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izmeni grupu</title>
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
          
        .grupe-select{
            width: 250px;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <form action="../../logika/menjanje_grupe.php" method="post">
            <label>Izaberite grupu koju zelite da promenite:</label>
            <!-- <input type="number" name="id_grupe" placeholder="ID:" required> -->
            <select name="id_grupe" class="grupe-select">
                <?php foreach($sveGrupe as $grupa) : ?>
                    <option value="<?= $grupa->id ?>"><?= $grupa->Naziv_grupe ?></option>
                <?php endforeach ?>
            </select><br>
            <br>
            <label>Unesite novi naslov za grupu:</label>
            <input type="text" name="novi_naslov" placeholder="Naslov:" required>
            <input type="submit" class="dugme" value="IZMENI">
        </form>
    </div>
</body>
</html>