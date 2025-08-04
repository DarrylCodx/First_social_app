<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    if(!isset($_SESSION['id_user'])){
        header("location: index.php");
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.1/bootstrap-icons-1.11.1/bootstrap-icons.min.css">
    <title>compte</title>
</head>
<body>

    <div class="row">
        <div class="col-md-3 bg-light pt-3">
            <div style="text-align:center;">
                <?php   
                    if($_SESSION['lien_profil']=='image'){
                ?>
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#profil">
                        <i class="bi-person-circle" style="color:black; font-size: 5em"></i><br>
                        <span style="color: green; font-weight:bold">Photo profil</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier la photo de profil</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="traitement_image.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="file" class="form-control" name="fichier" id="fichier">                   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <DIV class="d-grid gap-2 mb-2 mt-2">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </DIV> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    else{
                ?>
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#profil">
                        <img src="<?php echo $_SESSION['lien_profil'] ?>" alt="photo profil" class="rounded-circle border border-success" style="width: 200px; height:200px">
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier la photo de profil</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="traitement_image.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="file" class="form-control" name="fichier" id="fichier">                   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <DIV class="d-grid gap-2 mb-2 mt-2">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </DIV> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
            <div style="text-align:center;">
                <?php
                    echo '<br>USERNAME: <i>'.$_SESSION['nom'].' '.$_SESSION['prenom'].                    
                    '</i><br>EMAIL: <i>'.$_SESSION['email'].
                    '</i><br>PHONE: <i>'.$_SESSION['telephone'].'</i>';
                ?>
            </div>
            <div style="text-align:center;" class="d-grid gap-2 mb-2 mt-2">
                <a href="password_modif.php"><button class="btn btn-outline-success">Modifier mon password</button></a>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-8 bg-light"> 
            <div style="text-align: center;">
                <h1><i>Modification d'info utilisateurs</i></h1>
                <p>Modifiez les cases suivantes avec les nouvelles info<p>
            </div>
            <form action="traitement_modif.php" method="POST">
                <?php 
                    if(isset($_GET['msg'])){
                        echo'<p style="color:white; text-align:center; background-color:red;">'. $_GET['msg'].'</p>';
                    } 
                ?>
                <br><input type="text" placeholder="Nom" class="form-control" name="nom" id="nom" value="<?php echo $_SESSION['nom']?>"><br>
                <input type="text" placeholder="Prenom" class="form-control" name="prenom" id="prenom" value="<?php echo $_SESSION['prenom']?>"><br>
                <input type="text" placeholder="Telephone n*" class="form-control" name="tel" id="tel" value="<?php echo $_SESSION['telephone']?>"><br>
                <div >
                    <label for="sexe">Choissisez votre sexe:</label><br>
                    <input type="radio" name="sexe" value="M" <?php if($_SESSION['sexe']=='M'){echo 'checked';} ?>>
                    <label class="form-check-label" for="homme">Homme</label><br>
                    <input type="radio" name="sexe" value="F" <?php if($_SESSION['sexe']=='F'){echo 'checked';} ?>>
                    <label class="form-check-label" for="Femme">Femme</label>
                </div>
                <div>
                   <br> <button class="btn btn-success col-md-12">Modifier le compte</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>