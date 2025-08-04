<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
        if(!isset($_SESSION['id_user'])){
            header("location: index.php");
        }
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.1/bootstrap-icons-1.11.1/bootstrap-icons.min.css">
    <title>Boite de reception</title>
</head>
<style>
    .sub_title {
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
        border-bottom: 2px solid black;
    }
    .photo{
        width: 50%;
    }
    .search{
        width: 30%;
    }
    .content{
        text-align: center;
        font-size: 30px;
    }
</style>
<body>
    <div class="row">
        <?php
            require_once('navbar.php');
        ?>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-sm-8 bg-light">
            <div class="row mb-1" style="background-color: grey; color: white;">
                <h1>DISCUSSIONS AND MESSAGES</h1>
            </div> 
            <div class="sub_title">
                <div class="photo">
                    <?php
                        try{
                            $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
                        }
                        catch(Exception $e){
                            die('Erreur: '.$e->getMessage());
                        }
                        /*afficher le nom des user*/
                        $requete_user = $db->prepare('SELECT *FROM user WHERE id_user = :user');
                        $requete_user->execute(array(
                            'user' => $_SESSION['id_user']
                        ));
                        while($donnees_user = $requete_user->fetch()){
                        if($donnees_user['lien_profil'] == 'image'){
                    ?>
                    <i class="bi-person-circle" style="color:black; font-size: 2em;"></i>
                    <?php
                        }
                        else{
                    ?>
                    <img src="<?php echo $donnees_user['lien_profil'] ?>" alt="photo profil" class="rounded-circle border border-success" style="width: 45px; height:45px">
                    <?Php
                            }
                        }
                    ?>
                    <?php echo '<b style="font-size:25px;">'.$_SESSION['nom'].' '.$_SESSION['prenom']. '</b>'; ?>
                </div>
                 
                <div class="search">
                    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" class="d-flex" role="search">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search a user" aria-label="Search">
                        <button class="btn btn-outline-secondary" style="color:black;" type="submit">Search</button>
                    </form>
                </div>
                <i class="bi-pencil-square" style="color:black; font-size: 2em;" data-bs-toggle="offcanvas" data-bs-target="#comment" aria-controls="offcanvasRight"></i>
                <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="comment" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header" style="border-bottom: 2px solid black; background: linear-gradient(to left, #ff512f,#dd2476);">
                        <h3 class="offcanvas-title" id="comment"><b>Create new discussions</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body bg-light" >
                        <?php 
                            $requete_user2 = $db->query('SELECT *FROM user');
                            //require_once('selectAllUser.php');
                            while($donnees_user2 = $requete_user2->fetch()){
                                if($donnees_user2['id_user']!=$_SESSION['id_user']){
                        ?>
                        <a href="discussion.php?id_sender=<?php echo $_SESSION['id_user']; ?>&id_receiver=<?php echo $donnees_user2['id_user']; ?>" class="row" style="background-color: grey; color: white; text-decoration:none;">
                            <div class="col-md-7" style="padding-top: 15px; border-bottom:1px solid black">
                                <?php
                                        //if($donnees_user['id_user']==$donnees_user2['id_user']){
                                        if($donnees_user2['lien_profil'] == 'image'){
                                ?>
                                <i class="bi-person-circle" style="color:black; font-size: 2em;"></i>
                                <?php
                                            }
                                            else{
                                ?>
                                <img src="<?php echo $donnees_user2['lien_profil'] ?>" alt="photo profil" class="rounded-circle border border-success" style="width: 45px; height:45px">
                                <?php 
                                            }
                                            echo '<b>'.$donnees_user2['nom'].' '.$donnees_user2['prenom'].'</b>'; 
                                ?>
                            </div>
                            <div class="col-md-5" style="padding-top: 15px; border-bottom:1px solid black;">
                                <?php
                                    if($donnees_user2['statut']==1){
                                        echo '<b style="color: greenyellow;"> Online </b>';
                                    }
                                    else{
                                        echo '<b>Last seen on</b><br>'.$donnees_user2['date_modif'].'';
                                    }
                                ?>
                            </div>
                        </a>
                        <?php 
                                }
                            }
                            $requete_user2->closeCursor();
                        ?>
                    </div>
                </div>   
            </div>

            <?php
                //configuration de l'outil de recherche 
                    
                //Initialisation de la variable $resultats
                $resultats = "";

                //traitement de la requête
                if (isset($_POST['search']) && !empty ($_POST['search'])) {
                    //on vérifie si l'utilisateur a entré des termes à rechercher, et on traite sa requête

                    //connexion à la base de données
                    try{
                        $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
                    }
                    catch(Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                    $query =  preg_replace("#[^a-zA-Z ? 0-9]#i", "", $_POST['search']);

                    //Requête de sélection MySQL
                    $req = $db->prepare('SELECT *FROM user WHERE nom = :nom UNION  SELECT *FROM user WHERE prenom = :prenom');
                    $req->execute(array(
                        'nom' => $query , 
                        'prenom' => $query 
                    ));

                    //On compte les résultats
                    $count = $req->rowCount();

                    //On traite les résultats
                    if ($count >= 1) {
                        //echo "$count results found for  <strong> '$query' </strong> \n '$req'";

                        while ($data = $req->fetch()) {
            ?>
            <?php //Display of the search result with possibility to start a new convesation with someone?>
            <a href="discussion.php?id_sender=<?php echo $_SESSION['id_user']; ?>&id_receiver=<?php echo $data['id_user']; ?>" class="row" style="background-color: grey; color: white; text-decoration:none;">
            <?php //echo $_SESSION['id_user'].' '.$data['id_user']?>
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
                    <?php
                        if($data['statut']==1){
                            echo '<b style="color: greenyellow;"> Online </b>';
                        }
                        else{
                            echo '<b>Last seen on</b><br>'.$data['date_modif'].'';
                        }
                    ?>
                </div>
                <div class="col-md-2"></div>
            </a>
            <?php
                        }
                    }
                    else{
                        echo "\n <hr/> No result found for <strong> '$query' </strong> \n";
                    }

                }
                else{
                    echo "\n <hr/> To search a user please fill in the empty field! <br> \n";
                }
            ?>

            <?php // list des discussion deja ouvert discussion ?>

            <div class="row mb-1" style="background-color: grey; color: white;">
                <h3>Recently contacted</h3>
            </div>
            <?php
                        $requete_discussion = $db->prepare('SELECT *FROM discussion WHERE id_sender = :sender');
                        $requete_discussion->execute(array(
                            'sender' => $_SESSION['id_user']
                        ));
                        while($donnees_discussion = $requete_discussion->fetch()){
                        if($donnees_discussion['id_sender']==$_SESSION['id_user']){
                            $requete_discussionUser = $db->prepare('SELECT *FROM user WHERE id_user = :id_user');
                            $requete_discussionUser->execute(array(
                                'id_user' => $donnees_discussion['id_receiver']
                            ));
                            $donnees_discussionUser = $requete_discussionUser->fetch();
            ?>
            <a class="row" href="discussion.php?id_sender=<?php echo $_SESSION['id_user']; ?>&id_receiver=<?php echo $donnees_discussionUser['id_user']; ?>" style="color: black; text-decoration:none;">
                <div class="col-md-2" ></div>
         
                <div class="col-md-6" style="padding-top: 15px; border-bottom: 2px solid grey;">
                    <?php
                        if($donnees_discussionUser['lien_profil'] == 'image'){
                    ?>
                    <i class="bi-person-circle" style="color:black; font-size: 2em;"></i>
                    <?php
                        }
                        else{
                    ?>
                    <img src="<?php echo $donnees_discussionUser['lien_profil'] ?>" alt="photo profil" class="rounded-circle border border-success" style="width: 45px; height:45px">
                    <?php 
                        }
                    ?>
                            
                    <?php
                        echo '<b>'.$donnees_discussionUser['nom'].' '.$donnees_discussionUser['prenom'].'</b>';  
                        //echo '<p>'.$donnees_comment['contenu'].'</p>';
                    ?>
                </div>
                <div class="col-md-3" style="padding-top: 15px; border-bottom: 2px solid grey;">
                    <?php
                        if($donnees_discussionUser['statut']==1){
                            echo '<b style="color: green;"> Online </b>';
                        }
                        else{
                            echo '<b>Last seen on</b><br>'.$donnees_discussion['date'].'';
                        }
                    ?>
                </div>
                <div class="col-md-2"></div>
            </a>
            <?php
                            }
                        }
            ?>
</div>
        </div>
        <div class="col-md-2    "></div>
    </div>


    <script src="javascript/bootstrap.bundle.min.js"></script>
</body>
</html>