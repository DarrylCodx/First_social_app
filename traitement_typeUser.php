<?php
    $user = $_POST['id_user'];
    $typeUser = $_POST['type_user'];
    //die($user);
    if(!empty($user) and !empty($typeUser)){
        try{
            $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
         }
         catch(Exception $e){
            die('Erreur: '.$e->getMessage());
         }
         $requete = $db->prepare('UPDATE user SET type_user = :type_user WHERE id_user = :user');
         $requete->execute(array(
             'type_user'=> $typeUser,
             'user' => $user
         ));
         header("location:profil.php?msg=Type utilisateur modifie avec success!");
    }
    else{
        header("location:profil.php?msg=choississez un type_user!");
    }