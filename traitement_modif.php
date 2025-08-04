<?php
    session_start();
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $sexe = $_POST['sexe']; 
    if(!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['tel'])  and !empty($_POST['sexe'])){
        try{
            $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
        }
        catch(Exception $e){
                die('Erreur: '.$e->getMessage());
        }

        $updateUser = $db->prepare('UPDATE user SET nom = :nom, prenom = :prenom, telephone = :tel, sexe = :sexe WHERE id_user = :id_user');
        $updateUser -> execute(array(
            'nom' => $nom, 
            'prenom' => $prenom,
            'tel' => $tel,
            'sexe' => $sexe,
            'id_user' => $_SESSION['id_user']
        ));
        $_SESSION['nom']= $nom;
        $_SESSION['prenom']= $prenom;
        $_SESSION['telephone']= $tel;
        $_SESSION['sexe']= $sexe;
        header('location:profil.php?msg= Compte modifie avec success!');
    }
    else{
        header('location:profil.php?msg=Entrez toute les informations requises!');
    }
