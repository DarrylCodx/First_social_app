<?php
    $user = $_GET['id'];
    $etat = $_GET['f'];
    //die($user);
    try{
       $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
    }
    catch(Exception $e){
       die('Erreur: '.$e->getMessage());
    }
    $requete = $db->prepare('UPDATE user SET etat = :etat WHERE id_user = :user');
    $requete->execute(array(
        'user'=>$user,
        'etat'=> $etat
    ));
    if($etat==0){
        header("location:profil.php?msg=Utilisateur bloque avec success!");
    }
    else{
        header("location:profil.php?msg=Utilisateur debloque avec success!");
    }