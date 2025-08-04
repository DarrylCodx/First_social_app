<?php
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(isset($_POST['email']) and isset($_POST['password'])){
        if(!empty($_POST['email'])and !empty($_POST['password'])){
            $password_hash = hash('sha256', $password);
            try{
                $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
            }
            catch(Exception $e){
                    die('Erreur: '.$e->getMessage());
            }
            $requete = $db->prepare('SELECT *FROM user WHERE email = :email AND password =:password');
            $requete->execute(array(
                'email'=>$email, 
                'password'=>$password_hash
            ));
            $donnees = $requete->fetch();
            if(($donnees['email']==$email) and ($donnees['password']==$password_hash)){
                if($donnees['etat']==0){
                    header('location: index.php?msg2=Impossible de login Utilisateur a ete bloque!');
                }
                else{
                    $updatestate = $db->prepare('UPDATE user SET statut = :statut WHERE id_user = :id_user');
                    $updatestate->execute(array(
                        'statut' => 1,
                        'id_user'=> $donnees['id_user']
                    ));
                    $_SESSION['id_user']= $donnees['id_user'];
                    $_SESSION['nom']= $donnees['nom'];
                    $_SESSION['prenom']= $donnees['prenom'];
                    $_SESSION['email']= $donnees['email'];
                    $_SESSION['password']= $donnees['password'];
                    $_SESSION['telephone']= $donnees['telephone'];
                    $_SESSION['statut']= $donnees['statut'];
                    $_SESSION['etat']= $donnees['etat'];
                    $_SESSION['date_creation']= $donnees['date_creation'];
                    $_SESSION['date_modif']= $donnees['date_modif'];
                    $_SESSION['type_user']= $donnees['type_user'];
                    $_SESSION['lien_profil']= $donnees['lien_profil'];
                    $_SESSION['sexe']= $donnees['sexe'];
                    $_SESSION['code_verif']= $donnees['code_verif'];
                    $_SESSION['email_verif']= $donnees['email_verif'];
                    header('location: home.php');
                }
            }
            else{
               // $_SESSION['i'] = $_SESSION['i']+1;
                header ('location: index.php?msg1= email ou password incorrect');
            }
        }
        else{
            if (empty($_POST['email']) and empty($_POST['password'])){
                header('location:index.php?msg1=votre address email et password sont pas rempli');
            }
            elseif (empty($_POST['email'])){
                header('location: index.php?msg1=Remplissez votre email&password= '.$_POST['password']);
            }
            elseif (empty($_POST['password'])){
                header('location: index.php?msg1=Remplissez votre password&email= '.$_POST['email']);
            }
        }
    }
    else{
        header('location: index.php?msg=Desole element non-defini');
    }
