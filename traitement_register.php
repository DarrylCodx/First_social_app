<?php
    session_start();
    $nom =$_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $pays = $_POST['pays'];
    $username = $_POST['username'];
    $password_hash = hash('sha256',$password);
    if(empty($_POST["nom"])){
        header('location: register.php?msg1=Entrez votre Nom');
    }
    elseif(empty($_POST["prenom"])){
        header('location: register.php?msg2=Entrez votre prenom');
    }
    elseif(empty($_POST["username"])){
        header('location: register.php?msg3=Entrez votre username');
    }
    elseif(empty($_POST["email"])){
        header('location: register.php?msg4=Entrez votre email');
    }
    elseif(empty($_POST["tel"])){
        header('location: register.php?msg5=Entrez votre numero  de telephone');
    }
    elseif(empty($password)){
        header('location: register.php?msg6=Entrez votre password');
    }
    elseif(empty($_POST["sexe"])){
        header('location: register.php?msg7=choissisez votre sexe');
    }
    else{
        try{
            $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
        }
        catch(Exception $e){
            die('Error: '.$e->getMessage());
        }
        $requete = $db->prepare('SELECT *FROM user WHERE email= :email');
        $requete->execute(array('email'=>$email));
        $donnees = $requete->fetch();
        if($donnees['email']==$email){
            header('location: register.php?msg=Addresse email deja utilise');
        }
        else{
            $requete = $db->prepare('INSERT INTO user (id_user, nom, prenom, email, password, telephone, statut, etat, date_creation, date_modif, type_user, lien_profil, sexe, code_verif,email_verified)
            VALUES (\'\', :nom, :prenom, :email, :password, :telephone, 0, 1, now(), now(), \'user\', \'image\', :sexe, 0, 1)');
            $requete ->execute(array(
                'nom' =>$nom, 
                'prenom' => $prenom,
                'email' => $email,
                'password' => $password_hash,
                'telephone' => $tel,
                'sexe' => $sexe
            ));
            header('location:index.php?msg2=compteur creez avec success');
        }
    }

    