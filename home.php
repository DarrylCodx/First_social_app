<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
       /* $Backup_code=$_SESSION['code'];
        echo $_SESSION['code'];*/
        if(!isset($_SESSION['id_user'])){
            header("location: index.php?msg= sorry data session lost");
        }
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap-icons-1.11.1/bootstrap-icons-1.11.1/bootstrap-icons.min.css">
    <title>home_page</title>
</head>
<style>
    .comment{
        width: 100%;
        text-align: center;
        padding-top: 20px;
        height: max-content;
        background-attachment: fixed;
        display: flex;
        justify-items: flex-end;
        justify-content: space-evenly;
    }
</style>
<body>
    <div class="row">
        <?php 
            include_once('navbar.php');
        ?>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 bg-light">
            <?php 
                if(isset($_GET['msg'])){
                    echo '<p style="color:white; text-align:center; background-color:green;">'. $_GET['msg'].'</p>';
                }
                if(isset($_GET['msg1'])){
                    echo '<p style="color:white; text-align:center; background-color:red;">'. $_GET['msg1'].'</p>';
                }
            ?>
            <form action="traitement_post.php" method="post" class="row bg-white border rounded p-2 m-2" enctype="multipart/form-data">
                <div class="col-md-1">
                    <?php 
                        if($_SESSION['lien_profil'] == 'image'){
                    ?>
                    <i class="bi-person-circle" style="color:black; font-size: 3em;"></i>
                    <?php
                        }
                        else{
                    ?>
                    <img src="<?php echo $_SESSION['lien_profil']?>" alt="photo profil" class="rounded-circle border border-success" style="width: 45px; height:45px">
                    <?php 
                        }
                    ?>
                </div>
                <div class="col-md-7">
                    <input type="text" placeholder="Publications' title " name="titre" class="form-control mb-1">
                    <textarea name="contenu" placeholder="Description of the publication" class="form-control" id="" cols="1" rows="2"></textarea>
                </div>
                <div class="col-md-4">
                    <div class="modal-body">
                        <input type="file" class="form-control" name="fichier" id="fichier">                   
                    </div>
                    <input type="hidden" name="id_user" id="" value="<?php echo $_SESSION['id_user']; ?>">
                    <DIV class="d-grid gap-2 mb-2 mt-2">
                        <button type="submit" class="btn btn-outline-success">Post</button>
                    </DIV> 
                </div>
            </form>
            <?php 
                try{
                    $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
                }
                catch(Exception $e){
                    die('Erreur: '.$e->getMessage());
                }
                $requete_post = $db->query('SELECT *FROM annonce ORDER BY date_pub DESC');
                while($donnees_post = $requete_post->fetch()){
                    $requete_user = $db->prepare('SELECT *FROM user WHERE id_user = :user');
                    $requete_user->execute(array(
                        'user' => $donnees_post['id_user']
                    ));
                    while($donnees_user = $requete_user->fetch()){
            ?>
            <div class="card m-2" id= <?php echo $donnees_post['id_an']; ?> style="background: linear-gradient(to left, #ff512f,#dd2476);">
                <img src="<?php echo $donnees_post['lien_image']; ?>"  class="card-img-top " alt="Image annonce" style="height: 400px;">
                <div class="card-body">
                    <div style="background: linear-gradient(to left,#dd2476,#ff512f);  width:100%; color:white; padding-left: 10px;" class="border border-success rounded-4 pt-1 pb-1">
                        <?php
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
                        ?>
                        <?php 
                            echo $donnees_user['nom'].' '.$donnees_user['prenom']; 
                            if($donnees_user['id_user']!=$_SESSION['id_user']){
                        ?>
                        <button  class="btn btn-outline-success rounded-4" style="margin-left: 50%;">
                            <?php
                                $requete_follow = $db->prepare('SELECT *FROM follower WHERE id_suiveur = :suiveur AND id_suivie = :suivie');
                                $requete_follow->execute(array(
                                    'suiveur' => $_SESSION['id_user'],
                                    'suivie' => $donnees_user['id_user']
                                ));
                                $donnees_follow = $requete_follow->fetch();
                                    if($donnees_follow == NULL){
                            ?><?php //ici cest paris ?>
                            <a href="traitement_follower.php?vl=1&id_suiveur=<?php echo $_SESSION['id_user']; ?>&id_suivie=<?php echo $donnees_user['id_user']; ?>" class="" style="text-decoration: none; color:black"><i class="bi-plus">Follow</i></a>
                            <?php 
                                    }
                                    else{
                                        if($donnees_follow['etat']==0){
                            ?>
                            <a href="traitement_follower.php?vl=1&id_suiveur=<?php echo $_SESSION['id_user']; ?>&id_suivie=<?php echo $donnees_user['id_user']; ?>" class="" style="text-decoration: none; color:black"><i class="bi-plus">Follow</i></a>
                            <?php
                                        }
                                        else{
                            ?>
                            <a href="traitement_follower.php?vl=0&id_suiveur=<?php echo $_SESSION['id_user']; ?>&id_suivie=<?php echo $donnees_user['id_user']; ?>" class="" style="text-decoration: none; color:black"><i class="bi-plus">Unfollow</i></a>
                            <?php
                                        }
                                    }
                            ?>
                        </button>
                        <?php 
                                }
                                else{
                        ?>
                        <button  class="btn btn-success rounded-4" style="margin-left: 50%;"><a href="profil.php" style="text-decoration:none; color: black;">Profil</a></button>
                        <?php 
                                }
                        ?>

                    </div>
                    <h5 class="card-title"><?php echo $donnees_post['titre_an']; ?></h5>
                    <p class="card-text"><?php echo $donnees_post['contenu_an']; ?></p>

                    <?php //gerer les like et les unlike ?>
                    <?php
                        $requete_like = $db->prepare('SELECT *FROM liker WHERE id_user = :user AND id_an = :id_an');
                        $requete_like->execute(array(
                            'user' => $_SESSION['id_user'],
                            'id_an' => $donnees_post['id_an']
                        ));
                        $donnees_like = $requete_like->fetch();
                        if($donnees_like == NULL){
                    ?>
                    <a href="traitement_like.php?vl=1&id_user=<?php echo $_SESSION['id_user']; ?>&id_post=<?php echo $donnees_post['id_an']; ?>" ><i class="bi-heart-fill" style="padding-left: 5px; color:white;"></i></a>
                    <?php
                        }
                        else{
                            if($donnees_like['etat']==0){
                    ?>
                    <a href="traitement_like.php?vl=1&id_user=<?php echo $_SESSION['id_user']; ?>&id_post=<?php echo $donnees_post['id_an']; ?>" class=""><i class="bi-heart-fill" style="padding-left: 5px; color:white;"></i></a>
                    <?php
                            }
                            else{
                    ?>
                    <a href="traitement_like.php?vl=0&id_user=<?php echo $_SESSION['id_user']; ?>&id_post=<?php echo $donnees_post['id_an']; ?>" class=""><i class="bi-heart-fill" style="padding-left: 5px; color:darkred;"></i></a>
                    <?Php
                            }
                        }
                        $requete_nb_like = $db->prepare('SELECT COUNT(*) AS nb_like FROM liker WHERE id_an = :id_an AND etat =1');
                        $requete_nb_like->execute(array(
                            'id_an' => $donnees_post['id_an']
                        ));
                        $donnees_nb_like = $requete_nb_like->fetch();
                        echo '<b> '.$donnees_nb_like['nb_like'].'</b> ';
                    ?>

                    <?php //bouton commentaire ?>
                    <i  class="bi-chat" style="color:white; margin-left:15px; text-decoration:none;" data-bs-toggle="offcanvas" data-bs-target="#comment<?php echo $donnees_post['id_an']?>" aria-controls="offcanvasWithBothOptions"></i>
                    <?php 
                        $requete_nb_comment = $db->prepare('SELECT COUNT(*) AS nb_comment FROM comment WHERE id_an = :id_an');
                        $requete_nb_comment->execute(array(
                            'id_an' => $donnees_post['id_an']
                        ));
                        $donnees_nb_comment = $requete_nb_comment->fetch();
                        echo '<b style="margin-right:15px;"> '.$donnees_nb_comment['nb_comment'].'</b> ';
                    ?>

                    
                    <?php //afficher commentaire ?>
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="comment<?php echo $donnees_post['id_an']?>" aria-labelledby="offcanvasWithBothOptionsLabel">
                        <div class="offcanvas-header" style="border-bottom: 2px solid black; background: linear-gradient(to left, #ff512f,#dd2476);">
                            <h1 class="offcanvas-title" id="comment<?php echo $donnees_post['id_an']?>">Comments</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body bg-light" >
                            <div class="row">
                                <?php
                                    $requete_comment = $db->prepare('SELECT *FROM comment WHERE id_an = :id_an');
                                    $requete_comment->execute(array(
                                        'id_an' => $donnees_post['id_an']
                                    ));
                                    while($donnees_comment = $requete_comment->fetch()){
                                        $requete_commentUser = $db->prepare('SELECT *FROM user WHERE id_user = :id_user');
                                        $requete_commentUser->execute(array(
                                            'id_user' => $donnees_comment['id_user']
                                        ));
                                        $donnees_commnentUser = $requete_commentUser->fetch();
                                ?>
                                <div class="col-md-1" style="padding-top: 15px; border-bottom: 2px solid grey;">
                                    <?php
                                            if($donnees_commnentUser['lien_profil'] == 'image'){
                                    ?>
                                    <i class="bi-person-circle" style="color:black; font-size: 2em;"></i>
                                    <?php
                                            }
                                            else{
                                    ?>
                                    <img src="<?php echo $donnees_commnentUser['lien_profil'] ?>" alt="photo profil" class="rounded-circle border border-success" style="width: 45px; height:45px">
                                    <?php 
                                            }
                                    ?>
                                </div>
                                <div class="col-md-6" style="padding-top: 15px; border-bottom: 2px solid grey;">
                                    <?php
                                            echo '<b>'.$donnees_commnentUser['nom'].' '.$donnees_commnentUser['prenom'].'</b>';  
                                            echo '<p>'.$donnees_comment['contenu'].'</p>';
                                    ?>
                                </div>
                                <div class="col-md-5" style="padding-top: 15px; border-bottom: 2px solid grey;">
                                    <?php
                                                echo ''.$donnees_comment['date_modif'].'';
                                    ?>
                                </div>
                                <?Php
                                        }
                                    $requete_comment->closeCursor();
                                ?>
                            </div>
                        </div>

                        <?php //publier un commentaire ?>
                        <footer class="row">
                            <form action="traitement_comment.php" method="post" class="row p-1" style="background: linear-gradient(to left, #ff512f,#dd2476);">
                                <div class="col-md-4">
                                    <?php 
                                        if($_SESSION['lien_profil'] == 'image'){
                                    ?>
                                    <i class="bi-person-circle" style="color:black; font-size: 3em;"></i>
                                    <?php
                                        }
                                        else{
                                    ?>
                                    <img src="<?php echo $_SESSION['lien_profil']?>" alt="photo profil" class="rounded-circle border border-success" style="width: 45px; height:45px">
                                    <?php 
                                        }
                                        echo '<br><b style="color:black; padding-left :5px;">'.$_SESSION['nom'].' '.$_SESSION['prenom'].'</b>';
                                    ?>
                                </div>
                                <div class="col-md-7">
                                    <textarea name="contenu" placeholder="Comment the post" class="form-control" id="" cols="1" rows="1"></textarea>
                                    <input type="hidden" name="id_user" id="" value="<?php echo $_SESSION['id_user']; ?>">
                                    <input type="hidden" name="id_an" id="" value="<?php echo $donnees_post['id_an']; ?>">
                                    <DIV class="d-grid gap-2 mb-2 mt-2">
                                        <button type="submit" class="btn btn-outline-success">Comment</button>
                                    </DIV> 
                                </div>
                                <div class="col-md-1"></div>
                            </form>
                        </footer>
                    </div>
                    <a href="#" class="" style="color:white;"><i class="bi-send-fill" style="padding-left: 10px; padding-right:5px;"></i></a>
                    <a href="#" class="" style="text-decoration: none; color:black;"><i style="padding-left: 35%; padding-right:5px;">Date publication:<?php echo " ".$donnees_post['date_pub']; ?></i></a>
                </div>
            </div>
            <?php
                        }
                   $requete_user->closeCursor();
                }
                $requete_post->closeCursor();
            ?>
        </div>
        <div class="col-md-3"></div>
    </div>
    <?php /*<button  class="col-sm-2 border border-primary p-1 bg-primary rounded-4"><a href="disconnect.php" style="text-decoration: none; color:black;">Log Out</a></button>*/?>
    
    
    <script src="javascript/bootstrap.bundle.min.js"></script>
</body>
</html>