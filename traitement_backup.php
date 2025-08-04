<?php
    session_start();
    $true_code= $_SESSION['code'];
    if(isset($_POST['code'])){
        if(!empty($_POST['code'])){
            if($_POST['code']==$true_code){
                header("location: home.php");
            }
            else{
                header("location: backup.php?msg=code incorrect");
            }
        }
        else{
            header("location: backup.php?msg=veillez entrer le code recuperation");
        }
    }
    else{
        header('location: backup.php?msg=Desole element non-defini');
    }
