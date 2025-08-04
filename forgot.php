<!DOCTYPE html>
<html>
    <?php 
        session_start();
       /* if(!isset($_SESSION['id_user'])){
            header("location: index.php");
        }*/
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body{
            background: linear-gradient(#141e30,#253B55);
            height: 100vh;
            display: flex;
            justify-content: center;
        }
        .container{
            width: 600px;
            height: 600px;
            backdrop-filter: blur(5px);
            border: 1px dashed rgba(0, 0, 255, 0.23);
            border-radius: 10%;
            box-sizing: border-box;
            box-shadow: 10px 15px 15px rgba(0, 0, 0, 0.458);
            text-align: center;
            margin-top: 3%;
            padding: 50px;
            color: white;
        }
        .backup h3{
             margin: 20px;
        }
        .backup .text{
            width: 200px;
            margin-left: 30%;
            margin-bottom: 5%;   
        }

        .backup .info input{
            border: none;
            border-bottom: 1px solid white;
            background: transparent;
            width: 80%;
            margin-bottom: 15px;
            color: #fff;
            font-size: 16px;
            text-decoration: none;
        }
        .backup .info label{
            position: relative;
            left: -23%;
            pointer-events: none;
            transition: .5s;
            color: #fff;
        }

        .backup .info input:focus ~ label,
        .backup .info input:valid ~label{
            font-size: 12px;
            color: #03e9f4;
        }

        .backup .submit {
            text-decoration: none;
            color: #03e9f4;
            background: none;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 5%;
        }
        .backup .submit:hover{
            background-color: blue;
            color: white;
        }
        form{
            margin-bottom: 15px;
        }
        .backup2, .compte{
            text-decoration: none;
            color: blueviolet;
            width: 100%;
        }
        .ou{
            margin: 10px;
        }
    </style>
    <title>Forgot_password</title>
</head>
<body>
    <div class="container">
       
            <form class="backup" action="traitement_forgot.php" method="post">
                <img src="image/cadenas-circle-removebg-preview.png" placeholder="image cadenas" width="150px" height="150px">
                <h3>Probleme de connexion?</h3>
                <div class="text">
                    Entrez votre addresse e-mail ou votre numero de telephone, 
                    et nous vous enverrons un lien pour recuperer votre compte.
                </div>
                <?php
                    if (isset($_GET['msg'])) {
                        echo '<P style="color: white; background-color:red;">'.$_GET['msg'];
                    }
                    if (isset($_GET['msg1'])) {
                        echo '<P style="color: white; background-color:red;">'.$_GET['msg1'];
                    }
                ?>
                <div class="info">
                    <?php
                        if(!isset($_GET['backup'])){
                    ?>
                    <label>E-mail ou telephone</label><input type="text" id="backup" name="backup">
                    <?php
                        }
                        if(isset($_GET['backup'])){
                    ?>
                    <label>E-mail ou telephone</label><input type="text" id="backup" name="backup" value="<?php echo $_GET['backup']?>">
                    <?php
                        }
                    ?>
                </div>
                <button type="submit" value="login" class="submit">
                    Envoyer un lien de connexion
                </button>
            </form>
            <a href="renitialiser.php" class="backup2">
                Renitialisez votre mot de passe
            </a><br>
            <div class="ou">----------OU----------</div><br>
            <a class="compte" href="index.php">Creer un compte</a>
    </div>
    
</body>
</html>