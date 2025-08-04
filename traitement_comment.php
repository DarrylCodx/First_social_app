<?php

session_start();
if(!isset($_SESSION['id_user'])){
    header("location: index.php");
}

    $contenu = $_POST['contenu'];
    $user = $_POST['id_user'];
    $id_an = $_POST['id_an'];
    if(!empty($contenu)){
        try{
            $db = new PDO ('mysql:host=localhost; dbname=rs_annonce','root','');
        }
        catch(Exception $e){
            die('Erreur: '.$e->getMessage());
        }
        $insert_comment = $db->prepare('INSERT INTO comment (id_com, contenu, date_creation, date_modif, id_user, id_an)
        VALUES (\'\', :contenu, now(), now(), :id_user, :id_an)');
        $insert_comment -> execute(array(
            'contenu' => $contenu,
            'id_user' => $user,
            'id_an'=> $id_an
        ));
        header("location:home.php?msg=Your comment has being successfully posted!#".$id_an."");
    }
    else{
        header("location:home.php?msg1=Please fill in the empty space provided for the comment");
    }