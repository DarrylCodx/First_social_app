<?php 
    session_start();
    session_destroy();
    try{
        $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
    }
    catch(Exception $e){
            die('Erreur: '.$e->getMessage());
    }
    $updatestate = $db->prepare('UPDATE user SET statut = :statut WHERE id_user = :id_user');
    $updatestate->execute(array(
        'statut' => 0,
        'id_user'=> $_SESSION['id_user']
    ));
     header("location: index.php");
    header("location: index.php");