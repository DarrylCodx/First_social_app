<?php 
    session_start();
    if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0){
        if($_FILES['fichier']['size']<=5000000){
            $infosfichier = pathinfo($_FILES['fichier']['name']);
            $extension = $infosfichier['extension'];
            $extension_valid = array('jpg','png','jpeg','ai');
            if(in_array($extension, $extension_valid)){
                $lien_fichier = 'upload_profil/'.$_SESSION['id_user'].basename($_FILES['fichier']['name']);
                move_uploaded_file($_FILES['fichier']['tmp_name'], $lien_fichier);
                try{
                    $db = new PDO('mysql:host=localhost; dbname=rs_annonce', 'root', '');
                }
                catch(Exception $e){
                    die('Error:' .$e->getMessage());
                }
                $modif_profil = $db->prepare('UPDATE user SET lien_profil = :lien WHERE id_user = :id_user');
                $modif_profil->execute(array(
                    'lien' => $lien_fichier,
                    'id_user'=> $_SESSION['id_user']
                ));
                //die( $lien_fichier);
                $_SESSION['lien_profil']=$lien_fichier;
                header("location:profil.php?msg=Photo de profil modifie avec success!");
            }
            else{
                header("locatin:profil.php?msg=Choisissez une image avec soit jpg, png, ai ou jpeg comme extension s'il vous plait!");
            }
        }
        else{
            header("locatin:profil.php?msg=desole mais l'image choisit pesse plus de 5megas");
        }
    }