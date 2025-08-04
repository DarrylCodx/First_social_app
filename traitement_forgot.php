<!DOCTYPE html>
<html lang="en">
    <?Php
        session_start()
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>traitement_forgot</title>
    <style>
        body{
            background: linear-gradient(to left, #ff512f,#dd2476);
            height: 100vh;
            display: flex;
            justify-content: center;
        }
        .logo{
            text-align: center;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            margin-top: 4%;
            margin-bottom: 20px;
            font-size: 50px;
            color: rgb(2, 2, 69);
        }
        .code{
            color: black;
            font-weight: bold;
            font-size: 36px;
            text-decoration: underline;
        }
       .container{
            width: 600px;
            height: 360px;
            backdrop-filter: blur(5px);
            border: 1px dashed rgba(0, 0, 255, 0.23);
            border-radius: 10%;
            box-sizing: border-box;
            box-shadow: 10px 15px 15px rgba(0, 0, 0, 0.458);
            text-align: center;
            margin-top: 5%;
            padding: 50px;
            background: linear-gradient(to right,#ff512f,#dd2476);
        }
        .container p{
            font-size: 25px;
            font-family: 'Times New Roman', Times, serif;
        }
        .submit{
            font-size: 16px;
            padding: 10px 15px;
            border: none;
            border-radius: 60px;
            outline: none;
            text-decoration: none;
            background-color: rgb(2, 2, 69);
            text-transform: uppercase;
            cursor: pointer;
            font-size: 20px;
            color: white;
        }
    </style>
</head>
<body> 
    <?php 
        $backup = $_POST['backup'];
        //$tel = $_POST['backup'];
    ?>
    <div class="container">
        <h1 class="logo">RS_ANNONCE</h1>
        <?Php
            if(isset($_POST['backup'])){
                if(!empty($_POST['backup'])){
                    try{
                        $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
                    }
                    catch(Exception $e){
                            die('Erreur: '.$e->getMessage());
                    }
                    $requete = $db->prepare('SELECT * FROM user WHERE email = :backup1 OR telephone = :backup2');
                    $requete->execute(array(
                        'backup1'=>$backup,
                        'backup2' =>$backup
                    ));
                    $donnees= $requete->fetch();
                    //$test= is_array($donnees);
                    //die($test);
                    if(($donnees['email']==$backup) or ($donnees['telephone']==$backup)){
                        $_SESSION['code']=rand(1000,10000);
                        echo '<p>Utiliser se code pour recuperer votre compte: <p><span  class="code" > '.$_SESSION['code']."</sapn><br><br>";
                    }
                    else{
                        header("location: forgot.php?msg=Utilisateur inexistant");     
                    }
                }
                else{
                    header("location: forgot.php?msg1=Veillez remplis l'information requis");
                }

            }
            else{
                header('location: forgot.php?msg=Desole element non-defini');
            }
        ?>
        <a href="backup.php" class="submit">ok</a>
        </form>
    </div>
</body>
</html>
