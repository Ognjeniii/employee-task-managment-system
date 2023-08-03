<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
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

        .dugme-registracija{
            width: 150px;
            height: 30px;
            font-family: 'Montserrat', sans-serif;
            background-color: #009FBD;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border-radius: 5px;
        }
        
        .datum-rodjenja{
            width: 120px;
        }

        .dugme-registracija:hover{
            background-color: #19376D;
            color: #fff;
        }

        .error{
            font-family: arial, sans-serif;
            color: red;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="logika/registrujse.php" method="post">
            <label>Unesite korisnicko ime:</label>
            <input type="text" name="korisnicko_ime" placeholder="Korisnicko ime:" required><br>
            <label>Unesite lozinku:</label>
            <input type="password" name="lozinka" placeholder="Lozinka:" required><br>
            <label>Ponovite lozinku:</label>
            <input type="password" name="ponovljena_lozinka" placeholder="Ponovljena lozinka:" required><br>
            <label>Unesite ime i prezime:</label>
            <input type="text" name="ime_prezime" placeholder="Ime i prezime:" required><br>
            <label>Unesite email:</label>
            <input type="email" name="email" placeholder="Email:" required><br>
            <label>Unesite broj telefona:</label>
            <input type="text" name="broj_telefona" placeholder="Broj telefona:"><br>
            <label>Unesite datum rodjenja: </label>
            <input type="date" name="datum_rodjenja" class="datum-rodjenja"><br>
            <input type="submit" value="REGISTRUJ SE" class="dugme-registracija">
            <?php if (isset($_GET['error'])): ?>
                    <p class="error">Vec postoji korisnik sa tim korisnickim imenom ili emailom.</p>
            <?php elseif (isset($_GET['lozinka'])): ?>
                    <p class="error">Lozinke se ne podudaraju.</p>
            <?php endif ?>
        </form>    
    </div>
</body>
</html>