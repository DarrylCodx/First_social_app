<!DOCTYPE html>
<html lang="en">
<?
session_start();
if(!isset($_SESSION['id_user'])){
    echo 'see' .$_SESSION['id_user'];
    header("location: index.php");
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>renitialiser</title>
    <style>
        *{
            margin: 0%;
            padding:0%;
            box-sizing: border-box;
            text-align: center;
        }
         h1{
            display: inline-flex;
            text-align: center;
        }
        .logo{
            text-align: center;
            margin-top: 2%;
            margin-bottom: 20px;
            font-size: 50px;
            color: rgb(2, 2, 69);
            border: 1px solid white;
            border-radius: 60px;
            text-align: center;
            background: linear-gradient(to right,#ff512f,#dd2476);
            padding-left: 55px;
            padding-right: 55px;
            padding-top: 5px;
            padding-bottom:5px;
        }
        .form{
            text-align: center;
            width: 100%;
        }
        .infos{
            display: inline-block;
            flex-direction: column;   
        }
        .infos input {
            font-size: 16px;
            margin: 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 60px;
            outline: none;
            text-align: left;
            background-color: rgba(92, 92, 197, 0.181);
            font-family: 'Times New Roman', Times, serif;
            letter-spacing: 1px;
            text-indent: 35px;
        }
        .infos button{
            font-size: 16px;
            margin: 10px;
            padding: 10px 35px;
            border: none;
            border-radius: 60px;
            outline: none;
            background-color: blue;
            text-transform: uppercase;
            cursor: pointer;
            color: white;
        }

        .info input::placeholder{
            color: rgba(0, 0, 0, 0.475);
        }
    </style>
</head>
<body>
<h1 class="logo">RS_ANNONCE</h1>
    <form class="form" action="traitement_ren.php" method="post">
        <h2 style="padding-bottom: 10px;">Initialisation du nouveau mot de passe!</h2>
        <p style="font: bold; font-size: 18px">Entrez les informations requises!<P>
    <div class="infos">      
        <?php 
            if(isset($_GET['msg1'])){
                echo '<P style="color: red;"class="message">'.$_GET['msg1'];
            }
        ?>
        <input type="text" placeholder="USERNAME:" name="username"><br> 
        <?php 
            if(isset($_GET['msg2'])){
                echo '<P style="color: red;" class="message">'.$_GET['msg2'];
            }
        ?>
        <input type="email" placeholder="EMAIL:" name="email"><br>
        <?php 
            if(isset($_GET['msg3'])){
                echo '<P style="color: red;" class="message">'.$_GET['msg3'];
            }
        ?>
        <input type="password" placeholder="Nouveau mot de pass:" name="password"><BR>
        <button type="submit" value="login" class="submit">Sign In</button>
    </div>
    </form>
    
    <br><a href="login.php" style="color:blue">Vous avez deja un compte?</a>
</body>
</html>