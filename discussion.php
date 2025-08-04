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
    <link rel="stylesheet" href="discussion.css">
    <title>Discussion</title>
</head>
<body>
    <?php 
       // require_once('navbar.php');
    ?>

    <?php 
        $id_sender = $_GET['id_sender'];
        $id_receiver = $_GET['id_receiver'];
        //echo $id_receiver. ' '.$id_sender;
        //die;
        //die($id_sender.' '.$id_receiver);
        //$sender_msg= $_GET['sender'];
        //$receiver_msg = $_GET['receiver'];
        try{
            $db = new PDO ('mysql:host=localhost; dbname=rs_annonce','root','');
        }
        catch(Exception $e){
            die('Erreur: '.$e->getMessage());
        }
        $requete = $db->prepare('SELECT *FROM discussion where id_receiver = :receiver and id_sender = :sender');
        $requete->execute(array(
            'receiver'=>$id_receiver,
            'sender'=>$id_sender    
        ));
       if(array($id_receiver)){
            $value = true;
            echo $value;
        }
        $donnees = $requete->fetch();
        if(is_bool($donnees)){
            //$value=true;
           // echo $value;
            $insert_discussion = $db->prepare('INSERT INTO discussion (id_disc, id_sender, id_receiver, date)
            VALUES (\'\', :sender, :receiver, now())');
            $insert_discussion -> execute(array(
                'sender' => $id_sender,
                'receiver' => $id_receiver
            ));
        }
        elseif(($donnees['id_receiver']==$id_receiver and $donnees['id_sender']==$id_sender )or($donnees['id_receiver']==$id_sender and $donnees['id_sender']==$id_receiver)){    
            header("location:discussion.php");
            echo 'Discussion existant';
          }
        /*else{
            $insert_discussion = $db->prepare('INSERT INTO discussion (id_disc, id_sender, id_receiver, date)
            VALUES (\'\', :sender, :receiver, now())');
            $insert_discussion -> execute(array(
                'sender' => $id_sender,
                'receiver' => $id_receiver
            ));
        }*/
    ?>
    <?Php //body et header de la zone discussion ?>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row mb-1" style="background-color: grey; color: white;">
                <h1>DISCUSSIONS AND MESSAGES</h1>
            </div>
            <div class="row">
                <div class="col-md-2"></div>

                    <?php
                        $requete_discussion = $db->prepare('SELECT *FROM discussion WHERE id_receiver = :receiver');
                        $requete_discussion->execute(array(
                            'receiver' => $id_receiver
                        ));
                        while($donnees_discussion = $requete_discussion->fetch()){
                            $requete_discussionUser = $db->prepare('SELECT *FROM user WHERE id_user = :id_user');
                            $requete_discussionUser->execute(array(
                                'id_user' => $donnees_discussion['id_receiver']
                            ));
                            $donnees_discussionUser = $requete_discussionUser->fetch();
                    ?>
         
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
            </div>

            
            <?php //Zone Message envoye et recu ?>
            <div class="row">
                <div class="col-md-2"></div>
                <?php
                    $requete_message = $db->prepare('SELECT *FROM message WHERE id_receiver = :receiver AND id_sender = :sender');
                    $requete_message->execute(array(
                        'receiver' => $donnees_discussion['id_receiver'],
                        'sender' => $donnees_discussion['id_sender']
                    ));
                ?>
                <div class="col-md-8">
                    <div class="message">
                        <?php
                            while($donnees_message = $requete_message->fetch()){
                                if($_SESSION['id_user']!=$donnees_message['id_sender']){
                                    echo '<p class="messageReceiver">
                                    <br> 
                                    <b style="border-top:2px solid black; margin-top:5px; color: white;">'.$donnees_message['contenu'].'</b><br>'.$donnees_message['date'].'<p>';
                                }
                                if($_SESSION['id_user']==$donnees_message['id_sender']){
                                    echo '<p class="messageSender">
                                    <b style="color: white;">'.$donnees_message['contenu'].'</b><br><span style="border-top: 1px solid black;"> '.$donnees_message['date'].'</span><p>';
                                } 
                            }
                        ?>
                    </div>
                </div>

                <div class="col-md-2"></div>
            </div>
    
            <div class="col-md-1"></div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <?php //ecrire un message ?>
            <footer class="row">
                <div class="col-md-2"></div>

                <div class="col-md-8">
                    <form action="traitement_message.php" method="post" class="row pt-1" style="background: linear-gradient(to left, #ff512f,#dd2476); background-position:fixed;">
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
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
                        <div class="col-md-5">
                            <textarea name="contenu" placeholder="Write a message" class="form-control" id="" cols="1" rows="1"></textarea>
                            <input type="hidden" name="id_user" id="" value="<?php echo $_SESSION['id_user']; ?>">
                            <input type="hidden" name="id_receiver" id="" value="<?php echo $donnees_discussionUser['id_user']; ?>">
                            <input type="hidden" name="id_disc" id="" value="<?php echo $donnees_discussion['id_disc']; ?>">
                            <button type="submit" class="btn btn-outline-success"><i class="bi-send-fill"></i></button> 
                        </div>
                        <div class="col-md-2"></div>
                    </form>
                </div>

                <div class="col-md-2"></div>
            </footer>
            <?Php
                        }
                    $requete_discussion->closeCursor();
            ?>
</body>
</html>