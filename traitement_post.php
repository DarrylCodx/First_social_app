<?php
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $user = $_POST['id_user'];
    if(!empty($titre) AND !empty($contenu) AND !empty($user)){
        if(isset($_FILES['fichier']) AND $_FILES['fichier']['error']==0){
            if($_FILES['fichier']['size']<=5000000){
                $infosfichier = pathinfo($_FILES['fichier']['name']);
                $extension = $infosfichier['extension'];
                $extension_valid = array('jpg','png','jpeg');
                if(in_array($extension, $extension_valid)){
                    $lien_fichier = 'upload_post/'.$_SESSION['id_user'].basename($_FILES['fichier']['name']);
                    move_uploaded_file($_FILES['fichier']['tmp_name'], $lien_fichier);
                    try{
                        $db = new PDO ('mysql:host=localhost; dbname=rs_annonce','root','');
                    }
                    catch(Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                    $insertPost = $db->prepare('INSERT INTO annonce (id_an, titre_an, contenu_an, date_pub, date_modif, id_user, lien_image)
                    VALUES (\'\', :titre, :contenu, now(), now(), :id_user, :lien_image)');
                    $insertPost -> execute(array(
                        'titre' =>$titre, 
                        'contenu' => $contenu,
                        'id_user' => $user,
                        'lien_image'=> $lien_fichier
                    ));
                    header("location:home.php?msg=Your publication has being successfully posted!");
                }
                else{
                    header("location:home.php?msg=Choose an image please!");
                }
            }
        }
        else{
            $lien_fichier = "upload_post/post.jpeg";
            try{
                $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
            }
            catch(Exception $e){
                    die('Erreur: '.$e->getMessage());
            }
            $insertPost = $db->prepare('INSERT INTO annonce (id_an, titre_an, contenu_an, date_pub, date_modif, id_user, lien_image)
            VALUES (\'\', :titre, :contenu, now(), now(), :id_user, :lien_image)');
            $insertPost -> execute(array(
                'titre' =>$titre, 
                'contenu' => $contenu,
                'id_user' => $user,
                'lien_image'=> $lien_fichier
            ));
            header("location:home.php?msg=Your publication has being successfully posted!");
        }
    }
    else{
        header("location: accueil.php?msg=Fill in all the required fields");
    }