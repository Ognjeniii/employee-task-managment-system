<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kreiraj grupu</title>
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
          
    </style>
</head>
<body>
    <div class="form-container">
        <form action="../../logika/kreiranje_grupe.php" method="post">
            <label for="">Unesite naziv grupe:</label>
            <input type="text" name="naziv_grupe" placeholder="Naziv grupe:" required>
            <input type="submit" value="KREIRAJ GRUPU" class="dugme">
        </form>
    </div>
</body>
</html>