<?php
   try{
        $db = new PDO('mysql:host=localhost; dbname=rs_annonce','root','');
    }
    catch(Exception $e){
        die('Erreur: '.$e->getMessage());
    }
    $requete = $db->query('SELECT * FROM USER');