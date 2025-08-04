<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
</head>
<style>
        *{
            margin: 0%;
            padding:0%;
            box-sizing: border-box;
            text-align: center;    
        }
        header{
            box-shadow: 0px 0px 15px;
            background-attachment: fixed;
            background-size: contain;
            height: max-content;
            margin-bottom: 20px;
            background: linear-gradient(to left, #ff512f,#dd2476);
        }
        .logo{
            background: linear-gradient(to left, #ff512f,#dd2476);    
        }
        .icone{
            width: 15px;
            height: 10px;
        }
        .options1 a{
            text-decoration: none;
            color: black;
            font-size: 15px;
        }

        .options1{
            width: 20%;
            display: flex;
            justify-content: space-between;
        }
        .options2 a:hover{
            background-color: #198554;
            width: fit-content;
            height: fit-content;
            font-size: 20px;
            padding-left: 5px;
            padding-right: 5px;
            border: 1px solid green;
            border-radius: 80px;
        }
        .options1 .opt:hover{
            background-color: #198554;
            width: fit-content;
            height: fit-content;
            font-size: 13px;
            border: 1px solid green;
            border-radius: 80px;
        }
        .nav1{
            width: 100%;
            text-align: center;
            padding-top: 20px;
            height: max-content;
            background-attachment: fixed;
            display: flex;
            justify-items: flex-end;
            justify-content: space-evenly;
        }
        .nav2 {
            width: 100%;
            text-align: center;
            padding-top: 20px;
            height: max-content;
            background-attachment: fixed;
            display: inline-flex;
            justify-items: flex-end;
            justify-content: space-evenly;
            padding-bottom: 5px;
            padding-bottom: 10px;
        }
        .nav2 a{
            text-decoration: none;
            color: black;
        }
        .options2{
            width: 23%;
            display: inline-flex;
            justify-content: space-between;
        }
</style>
<body>
    <header>
        <nav class="nav1">
            <div class="logo"><h1>RS_ANNONCE</h1></div>
            <div class="options1">
                <a href="register.php" class="opt"><img src="image/contact-removebg-preview.png" alt="icone contact" class="icone">creer mon compte</a>
                <a href="index.php" class="opt"><img src="image/contact-removebg-preview.png" alt="icone contact" class="icone">se connecter</a>
                <button  class="border border-success col-md-4 bg-success rounded-4"><a href="disconnect.php" style="text-decoration: none; color:black;"><i class="bi-box-arrow-left"></i>Log Out</a></button>
            </div>
        </nav>
        <nav class="nav2">
            <div class="options2">|
                <a href="home.php">Home</a>|
                <a href="publier.php">Poste</a>|
                <a href="chat.php">Mailbox</a>|
                <a href="profil.php">Profil</a>|
            </div>
            <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" class="d-flex" role="search" style="width:25%;">
                <input class="form-control me-2" type="search" name="recherche" placeholder="Search a user" aria-label="Search">
                <button class="btn btn-outline-secondary" style="color:black;" type="submit">Search</button>
            </form>
        </nav>
        <?php
                //Initialisation de la variable $resultats
                $result = "";

                //traitement de la requête
                if (isset($_POST['recherche']) && !empty ($_POST['recherche'])) {
                    //on vérifie si l'utilisateur a entré des termes à rechercher, et on traite sa requête

                    //connexion à la base de données
                    try{
                        $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
                    }
                    catch(Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                    $requete =  preg_replace("#[^a-zA-Z ? 0-9]#i", "", $_POST['recherche']);

                    //Requête de sélection MySQL
                    $req = $db->prepare('SELECT *FROM user WHERE nom = :nom UNION  SELECT *FROM user WHERE prenom = :prenom');
                    $req->execute(array(
                        'nom' => $requete , 
                        'prenom' => $requete 
                    ));

                    //On compte les résultats
                    $count = $req->rowCount();

                    //On traite les résultats
                    if ($count >= 1) {
                        //echo "$count résultats trouvés pour <strong> '$query' </strong> \n '$req'";

                        while ($data = $req->fetch()) {
            ?>
            <a href="#" class="row" style="color: white; text-decoration:none;">
                <div class="col-md-2" style="padding-top: 15px;margin-bottom: 15px;"></div>
                <div class="col-md-4" style="padding-top: 15px; border-bottom:1px solid black; margin-bottom: 15px;">
                    <?php
                            if($data['lien_profil'] == 'image'){
                    ?>
                    <i class="bi-person-circle" style="color:black; font-size: 2em;"></i>
                    <?php
                            }
                            else{
                    ?>
                    <img src="<?php echo $data['lien_profil'] ?>" alt="photo profil" class="rounded-circle border border-success" style="width: 45px; height:45px">
                    <?php 
                            }
                            echo '<b>'.$data['nom'].' '.$data['prenom'].'</b>'; 
                    ?>
                </div>
                <div class="col-md-4" style="padding-top: 15px; border-bottom:1px solid black; margin-bottom: 15px;">
                    <!-- Default dropup button -->
                    <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Commentaire</a></li>
              <li><a class="dropdown-item" href="#"> Like</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Discussion</a></li>
            </ul>
          </li>
                </div>
                <div class="col-md-2"></div>
            </a>
            <?php
                        }
                    }
                    else{
                        echo "\n <hr/> No result found for <strong> '$requete' </strong> \n";
                    }
                }
            ?>
    </header>
</body>
</html>