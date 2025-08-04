<?php

session_start();
if(!isset($_SESSION['id_user'])){
    header("location: index.php");
}

    $sender = $_POST['id_user'];
    $receiver = $_POST['id_receiver'];
    $disc = $_POST['id_disc'];
    $contenu = $_POST['contenu'];
    die($contenu. "," .$sender. ",".$receiver);
    if(!empty($contenu)){
        try{
            $db = new PDO ('mysql:host=localhost; dbname=rs_annonce','root','');
        }
        catch(Exception $e){
            die('Erreur: '.$e->getMessage());
        }
        $insert_message = $db->prepare('INSERT INTO message (id_msg, id_sender, id_receiver, contenu,  id_disc, date)
        VALUES (\'\', :sender, :receiver, :contenu, :id_disc, now())');
        $insert_message -> execute(array(
            'contenu' => $contenu,
            'sender' => $sender,
            'receiver' => $receiver,
            'id_disc'=> $disc
        ));
        /*header("location:discussion.php");*/
        header("location:discussion.php?id_sender=".$sender."&id_receiver=".$receiver);
    }
    else{
       /* header("location:discussion.php");
        header("location:discussion.php?id_sender=<?php echo $sender; ?>&id_receiver=<?php echo $receiver; ?>");*/
        header("location:discussion.php?id_sender=".$sender."&id_receiver=".$receiver);
    }