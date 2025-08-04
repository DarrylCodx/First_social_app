<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    if(!isset($_SESSION['id_user'])){
        header("location:index.php");
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.1/bootstrap-icons-1.11.1/bootstrap-icons.min.css">
    <title>profil</title>
</head>
<style>
    .infos{
        width: 100%;
        text-align: center;
        display: flex;
        justify-items: flex-end;
        justify-content: space-evenly;
        padding-top: 15px;
    }
</style>
<body>
    <div class="row">
        <div class="">
            <?php
                include_once('navbar.php');
            ?> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 bg-light pt-3">
            <div style="">
                <?php
                    if($_SESSION['lien_profil']=='image'){
                ?>
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#profil">
                        <i class="bi-person-circle" style="color:black; font-size: 120px"></i><br>
                        <span style="color: green; font-weight:bold">Photo profil</span>
                    </button>
                     
 
                    <!-- Modal -->
                    <div class="modal fade" id="profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier la photo de profil</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="traitement_image.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="file" class="form-control" name="fichier" id="fichier">                   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <DIV class="d-grid gap-2 mb-2 mt-2">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </DIV> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?Php 
                    }
                    else{
                ?>
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#profil">
                        <img src="<?php echo $_SESSION['lien_profil']?>" alt="photo profil" class="rounded-circle border border-success" style="width: 150px; height:150px">
                    </button><br>
                    <span style="color: green; font-weight:bold">Photo profil</span>

                    <!-- Modal -->
                    <div class="modal fade" id="profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier la photo de profil</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="traitement_image.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="file" class="form-control" name="fichier" id="fichier">                   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <DIV class="d-grid gap-2 mb-2 mt-2">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </DIV> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    }
                    try{
                        $db = new PDO ('mysql:host=localhost; dbname=rs_annonce','root','');
                    }
                    catch(Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                    //php nombre de post
                    $requete_nb_post = $db->prepare('SELECT COUNT(*) AS nb_post FROM annonce WHERE id_user = :user');
                    $requete_nb_post->execute(array(
                        'user' => $_SESSION['id_user']
                    ));
                    $donnees_nb_post = $requete_nb_post->fetch();
                    echo '<div class="infos"><span class="opt"><p>Posts</p><b>'.$donnees_nb_post['nb_post'].'</b> </span>';

                    //php nombre de follower
                    $requete_nb_follower = $db->prepare('SELECT COUNT(*) AS nb_follower FROM follower WHERE id_suivie = :suivie AND etat =1');
                    $requete_nb_follower->execute(array(
                        'suivie' => $_SESSION['id_user']
                    ));
                    $donnees_nb_follower = $requete_nb_follower->fetch();
                    echo ' <span class="opt"><p>Follower</p><b>'.$donnees_nb_follower['nb_follower'].'</b> </span>';

                    //php nombre de following
                    $requete_nb_following = $db->prepare('SELECT COUNT(*) AS nb_following FROM follower WHERE id_suiveur = :suiveur AND  etat =1');
                    $requete_nb_following->execute(array(
                        'suiveur' => $_SESSION['id_user']
                    ));
                    $donnees_nb_following = $requete_nb_following->fetch();
                        echo '<span class="opt"> <p>Following</p><b>'.$donnees_nb_following['nb_following'].'</b></span></div>';
                ?>             
            </div>
            <div style="text-align: center;">
                    <?php
                        echo '<br>USERNAME: <i>'.$_SESSION['nom'].' '.$_SESSION['prenom'].                    
                        '</i><br>EMAIL: <i>'.$_SESSION['email'].
                        '</i><br>SEXE: <i>'.$_SESSION['sexe'].
                        '</i><br>PHONE: <i>'.$_SESSION['telephone'].'</i>';
                    ?>
            </div>
            <div style="text-align:center;" class="d-grid gap-2 mb-2 mt-2">
                <a href="compte_modif.php"><button class="btn btn-outline-success">Modifier mon compte</button></a>
            </div>
            <div style="text-align:center;" class="d-grid gap-2 mb-2 mt-2">
                <a href="password_modif.php"><button class="btn btn-outline-success">Modifier mon password</button></a>
            </div>
        </div>

        <div class="col-md-8 bg-light">
            <?php 
                if(isset($_GET['msg'])){
                    echo'<p style="color:white; text-align:center; background-color:green;">'.$_GET['msg'].'</p>';
                } 
                require_once('selectAllUser.php');
            ?>
            <?php
                if($_SESSION['type_user']=='admin'){
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nom complet</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Type</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Etat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($donnees = $requete->fetch()){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $donnees['id_user'] ?></th>
                        <td><?php echo $donnees['nom'].' '.$donnees['prenom'] ?></td>
                        <td><?php echo $donnees['email'] ?></td>
                        <td><?php echo $donnees['telephone'] ?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#type_user<?php echo $donnees['id_user']; ?>">
                                <?php echo $donnees['type_user'] ?>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="type_user<?php echo $donnees['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Changer le type d'utilisateur</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="traitement_typeUser.php" method="post">
                                            <div class="modal-body" style="text-align: center;">
                                                <select name="type_user" class="btn btn-outline-primary">
                                                    <option value="">---</option>
                                                    <option value="user">User</option>
                                                    <option value="admin">Admin</option>
                                                </select>                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <div class="d-grid gap-2 mb-2 mt-2">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div> 
                                                <input type="hidden" name="id_user" id="" value="<?php echo $donnees['id_user']; ?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php
                                if($donnees['statut']==1){
                                    echo'<i class="bi-eye-fill" style="font-size:1rem; padding-left:15px; color: black;"></i>';
                                }
                                else{
                                    echo'<i class="bi-eye-slash-fill" style="font-size:1rem; padding-left:15px; color: grey;"></i>';
                                }
                            ?>
                        </td>
                        <td>
                                <?php
                                    if($donnees['etat']==1){
                                       echo'<i class="bi-unlock" style="font-size:1rem; color: grey;"></i>';
                                    }
                                    else{
                                        echo'<i class="bi-lock" style="font-size:1rem; color: black;"></i>';
                                    }
                                ?>
                            </td>
                        <td>
                            <?php
                                if($donnees['etat']==1){
                            ?>
                            <a href="traitement_lock.php?id=<?php echo $donnees['id_user']?>&f=0"><i class="bi-lock" style="font-size:1rem; color: violet;"></i></a>                                
                            <?php
                                }
                                else{
                            ?>
                            <a href="traitement_lock.php?id=<?php echo $donnees['id_user']?>&f=1"><i class="bi-unlock" style="font-size:1rem; color: primary;"></i></a>
                            <?php
                                }
                                if($donnees['id_user']==$_SESSION['id_user']){
                            ?>
                            <button type="button" class="btn"><a href="#"><i class="bi-trash" style="font-size:1rem; color: grey;"></i></a></button>
                            <?php
                                }
                                else{
                            ?>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete<?php echo $donnees['id_user']?>">
                                <a href="#"><i class="bi-trash" style="font-size:1rem; color: red;"></i></a>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="delete<?php echo $donnees['id_user']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Voulez vous vraiment supprimer l'utilsateur <?php echo $donnees['id_user']?>?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <DIV class="d-grid gap-2 mb-2 mt-2">
                                                <a href="traitement_delete.php?id=<?php echo $donnees['id_user']?>"><button type="submit" class="btn btn-success">Confirmer</button></a>
                                            </DIV> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?Php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <?php 
                }
                else{
            ?>
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
                        if($donnees_post['id_user']==$_SESSION['id_user']){
            ?>
            <h1>Posts and Publications</h1>
            <div class="card m-2" id= <?php echo $donnees_post['id_an']; ?> style="background: linear-gradient(to left, #ff512f,#dd2476);">
                <img src="<?php echo $donnees_post['lien_image']; ?>"  class="card-img-top " alt="Image annonce" style="height: 400px;">
                <div class="card-body">
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
                    <a href="traitement_like.php?vl=1&id_user=<?php echo $_SESSION['id_user']; ?>&id_post=<?php echo $donnees_post['id_an']; ?>&var=profil" ><i class="bi-heart-fill" style="padding-left: 5px; color:white;"></i></a>
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
                        }
                   $requete_user->closeCursor();
                }
                $requete_post->closeCursor();
            ?>
        </div>
        <div class="col-md-3"></div>
    </div>
            <?php   
                }
            ?>
        </div>
    </div>
    <script src="javascript/bootstrap.bundle.min.js"></script>
</body>
</html>