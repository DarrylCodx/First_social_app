<?php
 //session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    if(empty($_POST["username"])){
        header('location: renitialiser.php?msg1=Entrez votre  username');
    }
    elseif(empty($_POST["email"])){
        header('location: renitialiser.php?msg2=Entrez votre  email');
    }
    elseif(empty($_POST["password"])){
        header('location: renitialiser.php?msg3=Entrez votre  password');
    }
    else{
    session_start();
    $email= $_POST['email'];
    $new = $_POST['password'];
    $new_hash = hash('sha256',$new);
    //echo $_SESSION['id_user'];
    /*echo $email.' and ' .$_SESSION['id_user']. 'AND ' ;
    echo $new;
    die .$new_hash. 'and '.$email; */
    
    if(!empty($_POST['email']) and !empty($_POST['password'])){
        try{
            $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
        }
        catch(Exception $e){
                die('Erreur: '.$e->getMessage());
        }
        $requete = $db->prepare('SELECT * FROM USER WHERE id_user = :id_user');
        $requete->execute(array('id_user'=>$_SESSION['id_user']));
        $donnees= $requete->fetch();
/*        echo $email.' and ' .$_SESSION['id_user']. 'AND ' ;
        echo $new;
        die .$new_hash. 'and '.$email; */
        $updatepassword = $db->prepare('UPDATE user SET password = :password WHERE id_user = :id_user');
        $updatepassword -> execute(array(
            'password' => $new_hash,
            'id_user' => $_SESSION['id_user']
        ));
        header("location:index.php?msg=password modifiee avec succes!");
    }
    else{
        header('location:renitialiser.php?msg=Entrez toute les informations requises!');
    }

    }
    //comment modifier le mot de passe en base de donnees