<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.1/bootstrap-icons-1.11.1/bootstrap-icons.min.css">
    <title>Inscription</title>
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
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 border rounded border-danger pt-3 mb-2 pb-1">
    <h1 class="logo">RS_ANNONCE</h1>
    <form class="form" action="traitement_register.php" method="post">
         <h2 style="padding-bottom: 10px;"><u>FORMULAIRE D'INSCRIPTION</u></h2>
         <p style="font: bold; font-size: 18px">Inscrivez vous pour avoir access au contenu<P>
         <?php 
            if(isset($_GET['msg'])){
                echo '<P style="color: red;" class="message">'.$_GET['msg'];
            }
        ?>
    <div class="infos">       
        <?php 
            if(isset($_GET['msg1'])){
                echo '<P style="color: red;" class="message">'.$_GET['msg1'];
            }
        ?>
        <input type="text" placeholder="NOM:" name="nom"><br>
        <?php 
            if(isset($_GET['msg2'])){
                echo '<P style="color: red;" class="message">'.$_GET['msg2'];
            }
        ?>
        <input type="text" name="prenom" placeholder=" PRENOM:"><br>
        <?php 
            if(isset($_GET['msg3'])){
                echo '<P style="color: red;"class="message">'.$_GET['msg3'];
            }
        ?>
         <input type="text" placeholder="USERNAME:" name="username"><br>
        <?php 
            if(isset($_GET['msg4'])){
                echo '<P style="color: red;" class="message">'.$_GET['msg4'];
            }
        ?>
        <input type="email" placeholder="EMAIL:" name="email"><br>
        <?php 
            if(isset($_GET['msg5'])){
                echo '<P style="color: red;" class="message">'.$_GET['msg5'];
            }
        ?>
        <input type="text" placeholder="TEL:" name="tel"><BR>
        <?php 
            if(isset($_GET['msg6'])){
                echo '<P style="color: red;" class="message">'.$_GET['msg6'];
            }
        ?>
        <input type="password" placeholder="PASSWORD:" name="password"><BR>
        <?php 
            if(isset($_GET['msg7'])){
                echo '<P style="color: red;" class="message">'.$_GET['msg7'];
            }
        ?>
        <span style="color: black;">SEXE: </span><label for="sexe"><span style="color: black; padding-left:5px">M</span></label><input type="radio" name="sexe" value="M">
              <label for="sexe"><span style="color: black;">F</span></label><input type="radio" name="sexe" value="F">
              <br><br><label for="" style="color: black;">PAYS</label>
        <select name="pays" id="pays">
            <option value="+237">cameroun</option>
            <option value="+225">cote d'ivoire</option>
            <option value="+224">Gabon</option>
        </select><br><Br>
        <button type="submit" value="login" class="submit">Sign In</button>
    </div>
    </form>
    <br><a href="index.php" style="text-decoration: none; color:blue;">Vous avez deja un compte? </a>
    </div>
    <div class="col-md-4"></div>
    </div>
</body>
</html>