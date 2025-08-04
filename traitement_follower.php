<?php
    $suiveur = $_GET['id_suiveur'];
    $suivie = $_GET['id_suivie'];
    $etat = $_GET['vl'];
    try{
        $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
    }
    catch(Exception $e){
        die('Erreur: '.$e->getMessage());
    }
    $requete_follow = $db->prepare('SELECT * FROM follower WHERE id_suiveur = :suiveur AND id_suivie = :suivie');
    $requete_follow->execute(array(
        'suiveur' => $suiveur,
        'suivie' => $suivie
    ));
    $donnees_follow = $requete_follow->fetch();
    if($donnees_follow == NULL){
        $insert_follow = $db->prepare('INSERT INTO follower (id_follow, id_suiveur, id_suivie, etat, date)
        VALUES (\'\', :suiveur, :suivie, :etat, now())');
        $insert_follow -> execute(array(
            'suiveur' => $suiveur,
            'suivie' => $suivie,
            'etat' => $etat
        ));
        header("location: home.php?msg=user follow!#".$id_an."");
    }
    else{
        $insert_follow = $db->prepare('UPDATE follower SET etat = :etat WHERE id_suiveur = :suiveur AND id_suivie = :suivie');
        $insert_follow->execute(array(
            'etat' => $etat,
            'suiveur' => $suiveur,
            'suivie' => $suivie
        ));
        header("location: home.php?msg=user unfollow!#".$id_an."");
    }