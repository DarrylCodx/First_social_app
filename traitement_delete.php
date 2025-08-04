<?php
    $user= $_GET['id'];
    //die($user);
    try{
       $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
    }
    catch(Exception $e){
       die('Erreur: '.$e->getMessage());
    }
    $requete = $db->prepare('DELETE FROM user WHERE  id_user = :user');
    $requete->execute(array('user'=>$user));
    header("location:profil.php?msg=Utilisateur supprime avec success!");