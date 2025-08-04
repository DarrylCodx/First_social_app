<!DOCTYPE html>
<html lang="en">
<?php 
 session_start();
 /*if(!isset($_SESSION['id_user'])){
     header("location: index.php");
 }*/
 
?> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>backup_page</title>
    <style>
        .form{
            text-align: center;
            width: 100%;
            height: 370px;
            padding-top: 10px;
            margin-top: 8%;
            box-sizing: border-box;
            border-top: 5px double red;
            border-bottom: 5px double red;
            background-color: white;
        }
        .form h1{
            display: inline-flex;
            text-align: center;
        }
        .rs{
            font-size: 45px;
            border: 1px solid white;
            border-radius: 60px;
            text-align: center;
            background: linear-gradient(to right,#ff512f,#dd2476);
            padding-left: 45px;
            padding-right: 45px;
            padding-top: 5px;
            padding-bottom:5px;
        }
        .code{
            font-size: 16px;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 45px;
            border: none;
            border-radius: 60px;
            outline: none;
            text-align: left;
            background-color: rgba(92, 92, 197, 0.181);
            font-family: 'Times New Roman', Times, serif;
            letter-spacing: 1px;
            text-indent: 35px;
        }
        .code::placeholder{
            color: rgba(0, 0, 0, 0.475);
        }
        .opt{
            text-align: center;
            display: block;
            justify-content: space-between;
        }
        .opt1{
            margin: 10px 5px;
        }
        .opt2 button{
            background: linear-gradient(to right,#ff512f,#dd2476);
            text-transform: uppercase;
            cursor: pointer;
            font-size: 15px;
            color: white;
            border: none;
            border-radius: 60px;
            outline: none;
            padding: 10px 15px;
        }
    </style>
</head>
<body>  
    <form action="traitement_backup.php" method="post" class="form">
        <h1 class="rs">RS_ANNONCE</h1>
        <?php
        if (isset($_GET['msg'])) {
            echo '<P style="color: white; background-color:red">'.$_GET['msg'];
        }
        ?>
        <h3>Entrez le code de recuperation recu</h3>
        <?Php 
            if (!isset($_GET['code'])){
        ?>
        <input type="text" class="code" name="code" id="code" placeholder="code de recuperation">
        <?php
            }
            if (isset($_GET['code'])){
        ?>
        <input type="text" class="code" name="code" id="code" placeholder="code de recuperation" value="<?php echo $_GET['code']?>">
        <?php
            }
        ?>
        <div class="opt">
            <div class="opt1">
                <a href="traitement_forgot.php" style="color:blue;">Renvoyer le code</a>
            </div>
            <div class="opt2">
                <button type="submit" value="login" class="submit">log In</button>
            </div>
        </div> 
    </form>
</body>
</html>