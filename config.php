<?php 
    try 
    {
        $bdd = new PDO('mysql:host=localhost;dbname=mydigitalproject', 'root', '');
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
