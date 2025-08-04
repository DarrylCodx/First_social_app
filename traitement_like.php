<?php
    $user = $_GET['id_user'];
    $id_an = $_GET['id_post'];
    $etat = $_GET['vl'];
    /*$var = $_GET['var'];
    echo $var;
    die;*/
    try{
        $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
    }
    catch(Exception $e){
        die('Erreur: '.$e->getMessage());
    }
    $requete_like = $db->prepare('SELECT * FROM liker WHERE id_an = :id_an AND id_user = :id_user');
    $requete_like->execute(array(
        'id_user' => $user,
        'id_an' => $id_an
    ));
    $donnees_like = $requete_like->fetch();
    if($donnees_like == NULL){
        $insert_like = $db->prepare('INSERT INTO liker (id_liker, id_an, id_user, etat, date_creation, date_modif)
        VALUES (\'\', :id_an, :id_user, :etat,now(), now())');
        $insert_like -> execute(array(
            'id_an' =>$id_an, 
            'id_user' => $user,
            'etat' => $etat
        ));
        if($var=='profil'){
            header("location: profil.php?msg=post_liked!#".$id_an."");
        }
        else{
             header("location: home.php?msg=post_liked!#".$id_an."");
        }
       
    }
    else{
        $insert_like = $db->prepare('UPDATE liker SET etat = :etat WHERE id_an = :id_an AND id_user = :id_user');
        $insert_like->execute(array(
            'etat' => $etat,
            'id_an' =>$id_an,
            'id_user' => $user
        ));
        header("location: home.php?msg=post_disliked!#".$id_an."");
    }
