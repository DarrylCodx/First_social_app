<?php
    session_start();
    //recuperation du password entree par le user old=old password & new =new password
    $old = $_POST['old'];
    $old_hash = hash('sha256',$old);
    $new = $_POST['new'];
    $new_hash = hash('sha256',$new);
    if(!empty($_POST['old']) and !empty($_POST['new'])){
        try{
            $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
        }
        catch(Exception $e){
                die('Erreur: '.$e->getMessage());
        }
        $requete = $db->prepare('SELECT * FROM USER WHERE id_user = :id_user');
        $requete->execute(array('id_user'=>$_SESSION['id_user']));
        $donnees= $requete->fetch();
        if($donnees['password']==$old_hash){
            $updatepassword = $db->prepare('UPDATE user SET password = :password WHERE id_user = :id_user');
            $updatepassword -> execute(array(
                'password' => $new_hash,
                'id_user' => $_SESSION['id_user']
            ));
            header("location:profil.php?msg=password modifiee avec succes!");
        }
        else{
            header("location:password_modif.php?msg=L'ancien password rempli est incorrect!");
        }
    }
    else{
        header('location:password_modif.php?msg=Entrez toute les informations requises!');
    }
